<?php
$var2=7;
require_once 'test1.php';
function o(){
    echo $GLOBALS['var1'];
}
o()
?>