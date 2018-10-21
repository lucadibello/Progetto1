<?php
$global_length_min = 0;
$global_length_max = 50;
$cap_max_length = 5;
$work_length_max = 500;
$hobby_length_max = 500;

function validate_nome($name){
    if(strlen($name) > $GLOBALS["global_length_min"] && strlen($name) < $GLOBALS["global_length_max"]){
        return preg_match('/^[a-z ]+$/i', $name);
    }
    return false;
}

function validate_cognome($cognome){
    if(strlen($cognome) > $GLOBALS["global_length_min"] && strlen($cognome) < $GLOBALS["global_length_max"]){
        return preg_match('/^[a-z ]+$/i', $cognome);
    }
    return false;
}

function validate_via($via){
    if(strlen($via) > $GLOBALS["global_length_min"] && strlen($via) < $GLOBALS["global_length_max"]){
        return preg_match('/^[a-z ]+$/i', $via);
    }
    return false;
}

function validate_dataNascita($data){
    if(strlen($data) > $GLOBALS["global_length_min"] && strlen($data) < $GLOBALS["global_length_max"]){
        return preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$data);
    }
    return false;
}

function validate_email($email){
    if(strlen($email) > $GLOBALS["global_length_min"] && strlen($email) < $GLOBALS["global_length_max"]){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        else{return false;}
    }
    return false;
}

function validate_citta($citta){
    if(strlen($citta) > $GLOBALS["global_length_min"] && strlen($citta) < $GLOBALS["global_length_max"]){
        return preg_match('/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/', $citta);
    }
    return false;
}

function validate_cap($cap){
    if (strlen($cap) > 0) {
        return preg_match('/^[0-9]{4,5}$/',$cap);
    }
    return false;
}

function validate_phone($phone){
    if (strlen($phone) > 0) {
        return preg_match('/^[+|00]+([0-9]){11}$/',$phone);
    }
    return false;
}

function validate_numeroCivico($civico){
    return preg_match('/^[0-9]+([a-zA-Z]{0,1})$/',$civico);
}

function validate_work($text){
    if(strlen($text) > $GLOBALS["global_length_min"] && strlen($text) < $GLOBALS["global_length_max"]){
        return true;
    }
    return false;
}

function validate_hobby($text){
    if(strlen($text) > $GLOBALS["global_length_min"] && strlen($text) < $GLOBALS["global_length_max"]){
        return true;
    }
    return false;
}
?>