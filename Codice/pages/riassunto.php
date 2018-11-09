<?php
    session_start();
    require_once("../php/CSVisualizer.php");
    $csv_utils = new CSVisualizer();
    $totalUsers = 0;

    $registered = false;
    if(isset($_SESSION["registered"])){
        if($_SESSION["registered"] == true){
            //REGISTRATO CORRETTAMENTE
            $registered = true;
        }
    }

    if(!$registered){
        header("Location: register.php");
    }


    function buildTable(){
        global $csv_utils,$totalUsers;
        $users_day_path = "../registrazioni/".$csv_utils->get_current_day_filename();
        $users_day = $csv_utils->csv_to_array($users_day_path);

        $totalUsers = count($users_day);
        $table_structure = "";
        if($totalUsers > 0){
            foreach($users_day as $user){
                $table_structure .="<tr>";
                $table_structure .=buildTableRow($user);
                $table_structure .="</tr>";
            }
            return $table_structure;
        }
        else{
            return false;
        }
    }

    function buildTableRow(array $data){
        $row ="";
        foreach($data as $d){
            $row .= "<td>$d</td>";
        }

        return $row;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <!--Import custom css file-->
    <link rel="stylesheet" href="../css/style.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
        <header>
            <h1 class="flow-text center-align" id="riassunto-header">Utenti registrati oggi</h1>
        </header>
        
        <main>
            <div class="col-sm-11" style="padding:10px">
            <table class="responsive-table highlight">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Data di nascita</th>
                            <th>Sesso</th>
                            <th>Email</th>
                            <th>Città</th>
                            <th>CAP</th>
                            <th>Via</th>
                            <th>Numero Civico</th>
                            <th>Numero di telefono</th>
                            <th>Professione</th>
                            <th>Hobby</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            echo buildTable();
                        ?>
                    </tbody>
                </table>
            </div>
            
        </main>

        <footer class="page-footer" style="background-color: white !important;">
            <center>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" style="margin: 30px;">
                    <input type="hidden" name="logout" value="true">
                    <button class="btn waves-effect waves-light teal" id="logout-button" style="background-color:rgb(211, 21, 21)">Esegui il logout</td>
                </form>
            </center>
        </footer>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>

    <script>
        function scrollToBottom(){
            window.scrollTo(0,document.body.scrollHeight);
            console.log("[INFO] Scrolled to bottom");
        }
    </script>
</body>
</html>

<?php
    //LOGOUT REQUEST
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["logout"])){
            echo "<script>window.location.reload();</script>";
            session_destroy();
        }
    }
?>
