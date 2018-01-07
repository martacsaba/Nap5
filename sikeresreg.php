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
 <title>Próba</title>        
<?php
 include_once 'inc/header.php';
 include_once 'inc/menu.php';    
?>
 <div id="middle">
    <?php
        // Ide jön a kód
    ?>
     <h2>Köszönjük kedves <?php echo $_SESSION["userreg"]->nev; unset($_SESSION["userreg"]); ?> a regisztrációját!</h2>
 </div>                
<?php
 include_once 'inc/footer.php';
?>    