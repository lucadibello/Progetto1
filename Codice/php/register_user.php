<?php
    session_start();
    require_once("../php/CSVisualizer.php");
    $csv_util = new CSVisualizer();
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["register"])){
            $values = array_values($_SESSION);
            $data = array_splice($values,1);
            add_user($data);
            $_SESSION["registered"] = true;
            header("Location: ../pages/riassunto.php");
        }
    }

    function add_user(array $data){
        global $csv_util;

        //ADD DATA IN Registrazioni_Tutte.csv
        $csv_util->add_new_line('data/Registrazioni_tutte.csv',$data);

        //CREATE TODAY'S FILE IF NOT EXISTS AND APPEND TEXT
        $file_name = "data/".$csv_util->get_current_day_filename();
        $csv_util->add_new_line($file_name,$data);
    }
?>