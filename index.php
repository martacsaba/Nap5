<?php
 // Inicializációs rész  
 // az include mindig beincludol
 include_once 'inc/init.php';
 
 // Ide jön majd a lapszintű jogosultságkezelés
 // felhasználó validálás 
 include_once 'inc/head.php';
?>
 <script type="text/javascript">
//     jQuery()ready(
//         function ()
//         {   
//         }       
//     ) 
 </script>
 <title>Próba</title>        
<?php
 include_once 'inc/header.php';
 include_once 'inc/menu.php';    
?>  
 <div id="middle">
    <?php 
        // Ide jön a kód
        show_uzenet();
        
        //print md5($salt."123456");
        //TesztKerdes::OsszsTesztkerdesForm();
        /*$tk = new TesztKerdes("mennyi 2+2",
                             TesztKerdes::$KerdesTipusok[0],   
                             TesztKerdes::$KerdesKategoriak[1],
                             1.0);
        $tk->Insert();*/
        //$tk = TesztKerdes::GetTesztKerdes(2);
        //print_r($tk);
        //$tk->kerdestxt = "Mennyi a töketlen fecske?";
        //$tk->Update();
        //$tk->Delete(); 
    ?>
 </div>                
<?php
 include_once 'inc/footer.php';
?>    