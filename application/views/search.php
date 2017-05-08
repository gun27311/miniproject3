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
           <div class="col-sm-2" id="myScrollspy">
                
                </div>
            <div  class="col-sm-8">
               <h3>ค้นหา</h3>
               ชื่อคำสั่ง <input type=text >
                
           </div>
         </div>
        


        
            <script>
                var app=angular.module('myapp',[]);
                app.controller('myctrl',function($scope,$http){
                   $http({
                        method : "GET",
                        url : "<?php echo base_url() ?>index.php/main/getlistCommand"
                    }).then(function mySucces(response) {
                        $scope.obj = response.data;
                        
                    }, function myError(response) {
                        $scope.obj = response.statusText;
                    });
                });
            </script>
        </body>

    </html>