<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <html>

    <head>
        <title></title>
        <meta charset=utf8>
       
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

        <!-- bootstrap !-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


        
        <style>
        /* Note: Try to remove the following lines to see the effect of CSS positioning */
        .affix {
            top: 0;
            width: 100%;
        }
        .s{
            ;
        }
        tr{
             -webkit-transition: 0.2s; /* Safari */
            transition: 
             0.2s;
        }
        tr:hover{
            background-color:#e6e6e6;
            -webkit-transition: 0.2s; /* Safari */
            transition: 
             0.2s;
        }
        .affix + .container-fluid {
            padding-top: 70px;
        }
        .table tr th b{
            cursor:pointer;
        }
        p[name=gs]{
             cursor:pointer;
        }
        .info{
            background-color:#e6e6e6;
        }
        .table > thead > tr > td.info,
.table > tbody > tr > td.info,
.table > tfoot > tr > td.info,
.table > thead > tr > th.info,
.table > tbody > tr > th.info,
.table > tfoot > tr > th.info,
.table > thead > tr.info > td,
.table > tbody > tr.info > td,
.table > tfoot > tr.info > td,
.table > thead > tr.info > th,
.table > tbody > tr.info > th,
.table > tfoot > tr.info > th {
  background-color: #404040;
  color:white;
}
        </style>
    </head>

    <body ng-app='myapp' ng-controller='myctrl' >
        <div class="container-fluid" style="background-color:##e6e6e6;">
             <h1>Miproject 3 #webpro</h1>
            <h3>เว็ปเพิ่มคำสั่งแต่งตั้ง</h3>
            
            
         </div>
         <?php include("page/nav.php") ?>
        <div class="container-fluid s" >
           
                <div  class="col-sm-12">
                <h1>แสดงคำสั่งทั้งหมด</h1>
                  
                    <p style='color:red'>**click ที่สถานนะเพื่อเปลี่ยนสถานะ**</p>
                     <p style='color:red'>**click รายระเอียดเพื่อแก้ใข หรือ ลบ**</p>
                     <p style='color:red'>click ที่หัวตารางเพื่อเรียงได้</p>
                   <div  >
                   
                        <table style="overflow:auto" class="table ">
                           <tr class="info">
                            
                            <th width=100 ng-click="changeorder('Command.Command_genid')"><center><b>รหัส</b></center></th>
                            <th  width=500 ng-click="changeorder('Command.Command_name')"><center><b>ชื่อคำสั่ง</b></center></th>
                            <th width=300><center>รายชื่อกรรมการ</center></th>
                            <th width=100 ng-click="changeorder('Command.Command_startdate')"><center><b>วันเริ่ม</b></center></th>
                            <th width=100 ng-click="changeorder('Command.Command_donedate')"><center><b>วันสิ้นสุด</b></center></th>
                            <th width=100 ng-click="changeorder('Command.Command_status')"><center><b>สถานะ</b></center></th>
                            <th  width=100 ng-click="changeorder('Command.Command_link')"><center><b>link</b></center></th>
                            <th width=120><center>รายระเอียด</th>
                            </tr>
                            <tr width=100 ng-repeat='r in obj1 | orderBy:ordername ' >
                            

                                
                                <td width=100><center>{{r.Command.Command_genid}}</center></td>
                                <td width=500>{{r.Command.Command_name}}</td>
                                
                                <td width=300><p ng-repeat="d in r.Memberlist">{{"ชื่อ : "+d.Member_name}}</p></td>
                                
                                <td width=100><center>{{r.datestart}}</center></td>
                                <td width=100><center>{{r.datestop == '0000-00-00' ? '-' : r.datestop}}</center></td>
                                <td width=70><center><p name=gs ng-click='changeStatus(r.Command.Command_id,r.Command.Command_status)'>
                                <button type="button" class="btn btn-default">{{r.Command.Command_status == 'Active' ? 'Active' : 'Expired'}}</center></button></p></td>
                                <td width=100><a href="{{r.Command.Command_link}}"><center><span class="glyphicon glyphicon-paperclip"></center></span></a></td>
                                <td width=100 value={{r.Command_id}}><center><a href="<?php echo base_url() ?>index.php/main/showonecommand/{{r.Command.Command_id}}"><span class="glyphicon glyphicon-align-left"></span></a></center></td>
                            </tr>
                                <td colspan="8"  ng-hide="obj1.length"><center><h1>ไม่มีข้อมูล</h1></center></td>
                            </table>
                        </div>
                        <div id=ss></div>
                        <ul>
                        <ul class="pagination" >
                            <li ng-repeat='x in a' >
                                <a href="#" ng-click='changepage(x.num)'>{{x.num}}</a>
                            </li>
                        </ul>
                       
                </div>
            </div>
        </div>


        </div>
           
            <script>

                var app=angular.module('myapp',[]);
                
                app.controller('myctrl',function($scope,$http){
                    
                    $scope.numstaypage=1;
                    

           
                    
                   $scope.checknumpage=function(n){
                    $http({
                            method : "GET",
                            url : "<?php echo base_url() ?>index.php/main/getNumPage"
                        }).then(function mySucces(response) {
                             $scope.numpage=response.data;
                             $scope.showlist(n,$scope.numpage);
                        }, function myError(response) {
                             $scope.numpage=response.statusText;
                        });
                   }
                    
                        
                    $scope.showlist=function(n,s){
                         $http({
                            method : "GET",
                            url : "<?php echo base_url() ?>index.php/main/getListPageCommand/"+n
                        }).then(function mySucces(response) {
                            $scope.obj1 = response.data;
                            $scope.a=new Array();
                            for(i=1;i<=s;i++){
                                $scope.a.push({num:i,com:false});
                            }
                        }, function myError(response) {
                            $scope.obj1 = response.statusText;
                        });

                    }
                    
                    $scope.changepage=function(n){                     
                        $scope.checknumpage(n);
                    }
                    $scope.changeStatus=function(id,s){
                        
                        $http({
                            method : "GET",
                            url : "<?php echo base_url() ?>index.php/main/changeStatus/"+id+"/"+s
                        }).then(function mySucces(response) {
                             
                             $scope.showlist($scope.numstaypage,$scope.numpage);
                        }, function myError(response) {
                             $scope.numpage=response.statusText;
                        });
                    }
            
                    $scope.changeorder=function(x){
                        if($scope.ordername==x){
                            $scope.ordername="-"+$scope.ordername;
                        }else{
                            $scope.ordername=x;
                        }
                        
                    }
                    
                    
                    
                    
                    $scope.checknumpage($scope.numstaypage);
                   

                });
                
                   
            </script>
        </body>

    </html>