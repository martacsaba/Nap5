<?php
 // Inicializációs rész  
 // az include mindig beincludol
 include_once 'User.php';
 include_once 'inc/init.php';
 
 // Ide jön majd a lapszintű jogosultságkezelés 
 // felhasználó validálás
 if (isset($_POST['elkuld']))
 {
    //print_r(User::TryLogin($_POST['login'], $_POST['password']));
    $uzenet = array();
    $login = "";
    $password="";
    if (isset($_POST["login"]))    $login =$_POST["login"];
    if (isset($_POST["password"])) $password =$_POST["password"];
    unset($_SESSION["user"]);
    
    // Vagy objektum vagy egyszerű szöveg
    $trylogin = User::TryLogin(trim($login), trim($password));
    if (is_object($trylogin)){
        array_push($uzenet, create_uzi("Sikeres belépés","accept"));
        $_SESSION["uzenet"] = $uzenet;
        $_SESSION["user"] = $trylogin;        
        header("Location: index.php"); exit();
    }else {
        array_push($uzenet, create_uzi($trylogin,"error"));
        $_SESSION["uzenet"] = $uzenet;
        header("Location: login.php"); exit();        
    }   
 }
 
 include_once 'inc/head.php';
?>
 <script type="text/javascript">
     // ha a teljes oldal betöltődött
     $().ready(                
     ) 
 </script>
 <title>Regisztráció</title>        
<?php
 include_once 'inc/header.php';
 include_once 'inc/menu.php';    
?>
 
 <div id="middle">
    <H1>Bejelentkezés</H1>
    <?php
       // Ide jön a kód 
       show_uzenet();
    ?>
    
    <form action="login.php" method="post">
        <table border="1">
            <tr>
                <td>Felhasználó név</td>
                <td><input type='text' name='login' id='login' value=''></td>
            </tr>
            <tr>
                <td>Jelszó</td>
                <td><input type='password' name='password' id='password' value=''></td>
            </tr>            
            <tr>
                <td colspan="2" align='center'>
                    <input type='submit' name='elkuld' id='elkuld' value='Belépek'>
                </td>
            </tr>                                    
        </table>
    </form>
 </div>                
 
<?php
 include_once 'inc/footer.php';
?>    