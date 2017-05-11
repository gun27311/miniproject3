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
            <div  class="col-sm-7">
                <?php 
                if(isset($Command_genid)){
                        echo  "<div class='col-sm-9'>";
                        echo "<br>";
                        
                        echo "<h3>รหัสคำสั่งแต่งตั้ง </h3><h4>$Command_genid</h4>";
                        echo "<br>";
                        
                        echo "<h3>ชื่่อคำสั่ง</h3><p> &nbsp;&nbsp;&nbsp; $Command_name </p>";
                        
                        
                        echo "<h3>รายชื่อกรรมการ</h3>";
                        echo "<p>";
                        if(empty($memberlist)){
                            echo "-.- ขณะนี้ยังไม่มีรายชื่อกรรมการ -.-";
                        }else{
                            foreach($memberlist as $key=>$row){
                                echo "ชื่อ $row->Member_name ตำแหน่ง $row->Member_Position<br>";
                            }
                        }
                        echo "<h3>link</h3>";
                        echo "<p>$Command_link</p>";
                        echo "</p>";
                        
                        
                        echo "<h3>ระยะเวลาของคำสั่ง</h3>";
                        echo "$Command_startdate ถึง ";
                        if($Command_donedate=='0000-00-00'){
                            echo "ไม่มีกำหนด";
                        }else{
                            echo "$Command_donedate";
                        }
                        echo "<br>";
                        
                        echo "<h3>สาถานะ</h3>";
                        if($Command_status=='A'){
                            echo "<p>กำลังดำเนินการ</p>";
                        }else{
                            echo "<p>หมดอายุแล้ว</p>";
                        }
                         
                        echo "</div>";
                        echo  "<div class='col-sm-3'>";
                        echo "<a href='".base_url()."/index.php/main/Showeditcommmand/$Command_id'><button>แก้ใข</button></a> <a href='".base_url()."/index.php/main/deleteCommmand/$Command_id'><button>ลบ</button></a>";
                        echo "</div";
                       
                }else{
                    echo "<h3>คำสั่งนี้ถูกลบไปแล้ว</h3>";
                }
                ?>
                
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