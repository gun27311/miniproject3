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
                    <p style='color:red'>**double click ที่สถานนะเพื่อเปรี่ยนสถานะ**</p>
                     <p style='color:red'>**click รายระเอียดเพื่อแก้ใข หรือ ลบ**</p>
                   <div  >
                        <table style="overflow:auto" class="table ">
                            <tr>
                            
                            <th ng-click="changeorder('Command.Command_genid')"><b>รหัส</b></th>
                            <th width=300 ng-click="changeorder('Command_name')"><b>ชื่อคำสั่ง</b></th>
                            <th >รายชื่อกรรม</th>
                            <th ng-click="changeorder('Command.Command_startdate')"><b>วันเริ่ม</b></th>
                            <th ng-click="changeorder('Command.Command_donedate')"><b>วันสิ้นสุด</b></th>
                            <th ng-click="changeorder('Command.Command_status')"><b>สถานะ</b></th>
                            <th ng-click="changeorder('Command.Command_link')"><b>link</b></th>
                            <th width=100>รายระเอียด</th>
                            </tr>
                            <tr ng-repeat='r in obj1 | orderBy:ordername | filter : myfilter'>
                            <a href='#1'>
                                
                                <td>{{r.Command.Command_genid}}</td>
                                <td>{{r.Command.Command_name}}</td>
                                <td width=300><p ng-repeat="d in r.Memberlist">ชื่อ : {{d.Member_name}} ตำแหน่ง : {{d.Member_Position}}</p></td>
                                <td width=100>{{r.Command.Command_startdate}}</td>
                                <td width=100>{{r.Command.Command_donedate}}</td>
                                <td><p name=gs ng-dblclick='changeStatus(r.Command.Command_id,r.Command.Command_status)'>{{r.Command.Command_status}}</p></td>
                                <td>{{r.Command.Command_link}}</td>
                                <td value={{r.Command.Command_id}}><a href='<?php echo base_url() ?>index.php/main/showonecommand/{{r.Command.Command_id}}'>click</a></td>
                                </a>
                            </tr>
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