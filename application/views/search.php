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

        .affix + .container-fluid {
            padding-top: 70px;
        }
         .table tr th b{
            cursor:pointer;
        }
        p[name=gs]{
             cursor:pointer;
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

    <body ng-app='myapp' ng-controller='myctrl'>
        <div class="container-fluid" >
             <h1>Miproject 3 #webpro</h1>
            <h3>เว็ปเพิ่มคำสั่งแต่งตั้ง</h3>
            
         </div>
       <?php include("page/nav.php") ?>
        <div class="container-fluid" style="height:1000px">
           
            <div  class="col-sm-12">
                <div class="col-sm-2">
               <h3>ค้นหา</h3>
                <input  placeholder='เลขที่ ชื่อคำสั่ง ชื่อกรรมการ' type=text ng-model=myfilter><br>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-6">
                    <div style="float: left;">
                    <h3>เริ่ม</h3>
                    <select ng-model=mini ng-click="count()">
                        <option selected value=แสดงทั้งหมด>แสดงทั้งหมด</option>
                        <option ng-repeat="y in arry">{{y}}</option>
                
                    </select>
                    </div>
                    <div style="float: left;">
                    <h3>สิ้นสุด</h3>
                    <select ng-model=maxi ng-click="count()">
                        <option value=แสดงทั้งหมด>แสดงทั้งหมด</option>
                        <option ng-repeat="y in arry">{{y}}</option>
                    </select>
                        </div>
                    <div style="float: left;">
                    <h3>จำนวนการค้นหา</h3>
                    <center>
                    <select ng-model=qu >
                        <option value=5>5</option>
                        <option value=10>10</option>
                        <option value=15>15</option>
                        <option value=20>20</option>
                    </select>
                    </center>
                        </div>

                </div>
                
                <div class="col-sm-12">&nbsp;</div>
                <table  class="table ">
                
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

                            <tr width=100 ng-repeat='r in obj1 =(obj| filter : myfilter)| orderBy:ordername | limitTo:qu' >
                            

                                
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
                                <td colspan="8"  ng-hide="obj1.length"><center><h1>ไม่พบข้อมูลที่คุณค้นหา</h1></center></td>
                            </table>
                            
                
           </div>
         </div>
        


        
            <script>
                var app=angular.module('myapp',[]);
                
                app.controller('myctrl',function($scope,$http){
                    //$scope.data=JSON.parse();
                    $scope.qu=10;
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
                    $scope.showlist=function(n,s){
                         $http({
                            method : "GET",
                            url : "<?php echo base_url() ?>index.php/main/getcomplete/"
                        }).then(function mySucces(response) {
                            if(response.data=='string'){
                                
                                $scope.rx='ไม่มีข้อมูล';
                                
                            }else{
                                $scope.obj = response.data;
                                $scope.rx='';
                            }
                            
                           
                        }, function myError(response) {
                            $scope.obj1 = response.statusText;
                        });

                    }
                   $http({
                        method : "GET",
                        url : "<?php echo base_url() ?>index.php/main/getcomplete"
                    }).then(function mySucces(response) {
                        if(response.data=='string'){
                                 $scope.rx='ไม่มีข้อมูล';
                            }else{
                        $scope.obj = response.data;
                         $scope.rx='';
                    }
                        $http({
                            method : "GET",
                            url : "<?php echo base_url() ?>index.php/main/getMinYear"
                        }).then(function mySucces(response) {
                            $scope.miny = response.data;
                            $http({
                                method : "GET",
                                url : "<?php echo base_url() ?>index.php/main/getMaxYear"
                            }).then(function mySucces(response) {
                                $scope.maxy = response.data;
                                $scope.arry=new Array();
                                for(i=Number($scope.miny);i<=Number($scope.maxy);i++){
                                    $scope.arry.push(i);
                                }
                                $scope.mini='แสดงทั้งหมด';
                                $scope.maxi='แสดงทั้งหมด';
                                
                                
                            }, function myError(response) {
                                $scope.maxy = response.statusText;
                            });
                        }, function myError(response) {
                            $scope.miny = response.statusText;
                        });
                    }, function myError(response) {
                        $scope.obj = response.statusText;
                    });
                    
                    $scope.count = function(){
                       
                        if($scope.maxi<$scope.mini){

                            $scope.maxi=$scope.mini;
                            
                            if($scope.mini!="แสดงทั้งหมด"){
                                alert('ใส่ปีน้อยกว่าไม่ได้ค่ะ');
                            }
                             $http({
                                method : "GET",
                                    url : "<?php echo base_url() ?>index.php/main/getlistforyear/"+$scope.mini+"/"+$scope.maxi
                                }).then(function mySucces(response) {
                                    $scope.obj = response.data;
                                
                                }, function myError(response) {
                                    $scope.obj =response.data;
                                }); 
                        }else if($scope.mini=="แสดงทั้งหมด"){
                            $scope.maxi="แสดงทั้งหมด";
                             $http({
                                method : "GET",
                                    url : "<?php echo base_url() ?>index.php/main/getcomplete"
                                }).then(function mySucces(response) {
                                    $scope.obj = response.data;
                                }, function myError(response) {
                                    $scope.obj =response.data;
                                }); 

                        }
                        else{
                            $http({
                                method : "GET",
                                    url : "<?php echo base_url() ?>index.php/main/getlistforyear/"+$scope.mini+"/"+$scope.maxi
                                }).then(function mySucces(response) {
                                    $scope.obj = response.data;
                                }, function myError(response) {
                                    $scope.obj =response.data;
                                }); 
                        }
                    }
                 $scope.changeorder=function(x){
                        if($scope.ordername==x){
                            $scope.ordername="-"+$scope.ordername;
                        }else{
                            $scope.ordername=x;
                        }
                        
                    }
                });

            </script>
        </body>

    </html>