function Load_ChangePasswordForm(){
    $("#middle").load("changepasswordform.php",                      
    
        // Anonymus függvény 
        function () {
           // Visszatér az adott elemmel 
           $("#changepasswordform").hide().show(500);           
        }
    );
}
// 

function Load_TesztKerdesForm(tkid){
    // Html tartalom betöltése php-ből
    if (typeof tkid=='undifened') tkid=''; else tkid = '?tkid='+tkid;
    $("#middle").load("tesztkerdesform.php"+tkid,                      

        // Anonymus függvény 
        function () {
           // Visszatér az adott elemmel 
           $("#tesztkerdesform").hide().show(500);           
        }
    );    
}

function Load_OsszesTesztKerdesForm(){
    // Html tartalom betöltése php-ből
    $("#middle").load("osszestesztkerdesform.php",                      
    
        // Anonymus függvény 
        function () {
           // Visszatér az adott elemmel 
           $("#osszestesztkerdesform").hide().show(500);           
        }
    );
}

function Save_ChangePasswordForm() {    
    
    /*
    var oldpassword = $("#oldpassword").val();
    var password    = $("#password").val();
    var password2   = $("#password2").val();
    var o = new Object();
    o.oldpassword = oldpassword;
    o.password    = password;
    o.password2   = password2;
    */    
    $.post( "changepasswordform.php", 
            // Javascript objektumot hozunk létre
            { 
                oldpassword : $("#oldpassword").val(),
                password    : $("#password").val(),
                password2   : $("#password2").val()                
            }, 
            function(data) {
                $("#changepasswordform").html(data);
                $("#changepasswordform").hide().show(500);           
            }
    ); 
}

function Save_TesztKerdesForm() {    
    
    /*
    var oldpassword = $("#oldpassword").val();
    var password    = $("#password").val();
    var password2   = $("#password2").val();
    var o = new Object();
    o.oldpassword = oldpassword;
    o.password    = password;
    o.password2   = password2;
    */    
    $.post( "tesztkerdesform.php", 
            // Javascript objektumot hozunk létre
            { 
                tkid      : $("#tkid").val(),
                kerdestxt : $("#kerdestxt").val(),
                tipus     : $("#tipus").val(),
                kategoria : $("#kategoria").val(),
                nehezseg  : $("#nehezseg").val()
            }, 
            function(data) {
                $("#osszestesztkerdesform").hide();                
                $("#tesztkerdesform").html(data);
                $("#tesztkerdesform").hide().show(500);      
                Load_OsszesTesztKerdesForm();
            }
    ); 
}

// Globális ajax érvényes az egész dokumentumra
$(document).ajaxStart(
    function () {
        $.blockUI( {message: "<h3><img src='img/indicator.gif'>Kérem várjon...</h3>"})
    }
);

$(document).ajaxStop(
    function () {
        $.unblockUI();
    }
);
