<?php
 // Inicializációs rész  
 // az include mindig beincludol
 include_once 'inc/init.php';
 
 // Ide jön majd a lapszintű jogosultságkezelés
 // felhasználó validálás
 
 include_once 'inc/head.php';
?>
 <script type="text/javascript">
     jQuery()ready(
         function ()
         {             
         }       
     ) 
 </script>
 <title>Kijelentkezés</title>        
<?php
 include_once 'inc/header.php';
 include_once 'inc/menu.php';    
?>
 <div id="middle">
    <?php
        // Ide jön a kód
        // összes tartalom megszüntetése 
        session_destroy();
        session_unset();
        print create_uzi("Sikeres kijelentkezés","accept");
        
    ?>     
 </div>                
 
 <script type="text/javascript">  
     setTimeout("window.location='index.php'",3000); // milisecundum    
 </script>>
<?php
  include_once 'inc/footer.php';
?>    