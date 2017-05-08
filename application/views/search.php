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
        </style>
    </head>

    <body ng-app='myapp' ng-controller='myctrl'>
        <div class="container-fluid" style="background-color:##e6e6e6;">
            <h1>Miproject 3 #webpro</h1>
            <h3>เว็ปเพิ่มคำสั่งแต่งตั้ง</h3>
            
         </div>
       <?php include("page/nav.php") ?>
        <div class="container-fluid" style="height:1000px">
           
            <div  class="col-sm-12">
                <div class="col-sm-2">
               <h3>ค้นหา</h3>
                <input type=text ng-model=myfilter><br>
                </div>
                <div class="col-sm-2">
                <h3>ระยะเวลา</h3>
                <input type=text ng-model=myfilter><br>
                </div>
                <table  class="table ">
                            <tr>
                            
                            <th ng-click="changeorder('Command_genid')"><b>รหัส</b></th>
                            <th style='width:300' ng-click="changeorder('Command_name')"><b>ชื่อคำสั่ง</b></th>
                            <th>รายชื่อกรรมการ</th>
                            <th ng-click="changeorder('Command_startdate')"><b>วันเริ่ม</b></th>
                            <th ng-click="changeorder('Command_donedate')"><b>วันสิ้นสุด</b></th>
                            <th ng-click="changeorder('Command_status')"><b>สถานะ</b></th>
                            <th ng-click="changeorder('Command_link')"><b>link</b></th>
                            </tr>
                            <tr ng-repeat='r in obj | orderBy:ordername | filter : myfilter'>
                            <a href='#1'>
                                
                                <td>{{r.Command.Command_genid}}</td>
                                <td style='width:300'>{{r.Command.Command_name}}</td>
                                
                                <td ><ul style='list-style-type:none;' ng-repeat="d in r.Memberlist"><li>{{"ชื่อ : "+d.Member_name+" ตำแหน่ง "+d.Member_Position}}</li></ul></td>
                                
                                <td>{{r.Command.Command_startdate}}</td>
                                <td>{{r.Command.Command_donedate}}</td>
                                <td>{{r.Command.Command_status}}</td>
                                <td value={{r.Command_id}}><a href='<?php echo base_url() ?>index.php/main/showonecommand/{{r.Command_id}}'>click</a></td>
                                </a>
                            </tr>
                            </table>
                
           </div>
         </div>
        


        
            <script>
                var app=angular.module('myapp',[]);
                
                app.controller('myctrl',function($scope,$http){
                    //$scope.data=JSON.parse();
                   $http({
                        method : "GET",
                        url : "<?php echo base_url() ?>index.php/main/getcomplete"
                    }).then(function mySucces(response) {
                        $scope.obj = response.data;
                        
                    }, function myError(response) {
                        $scope.obj = response.statusText;
                    });

                    $scope.filterdate=function(){
                        $http({
                            method : "GET",
                            url : "<?php echo base_url() ?>index.php/main/getMaxYear"
                        }).then(function mySucces(response) {
                            $scope.miny = response.data;
                            alert($scope.miny);
                        }, function myError(response) {
                            $scope.miny =response.data;
                        }); 
                    }
                     $scope.filterdate();
                });

            </script>
        </body>

    </html>