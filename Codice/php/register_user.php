<?php
    session_start();
    /*
    * Utilizzo un 'require' e non un 'include' perchè la class CSVisualizer.php è necessaria per il corretto
    * funzionamento del codice.
    */
    require_once("../php/CSVisualizer.php");
    $csv_util = new CSVisualizer();
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["register"])){
            $values = array_values($_SESSION);
            
            /*
            * Seleziono tutti i dati tranne il valore alla prima posizione (indice 0), esso è soltanto il flag
            * che identifica l'azione del registrarsi.
            */   
            $data = array_splice($values,1);
            
            add_user($data);

            /*
            * Aggiungo il flag 'registered' all'array $_SESSION almeno se provo ad andare nella homepage, essa rileva che
            * l'utente è già registrato e lo manda alla pagina di riassunto.
            * Se si vuole resettare basta cliccare sul bottone 'logouti posto sul fondo della pagina di riassunto
            */
            $_SESSION["registered"] = true;

            //Redirect alla pagina di riassunto
            header("Location: ../pages/riassunto.php");
        }
    }

    /**
     * Questo metodo semplifica la registrazione dell'utente all'interno dei due file csv.
     * @param array $data Array contenente i dati della registrazione dell'utente.
     */
    function add_user(array $data){
        global $csv_util;
        //----------------------------------------------------File globale
        $file_name_all = "../registrazioni/Registrazioni_tutte.csv";

        /*
        * Inserisco i dati in un altra variabile prima del richiamo del metodo 'array_slice'
        * per evitare di estrarre un altra volta i dati.
        */
        $data_day = $data;

        //Prendo la data ed l'ora della registrazione
        $currentDateTime = [date('Y-m-d H:i:s')];

        //Se il file non esiste, lo crea, aggiunge l'header e dopo aggiunge i dati
        if(!file_exists($file_name_all)){
            $header = "reg_date;first_name;last_name;data_nascita;sesso;email;citta;cap;via;numero_civico;numero_telefono;work;hobby"."\n";
            file_put_contents($file_name_all,$header,FILE_APPEND);
        }
        
        //Aggiunge ad indice 0 il datetime della registrazione
        array_splice($data,0,0,$currentDateTime);
        $csv_util->add_new_line($file_name_all,$data);

        //----------------------------------------------------File odierno 
        $file_name_day = "../registrazioni/".$csv_util->get_current_day_filename();

        //Se il file non esiste, lo crea, aggiunge l'header e dopo aggiunge i dati
        if(!file_exists($file_name_day)){
            $header = "first_name;last_name;data_nascita;sesso;email;citta;cap;via;numero_civico;numero_telefono;work;hobby"."\n";
            file_put_contents($file_name_day,$header,FILE_APPEND);
        }
        $csv_util->add_new_line($file_name_day,$data_day);
    }
?>