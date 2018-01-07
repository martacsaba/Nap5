<?php
    function create_uzi($szoveg, $tipus = "warning") {
        return "<div class=' $tipus'>$szoveg</div>";
    }
    
    function show_uzenet() {
        if (isset($_SESSION["uzenet"]) && is_array($_SESSION["uzenet"])) {
            foreach ($_SESSION["uzenet"] as $uzi) {        
                print $uzi;   
            }
        }
        unset($_SESSION["uzenet"]);
    } 
?>