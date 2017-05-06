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
        </style>
    </head>

    <body ng-app='myapp' ng-controller='myctrl' >
        <div class="container-fluid" style="background-color:##e6e6e6;">
            <h1>เว็ปเพิ่มคำสั่งแต่งตั้ง</h1>
            <h3>Miproject 3 #webpro</h3>
            
            
         </div>
         <?php include("page/nav.php") ?>
        <div class="container-fluid s" >
           <div class="col-sm-2" id="myScrollspy">
                
                </div>
                <div  class="col-sm-10">
                   
                     <table class="table ">
                         <tr>
                        <th></th>
                        <th ng-click="changeorder('Command_genid')"><b>รหัส</b></th>
                        <th style='width:850' ng-click="changeorder('Command_name')"><b>ชื่อคำสั่ง</b></th>
                        <th ng-click="changeorder('Command_startdate')"><b>วันเริ่ม</b></th>
                        <th ng-click="changeorder('Command_donedate')"><b>วันสิ้นสุด</b></th>
                        <th ng-click="changeorder('Command_status')"><b>สถานะ</b></th>
                        <th ng-click="changeorder('Command_link')"><b>link</b></th>
                        </tr>
                        <tr ng-repeat='r in obj1 | orderBy:ordername | filter : myfilter'>
                            <td><input type=checkbox></td>
                            <td>{{r.Command_genid}}</td>
                            <td style='width:850'>{{r.Command_name}}</td>
                            <td>{{r.Command_startdate}}</td>
                            <td>{{r.Command_donedate}}</td>
                            <td>{{r.Command_status}}</td>
                            <td value={{r.Command_id}}>{{r.Command_link}}</td>
                        </tr>
                        </table>
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
                var numstaypage=1;
                var numpage;
                var app=angular.module('myapp',[]);
                
                app.controller('myctrl',function($scope,$http){
                    
                    $scope.numstaypage=1;
                    $scope.numpage=0;

                    $scope.changeorder=function(o){
                        $scope.ordername=o;
                    }
                   
                    $http({
                            method : "GET",
                            url : "<?php echo base_url() ?>index.php/main/getNumPage"
                        }).then(function mySucces(response) {
                            $scope.numpage= response.data;
                            
                        }, function myError(response) {
                            $scope.numpage= response.statusText;
                        });
                        
                    $scope.showlist=function(n){
                         $http({
                            method : "GET",
                            url : "<?php echo base_url() ?>index.php/main/getListPageCommand/"+n
                        }).then(function mySucces(response) {
                            
                            $scope.obj1 = response.data;
                            $scope.a=new Array();
                            for(i=1;i<=$scope.numpage;i++){
                                $scope.a.push({num:i,com:false});
                            }
                           
                            //$compile(document.getElementById('ss'))($scope);
                            
                        }, function myError(response) {
                            $scope.obj1 = response.statusText;
                        });

                    }
                   $scope.changepage=function(n){
                       
                        $scope.showlist(n);
                    }
                    
                    
                    
                    
                    $scope.showlist($scope.numstaypage);
                   

                });
                
                   
            </script>
        </body>

    </html>