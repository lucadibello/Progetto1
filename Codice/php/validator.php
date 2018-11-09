<?php
//--> Ho eseguito i commenti phpDoc perchè questa classe la potrei utilizzare in progetti futuri.

//--> Queste variabili servono come 'impostazioni' del validatore
//Lunghezza minima (caratteri) del dato
$global_length_min = 0;

//Lunghezza massima (caratteri) del dato
$global_length_max = 50;

//Lunghezza massima per il campo 'professione'
$work_length_max = 500;

//Lunghezza massima per il campo 'hobby'
$hobby_length_max = 500;


/**
 * Questo metodo si occupa della validazione del nome.
 * @param string $name Nome da validare.
 * @return boolean Ritorna 'false' se il dato non è valido, rispettivamente 'true' se il dato è valido
 */
function validate_nome($name){
    if(strlen($name) > $GLOBALS["global_length_min"] && strlen($name) < $GLOBALS["global_length_max"]){
        //THIS REGEX LOOK FOR ILLEGAL CHARACTERS
        $rexSafety = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#0-9]+/i";
        return !preg_match($rexSafety,$name);
    }
    return false;
}

/**
 * Questo metodo si occupa della validazione del cognome.
 * @param string $cognome Cognome da validare.
 * @return boolean Ritorna 'false' se il dato non è valido, rispettivamente 'true' se il dato è valido
 */
function validate_cognome($cognome){
    if(strlen($cognome) > $GLOBALS["global_length_min"] && strlen($cognome) < $GLOBALS["global_length_max"]){
        //THIS REGEX LOOK FOR ILLEGAL CHARACTERS
        $rexSafety = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#0-9]+/i";
        return !preg_match($rexSafety,$cognome);
    }
    return false;
}

/**
 * Questo metodo si occupa della validazione della via.
 * @param string $via Via da validare.
 * @return boolean Ritorna 'false' se il dato non è valido, rispettivamente 'true' se il dato è valido
 */
function validate_via($via){
    if(strlen($via) > $GLOBALS["global_length_min"] && strlen($via) < $GLOBALS["global_length_max"]){
        //THIS REGEX LOOK FOR ILLEGAL CHARACTERS
        $rexSafety = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#0-9]+/i";
        return !preg_match($rexSafety,$via);
    }
    return false;
}

/**
 * Questo metodo si occupa della validazione della data di nascita. Esso controlla se il formato è
 * YYYY-mm-dd e che la data abbia un senso logico, ovvero la data di nascita non può essere una 
 * data nel futuro (non ancora passata) e che la data non sia più vecchia di 120 anni.
 * @param string $data Data da validare.
 * @return boolean Ritorna 'false' se il dato non è valido, rispettivamente 'true' se il dato è valido
 */
function validate_dataNascita($data){
    if(strlen($data) > $GLOBALS["global_length_min"] && strlen($data) < $GLOBALS["global_length_max"]){
        if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$data) == true){
            //VALID FORMAT
            $currentYear = date('Y');
            $postYear = date('Y',strtotime($data));

            if($postYear <= $currentYear && $postYear >= ($currentYear - 120)){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            //INVALID FORMAT
            return false;
        }
    }
    return false;
}

/**
 * Questo metodo si occupa della validazione dell'email tramite la funzione 'filter_var' utilizzando il flag 'FILTER_VALIDATE_EMAIL'.
 * @param string $email Email da validare.
 * @return boolean Ritorna 'false' se il dato non è valido, rispettivamente 'true' se il dato è valido
 */
function validate_email($email){
    if(strlen($email) > $GLOBALS["global_length_min"] && strlen($email) < $GLOBALS["global_length_max"]){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        else{return false;}
    }
    return false;
}

/**
 * Questo metodo si occupa della validazione del nome della città.
 * @param string $citta Nome della città da validare.
 * @return boolean Ritorna 'false' se il dato non è valido, rispettivamente 'true' se il dato è valido
 */
function validate_citta($citta){
    if(strlen($citta) > $GLOBALS["global_length_min"] && strlen($citta) < $GLOBALS["global_length_max"]){
        return preg_match('/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/', $citta);
    }
    return false;
}

/**
 * Questo metodo si occupa della validazione del codice cap (anche NAP oppure 'ZIP Code' in inglese).
 * @param string $cap Codice CAP da validare.
 * @return boolean Ritorna 'false' se il dato non è valido, rispettivamente 'true' se il dato è valido
 */
function validate_cap($cap){
    if (strlen($cap) > 0) {
        return preg_match('/^[0-9]{4,5}$/',$cap);
    }
    return false;
}

/**
 * Questo metodo si occupa della validazione del numero di telefono.
 * @param string $phone Numero di telefono da validare.
 * @return boolean Ritorna 'false' se il dato non è valido, rispettivamente 'true' se il dato è valido
 */
function validate_phone($phone){
    if (strlen($phone) > 0) {
        return preg_match('/^[+|00]+([0-9]){11,13}$/',$phone);
    }
    return false;
}

/**
 * Questo metodo si occupa della validazione del numero civico.
 * @param string $civico Numero civico da validare.
 * @return boolean Ritorna 'false' se il dato non è valido, rispettivamente 'true' se il dato è valido
 */
function validate_numeroCivico($civico){
    //TODO: Aggiungere massimo 3 cifre
    return preg_match('/^[0-9]{1,3}+([a-zA-Z]{0,1})$/',$civico);
}

/**
 * Questo metodo si occupa della validazione del testo del campo 'professione'.
 * @param string $text Testo del campo 'professione' da validare.
 * @return boolean Ritorna 'false' se il dato non è valido, rispettivamente 'true' se il dato è valido
 */
function validate_work($text){
    if(strlen($text) < $GLOBALS["work_length_max"]){
        return true;
    }
    return false;
}

/**
 * Questo metodo si occupa della validazione del testo del campo 'hobby'.
 * @param string $text Testo del campo 'hobbys' da validare.
 * @return boolean Ritorna 'false' se il dato non è valido, rispettivamente 'true' se il dato è valido
 */
function validate_hobby($text){
    if(strlen($text) < $GLOBALS["hobby_length_max"]){
        return true;
    }
    return false;
}
?>