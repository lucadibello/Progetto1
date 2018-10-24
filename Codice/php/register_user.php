<?php
    require_once("../php/CSVisualizer.php");
    $csv_util = new CSVisualizer("data/users.php");
    
    add_user(array(1,2,3,4,5,6,7,8,9,10,11,12));
    
    function add_user(array $data){
        global $csv_util;
        if(count($data) == 12){
            if($csv_util->add_new_line($data)){
                echo "added new line correctly";
                var_dump($csv_util->csv_to_array());
                return true;
            }
        }
        else{
            return false;
        }
    }
?>