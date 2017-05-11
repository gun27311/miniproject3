<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <html>

    <head>
        <title></title>
        <meta charset=utf8>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

        <!-- bootstrap !-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


         <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <link rel="stylesheet" href="/resources/demos/style.css">
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            
        <style>
            /* Note: Try to remove the following lines to see the effect of CSS positioning */
            
            .affix {
                top: 0;
                width: 100%;
            }
            nonshow:hover{
                background-color:white;
            }
            .s {
                ;
            }
            
            tr {
                -webkit-transition: 0.2s;
                /* Safari */
                transition: 0.2s;
            }
            
            tr:hover {
                background-color: #e6e6e6;
                -webkit-transition: 0.2s;
                /* Safari */
                transition: 0.2s;
            }
            
            .affix+.container-fluid {
                padding-top: 70px;
            }
            
            .table tr th b {
                cursor: pointer;
            }
        </style>
    </head>

    <body ng-app='myapp' ng-controller='myctrl'>
        <div class="container-fluid" style="background-color:##e6e6e6;">
            <h1>เว็ปเพิ่มคำสั่งแต่งตั้ง</h1>
            <h3>Miproject 3 #webpro</h3>


        </div>
        <?php include("page/nav.php") ?>
        <div class="container-fluid s">
            <div class="col-sm-2" id="myScrollspy">

            </div>
            <div class="col-sm-10">
                <form name="myForm" onsubmit="return validateForm()" action="<?php echo base_url() ?>index.php/main/addcommand" method='POST'>
                <!-- form !-->
                <div class="form-group">
                    <label for="text">เลขที่คำสั่ง :</label>
                    <input type="text" class="form-control" name=comid id="comid" required>
                </div>
                <div class="form-group">
                    <label for="text">ชื่อคำสั่ง:</label>
                    <textarea type="text" class="form-control" name=comname id="comname" required></textarea>
                    <label for="text">link : </label>
                    <input type="text" class="form-control" name=link id="comname" required>
                </div>
                <div class="form-group">
                    <label for="text">รายชื่อกรรมการ:</label>
                    <br>
                    <table>

                    <button type="button" id=addmember class="btn btn-default">เพื่มกรรมการ</button>
                    </table>
                     
                </div>

                <div class="form-group">
                    <table>
                        <tr>
                            <td>
                    <label for="text">เวลาเริ่มคำสั่ง :</label>
                    <input ng-model='start' type="date" name=comstart class="form-control" id="comname" required>
                            </td>
                    </tr>
                      <tr>
                            <td>
                    <label for="text">เวลาจบคำสั่ง :</label>
                     <input type="date" min={{start}} name=comstop class="form-control" id="comname" >
                           </td>
                    </tr>
                     </table>
                     <h3>สถานะ</h3>
                     <input type=radio value='Active' name=status checked> Active <input type=radio value='X' name=status value=expine> expine
                </div>
                <button type="submit" class="btn btn-default">Submit</button>

                <!-- form !-->
                </form>

            </div>
        </div>



        </div>
        <script>
        
       
            $(document).ready(function() {
                
                $('#addmember').click(function() {
                    $(this).before("<tr><td><input required my=mm type='text' name='memberlist[]' class='form-control' placeholder='โปรดใส่ชื่อกรรมการ'></td><td width='130'><input type='text' name='prolist[]' required class='form-control' id='pwd' placeholder='โปรดใส่ตำแหน่ง'></td><td><button type=button id=remove class='btn btn-default'>ลบ</button></td></tr><tr id=nonshow><td id=nonshow>&nbsp;</td></tr>");
                    $.get('<?php echo base_url() ?>/index.php/main/getnameallmember',function(data){
                    var c=JSON.parse(data);
                    $( "input[my=mm]" ).autocomplete({
                     source: c
                    });

                    })
                })
                $('body').on('click','#remove',function(){
                     $(this).parent().parent().next().remove();
                    $(this).parent().parent().remove();
                })
                
                
            })
        </script>
        <script>
            var x="<?php echo date('Y-m-d'); ?>";
            
            var app = angular.module('myapp', []);
            app.controller('myctrl', function($scope) {
                $scope.start=new Date();
            });
        </script>
    </body>

    </html>