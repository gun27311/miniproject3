<?php

foreach($_GET['memberlist'] as $row=>$val)
    echo "\$_POST['$row']=$val <br>";
?>