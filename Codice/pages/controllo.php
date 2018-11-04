<?php
    session_start();
    //Questa pagina utilizza un 'require' perchè i metodi di 'validator.php' sono necessari per il corretto funzionamento della pagina
    require_once("../php/validator.php");

    /*
    *   Questa pagina prima controlla la validità dei dati inviati tramite i metodi di 'validator.php', se essi non sono validi
    *   viene eseguito un redirect verso la pagina 'register.php'.
    */

    $nome=$cognome=$data_nascita=$sesso=$email=$citta=$cap=$via=$numero_civico=$numero_telefono=$work=$hobby = "null";

    //Flag utili per controllare la validità dei dati e della richiesta
    $data_valid = false;
    $request_valid = false;
    
    //Array contenente i nomi dei campi contenenti dati non validi
    $errors = array();

    /*
    *   Se viene effettuata una richiesta di tipo "POST" controllo se tutti i dati sono presenti tramite il metodo "allSet()", se tutti i dati hanno un valore
    *   li inserisco in delle variabili, ma prima di questo eseguo un 'clean' del dato tramite il metodo "test_input()", il quale si occupa di evitare un
    *   cross-site scripting (XSS), quindi il passare tramite dato del codice client-side (ovvero codice JavaScript).
    */
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(allSet()){
            $request_valid = true;
            
            $nome = test_input($_POST["first_name"]);
            $cognome = test_input($_POST["last_name"]);
            $data_nascita = test_input($_POST["data_nascita"]);
            $sesso = test_input($_POST["sesso"]) == 'm' ? "Maschio" : "Femmina";
            $email = test_input($_POST["email"]);
            $citta = test_input($_POST["citta"]);
            $cap = test_input($_POST["cap"]);
            $via = test_input($_POST["via"]);
            $numero_civico = test_input($_POST["numero_civico"]);
            $numero_telefono = test_input($_POST["phone"]);
            $work = isset($_POST["work"]) ? test_input($_POST["work"]) : "";
            $hobby = isset($_POST["hobby"]) ? test_input($_POST["hobby"]) : "";
            $len = strlen($work);

            //Valido i dati
            $result = validate_all();
            
            /*
            *   Se i dati sono validi imposto il flag 'data_valid' a 'true' ed eseguo il metodo create_restore_session(), il quale si occupa di tenere in memoria
            *   tutti i dati della registrazione per essere poi utilizzati nelle altre pagine.
            */   
            if(is_array($result)){
                $data_valid = false;
                $_SESSION["errors"] = $result;
            }
            else{
                $data_valid = true;
                
                if(isset($_SESSION["errors"])) unset($_SESSION["errors"]);
                
                create_restore_session();
            }
        }
    }
    else{
        header("Location: register.php");
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /*
     *  Questo metodo si occupa di controllare se i dati inviati dal form precedente sono impostati. Serve per evitare degli errori se il server
     *  riceve una richiesta di tipo 'Post' falsa (per esempio fatta tramite 'Burp Suite').
     */
    function allSet(){
        global $_POST;
        if(isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["data_nascita"]) && isset($_POST["sesso"])
        && isset($_POST["email"]) && isset($_POST["citta"]) && isset($_POST["cap"]) && isset($_POST["via"]) && isset($_POST["numero_civico"])
        && isset($_POST["phone"])){
            return true;
        }
        return false;
    }

    /**
     * Questo metodo si occupa della validazione dei dati utilizzati nella registrazione. La validazione avviene appoggiandosi
     * ai metodi presenti nel file 'validator.php'.
     * @return boolean|array Ritorna 'true' se tutti i dati sono validi, altrimenti ritorna un array contenente tutti i nomi
     * dei campi contenenti i dati non validi.
     */
    function validate_all(){
        global $nome,$cognome,$data_nascita,$sesso,$email,$citta,$cap,$via,$numero_civico,$numero_telefono,$work,$hobby;
        $errors = array();

        if(!validate_nome($nome)){
            $errors[] = "nome";
        } 
        if(!validate_cognome($cognome)){
            $errors[] = "cognome";
        } 
        if(!validate_via($via)){
            $errors[] = "via";
        } 
        if(!validate_dataNascita($data_nascita)){
            $errors[] = "data nascita";
        } 
        if(!validate_email($email)){
            $errors[] = "email";
        }
        if(!validate_citta($citta)){
            $errors[] = "citta";
        }
        if(!validate_cap($cap)){
            $errors[] = "cap";
        }
        if(!validate_phone($numero_telefono)){
            $errors[] = "phone";
        }
        if(!validate_numeroCivico($numero_civico)){
            $errors[] = "civico";
        }
        if(!validate_work($work)){
            $errors[] = "work";
        } 
        if(!validate_hobby($hobby)){
            $errors[] = "hobby";
        } 

        if(count($errors) == 0){
            return true;
        }
        else{
            return $errors;
        }
    }

    /**
     * Questo metodo si occupa di tenere in memoria i dati della registrazione per poterli utilizzare nelle pagine successive e precendenti, questo lo fa attraverso
     * l'array $_SESSION.
     */
    function create_restore_session(){
        global $nome,$cognome,$data_nascita,$sesso,$email,$citta,$cap,$via,$numero_civico,$numero_telefono,$work,$hobby;

        $_SESSION["restore"] = true;
        $_SESSION["nome"] = urlencode($nome);
        $_SESSION["cognome"] = urlencode($cognome);
        $_SESSION["data_nascita"] = urlencode($data_nascita);
        $_SESSION["sesso"] = urlencode($sesso);
        $_SESSION["email"] = urlencode($email);
        $_SESSION["citta"] = urlencode($citta);
        $_SESSION["cap"] = urlencode($cap);
        $_SESSION["via"] = urlencode($via);
        $_SESSION["numero_civico"] = urlencode($numero_civico);
        $_SESSION["numero_telefono"] = urlencode($numero_telefono);
        $_SESSION["work"] = urlencode($work);
        $_SESSION["hobby"] = urlencode($hobby);
    }

    /**
     * Questo metodo si occupa di distruggere la sessione di 'restore'. Esso controlla se il 
     * flag 'restore' esiste, se c'è distrugge la sessione corrente (distruggendola i dati che 
     * aveva in memoria vengono persi).
     * @return boolean Ritorna 'true' se è riuscito a distruggere la sessione, se non è riuscito ritorna 'false'.
     */
    function close_restore_session(){
        $status = true;
        isset($_SESSION["restore"]) ? session_destroy() : $status = false;

        return $status;
    }
?>

<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div class="col-sm-11" style="padding:10px;">
        <div id="register" class="col s12" style="padding: 10px;">
        <?php if($request_valid && $data_valid):?>
            <table class="responsive-table highlight">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>Dato inserito</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Nome</td>
                        <td><?php echo $nome?></td>
                    </tr>
                    <tr>
                        <td>Cognome</td>
                        <td><?php echo $cognome?></td>
                    </tr>
                    <tr>
                        <td>Data di nascita</td>
                        <td><?php echo $data_nascita?></td>
                    </tr>
                    <tr>
                        <td>Sesso</td>
                        <td><?php echo $sesso?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $email?></td>
                    </tr>
                    <tr>
                        <td>Città</td>
                        <td><?php echo $citta?></td>
                    </tr>
                    <tr>
                        <td>CAP</td>
                        <td><?php echo $cap?></td>
                    </tr>
                    <tr>
                        <td>Via e Numero Civico</td>
                        <td><?php echo "$via $numero_civico"?></td>
                    </tr>
                    <tr>
                        <td>Numero di telefono</td>
                        <td><?php echo $numero_telefono?></td>
                    </tr>
                    <tr>
                        <td>Professione</td>
                        <td><?php echo $work?></td>
                    </tr>
                    <tr>
                        <td>Hobby</td>
                        <td><?php echo $hobby?></td>
                    </tr>
                    <tr>
                </tbody>
            </table>
            <div style="margin-top: 20px;">
                <form method="post" action="register.php" style="display:inline;">
                    <input type="hidden" name="restore" value="true">
                    <button class="btn waves-effect waves-light teal" style="background-color:rgb(211, 21, 21) !important; margin-right: 10px;">Correggi</td>
                </form>
                
                <form method="post" action="../php/register_user.php" style="display:inline;">
                    <input type="hidden" name="register" value="true">
                    <button class="btn waves-effect waves-light teal">Avanti</td>
                </form>
            </div>
        <?php 
            elseif($request_valid && !$data_valid):
                Header("Location: register.php?error");
            else:
                Header("Location: register.php");
            endif;
        ?>
            
        </div>
    </div>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
</body>
</html>