<?php
class User {
        private $Password;
        private $Password2;

        public $login;
        public $nev;
        public $email;
        
        public function __construct($login="", $nev="", $email="") {
            $this->login = trim($login);
            $this->nev   = trim($nev);
            $this->email = trim($email);
        }
        
        function SetPassword($p) {
            $this->Password = trim($p);
        }

        function SetPassword2($p) {
            $this->Password2 = trim($p);
        }        
        
        // helyes user paraméterek
        // min 4 karakter a login
        // név is legyen 5 karakter
        // két password azonos, legalább 6 karakter
        // email cím valid legyen        
        function isValidUserReg() {
            $uzenet = array();
            global $db;
            $stmt = $db->prepare("select count(*) darab from users where login = ?");           
            // Oszlopnév hozzákötése egy változóhoz
            $stmt->bindColumn('darab',$darab);                    
            $stmt->execute(array($this->login));
            $stmt->fetch(PDO::FETCH_BOTH); // Változóba töltődik a megfelelő érték
            
            if ($darab > 0) 
                array_push($uzenet, create_uzi("Ilyen felhasználó név már van!)","error"));                
            if (strlen($this->login) < 4 )
                array_push($uzenet, create_uzi("A felhasználónév túl rövid (min. 4 karakter!)","error"));
            if (strlen($this->nev) < 5 )
                array_push($uzenet, create_uzi("A név túl rövid (min. 5 karakter!)","error"));
            if (strlen($this->Password) < 6 )
                array_push($uzenet, create_uzi("A jelszó túl rövid (min. 6 karakter!)","error"));
            if ($this->Password != $this->Password2 )
                array_push($uzenet, create_uzi("A két jelszó nem azonos!","error"));
            // E-mail validáció
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                array_push($uzenet, create_uzi("Érvénytelen E-mail","error"));                
            }    
            // Létezik-e ez a felhasználó ebben az adatbázisban 
            
            return $uzenet;
        }                
        
        function Insert() {
            // Adatbázisba user beszúrása
            global $db;
            global $salt;
            $stmt = $db->prepare("insert into users(login, passmd5, nev, email) values(?, ?, ?, ?)");           
            $stmt->execute(array($this->login, md5($salt.$this->Password), $this->nev, $this->email));
        }       

        public static function Trylogin($login, $passw) {           
            global $db;
            global $salt;
            $stmt = $db->prepare("select count(*) darab from users where login = ?");           
            // Oszlopnév hozzákötése egy változóhoz
            $stmt->bindColumn('darab',$darab);                    
            $stmt->execute(array($login));
            $stmt->fetch(PDO::FETCH_BOTH); // Változóba töltődik a megfelelő érték            
            if ($darab != 1)                 
            {
                return "Sajnos nincs ilyen felhasználó a rendszerben!";
            } else {
                $stmt = $db->prepare("select nev, passmd5, email from users where login = ?");                   
                $stmt->bindColumn('nev',$nev);                    
                $stmt->bindColumn('passmd5',$passmd5);                    
                $stmt->bindColumn('email',$email);                                    
                $stmt->execute(array($login));
                $stmt->fetch(PDO::FETCH_BOTH);
                if (md5($salt.$passw) != $passmd5) {
                    return "Hibás jelszó!";
                } else{
                    return new User($login, $nev, $email);
                }                
            }               
        }
        
        // Change password függvény létrehozása
        public static function ChangePasswordForm($isposted = false,
                                                  $oldpassword = "",
                                                  $password = "",
                                                  $password2 = ""){
            $uzenet  = array();
            $iserror = false;
            global $salt;
            if ($isposted) {
                // Ide akkor jön program, ha megnyomták a Módosít gombot. Jön egy POST hívás
                // Megpróbálunk belépni
                $trylogin = User::Trylogin($_SESSION["user"]->login, $oldpassword);
                if (is_object($trylogin)) {
                    if (strlen($password) < 6 )
                        array_push($uzenet, create_uzi("A jelszó túl rövid (min. 6 karakter!)","error"));
                    if ($password != $password2 )
                        array_push($uzenet, create_uzi("A két jelszó nem azonos!","error"));                    
                    if ($oldpassword == $password2 )
                        array_push($uzenet, create_uzi("A régi és új jelszó nem lehet azonos!","error"));                    
                    
                    if (count($uzenet)==0) {
                        if (false) {$db = new PDO();}
                        global $db;
                        $stmt = $db->prepare("UPDATE users SET passmd5 = ? WHERE Login = ?");           
                        $stmt->execute(array(md5($salt.$password), $_SESSION["user"]->login));                        
                        $uzenet[] = create_uzi("Sikeres módosítás", "accept");
                    } else $iserror = true;
                } else {
                    // Új elem hozzáadása a tömbhöz. Ugyanaz, mint az array_push
                    $uzenet[] = create_uzi($trylogin, "error");
                }                  
            }

            print "<head><meta charset='UFTf-8'></head>";
            print "<div id='changepasswordform'> ";       
            foreach ($uzenet as $uzi) {
                print $uzi;
            }
            
            if (!$isposted || $iserror)
            {               
                print "<form action='#' method='post'>";
                print "<table border='4'>";
                print "        <tr>";
                print "            <td>Eredeti jelszó</td>";
                print "            <td><input type='password' name='oldpassword' id='oldpassword' value=''></td>";
                print "        </tr>";            
                print "        <tr>";
                print "            <td>Jelszó</td>";
                print "            <td><input type='password' name='password' id='password' value=''></td>";
                print "        </tr>";            
                print "        <tr>";
                print "            <td>Jelszó mégegyszer</td>";
                print "            <td><input type='password' name='password2' id='password2' value=''></td>";
                print "        </tr>";            
                print "        <tr>";
                print "            <td colspan='2' align='center'>";
                print "                <input type='button' name='elkuld' id='elkuld' value='Módosít' onClick='Save_ChangePasswordForm()'>";
                print "            </td>";
                print "        </tr>";                                    
                print "    </table>";
                print "  </form>"; 
            }    
            print " </div> ";                                            
        }        
    }
?>