<?php
    require("../php/validator.php");
    $nome=$cognome=$data_nascita=$sesso=$email=$citta=$cap=$via=$numero_civico=$numero_telefono=$work=$hobby = "";
    
    //REQUEST FROM controllo.php FOR RESTORING FORM DATA
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        echo "<script>alert('post request detected');</script>";
        if(isset($_POST["restore"])){
            //RESTORE REQUEST APPROVED
            echo "<script>alert('restore request approved');</script>";
            if(isset($_COOKIE["restore"])){
                //RESTORE COOKIES APPROVED
                echo "<script>alert('entered restore-data mode');</script>";
                $nome = $_COOKIE["first_name"];
                $cognome = rawurldecode($_COOKIE["last_name"]);
                $data_nascita =  $_COOKIE["data_nascita"];
                $sesso =  $_COOKIE["sesso"];
                $email =  $_COOKIE["email"];
                $citta =  $_COOKIE["citta"];
                $cap =  $_COOKIE["cap"];
                $via =  $_COOKIE["via"];
                $numero_civico =  $_COOKIE["numero_civico"];
                $numero_telefono =  $_COOKIE["phone"];
                $work =  $_COOKIE["work"];
                $hobby =  $_COOKIE["hobby"];
                
                //VALIDATE FOR CONFORMITY
            }
            else{
                echo "<script>alert('no restore flag');</script>";
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }

    function check_restore_cookies(){
        global $_COOKIE;
        if(isset($_COOKIE["first_name"]) && isset($_COOKIE["last_name"]) && isset($_COOKIE["data_nascita"]) && isset($_COOKIE["sesso"])
        && isset($_COOKIE["email"]) && isset($_COOKIE["citta"]) && isset($_COOKIE["cap"]) && isset($_COOKIE["via"]) && isset($_COOKIE["numero_civico"])
        && isset($_COOKIE["phone"]) && isset($_COOKIE["work"]) && isset($_COOKIE["hobby"])){
            return true;
        }
        return false;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css and bootstrap for notify-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
        <div class="container white z-depth-2" >
                <div id="register" class="col s12" style="padding: 10px;">
                    <form class="col s12" method="post" id="registerForm" action="controllo.php">
                        <div class="form-container">
                            <h3 class="teal-text">Benvenuto.</h3>
                            
                            <!--Nome e cognome-->
                            <div class="row">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">person</i>
                                    <input id="first_name" name="first_name" type="text" class="validate" data-length="50" value=<?php echo $nome?>>
                                    <label for="first_name">Nome</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="last_name" name="last_name" type="text" class="validate" data-length="50" value=<?php echo $cognome?>>
                                    <label for="last_name">Cognome</label>
                                </div>
                            </div>
                            <!--Data di nascita e Sesso-->
                            <div class="row">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">perm_contact_calendar</i>
                                    <input id="data_nascita" type="date" name="data_nascita" value=<?php echo $data_nascita?>>
                                    <label for="data_nascita">Data di nascita</label>
                                </div>
                                <div class="input-field col s6">
                                    <p style="display:inline-block">
                                        <label>
                                            <input name="sesso" type="radio" value="m" checked />
                                            <span>Maschio</span>
                                        </label>
                                    </p>
                                    <p style="display:inline-block">
                                        <label>
                                            <input name="sesso" type="radio" value="f"/>
                                            <span>Femmina</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">contact_mail</i>
                                    <input id="email" type="email" class="validate" name="email" value=<?php echo $email?>>
                                    <label for="email">Email</label>
                                </div>
                            </div>

                            <!--Citta e CAP-->
                            <div class="row">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">location_city</i>
                                    <input id="citta" type="text" class="validate" name="citta" value=<?php echo $citta?>>
                                    <label for="citta">Citta</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="cap" type="number" class="validate" min=1 name="cap" value=<?php echo $cap?>>
                                    <label for="cap">CAP</label>
                                </div>
                            </div>

                            <!--Via e Numero civico-->
                            <div class="row">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">location_on</i>
                                    <input id="via" type="text" class="validate" name="via" value=<?php echo $via?>>
                                    <label for="via">Via</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="numero_civico" type="text" class="validate" name="numero_civico" value=<?php echo $numero_civico?>>
                                    <label for="numero_civico">Numero civico</label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="phone" type="text" class="validate" name="phone" value=<?php echo $numero_telefono?>>
                                    <label for="phone">Telefono</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">work</i>
                                    <input id="professione" type="text" class="validate" name="work" value=<?php echo $work?>>
                                    <label for="professione">Professione</label>
                                </div>
                            </div>

                            <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">rowing</i>
                                        <textarea id="hobby" class="materialize-textarea" name="hobby"><?php echo $hobby?></textarea>
                                        <label for="hobby">Hobby</label>
                                    </div>
                                </div>
                            <center>
                                <div class="row"><span style="color: red !important;" id="errorMessage"></span></div>
                                <div class="btn waves-effect waves-light teal" type="submit" name="action" style="background-color:rgb(211, 21, 21) !important">Cancella</div>
                                <div class="btn waves-effect waves-light teal"  type="submit" id="avantiButton" name="action" value="register">Avanti</div>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    
    <!--Validator Classes-->
    <script src="../js/validator.js"></script>
    <script src="../js/register.js"></script>

    <script>
    $(document).ready(function() {
        addListeners();
        $("#avantiButton").click(function(){
            if(checkAnyError()){
                $("#errorMessage").css("color","green");
                $("#errorMessage").text("All inputs are valid! You can continue with the registration process").show().fadeIn(1000);
                $('#registerForm').submit();
            }
            else{
                $("#errorMessage").css("color","red");
                $("#errorMessage").text("There are one or more errors in your inputs, please fix them for continue the registration process").show().fadeIn(2000,function(){
                    $("#errorMessage").fadeOut(5000);
                });
            }
        });
    });
    </script>
</body>
</html>
    