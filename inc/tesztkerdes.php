<?php

class TesztKerdes {
    public $tkid = 0;
    public $kerdestxt; 
    public $kerdeshtml;
    public $kerdesbin;
    public $tipus;     //egyszeres választás, töbszörös
    public $kategoria; // angol, biológia, történelem
    public $nehezseg;    

    // Osztály változó 
    public static $KerdesTipusok    = array("egyszeres","többszörös");
    public static $KerdesKategoriak = array("angol","biológia","matematika","történelem");

    public function __construct($kerdestxt = "", $tipus ="", $kategoria = "", $nehezseg = "" ) {
        $this->kerdestxt = $kerdestxt; 
        $this->tipus     = $tipus;
        $this->kategoria = $kategoria;
        $this->nehezseg  = $nehezseg;       
    } 
    
    public static function  GetTesztKerdes($tkid){
        global $db;
        if (false) {$db = new PDO();}
        $stmt = $db->prepare("select * from tesztkerdesek WHERE tkid = ?");           
        $stmt->execute(array($tkid));        
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "TesztKerdes");
        $row = $stmt->fetch();
        return $row;
    }   

    public static function  GetTesztKerdesek(){
        global $db;
        if (false) {$db = new PDO();}
        $stmt = $db->prepare("select * from tesztkerdesek");           
        $stmt->execute(array());        
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "TesztKerdes");
        // Tesztkerdes tpus osztályokat ad vissza
        $rows = $stmt->fetchAll();
        return $rows;
    }   
    
    // CRUD (create, update, delete)    
    public function Insert(){
        global $db;
        $stmt = $db->prepare("INSERT INTO tesztkerdesek(kerdestxt,kerdeshtml,kerdesbin,tipus,kategoria,nehezseg)".
                             "VALUES(?,?,?,?,?,?)");           
        $stmt->execute(array($this->kerdestxt,$this->kerdeshtml,$this->kerdesbin,$this->tipus,$this->kategoria,$this->nehezseg));                
        // Id beállítása Insert után               
    }

    public function Update(){
        global $db;
        $stmt = $db->prepare("UPDATE tesztkerdesek ".
                             " SET kerdestxt = ?, kerdeshtml = ?, kerdesbin = ?, ".
                             "     tipus = ?, kategoria = ?, nehezseg = ?".
                             " WHERE tkid = ?");           
        $stmt->execute(array($this->kerdestxt,$this->kerdeshtml,$this->kerdesbin,$this->tipus,$this->kategoria,$this->nehezseg, $this->tkid));                
    }
    public function Delete(){
        global $db;
        $stmt = $db->prepare("DELETE FROM tesztkerdesek WHERE tkid = ?");           
        $stmt->execute(array($this->tkid));                        
    }            
    
    public static function TesztkerdesForm($isposted = false,
                                           $tkid=0,$kerdestxt = "", $tipus ="", 
                                           $kategoria = "", $nehezseg = "" ) {
        $uzenet  = array();
        $iserror = false;
        if (!$isposted && $tkid<>0){
          $teszt_kerdes = self::GetTesztKerdes($tkid);         
        }else {
          $teszt_kerdes = new TesztKerdes($kerdestxt, $tipus, $kategoria, $nehezseg );
          $teszt_kerdes ->tkid = $tkid;
        }        
        if ($isposted){
            if (strlen($kerdestxt) == 0)
                $uzenet[] = create_uzi("Hiányzó tesztkérdés","error");
            
            if (count($uzenet) ==0) {
                if ($tkid == 0){
                    $teszt_kerdes->Insert();
                    $uzenet[] = create_uzi("Sikeres felvitel!","accept");
                }else {
                    $teszt_kerdes->Update();                    
                    $uzenet[] = create_uzi("Sikeres módosítás!","accept");
                }
            }else $iserror = TRUE;
        }
        
        print "<head><meta charset='UFTf-8'></head>";
        print "<div id='tesztkerdesform'> ";       
        foreach ($uzenet as $uzi) {
            print $uzi;
        }

        if (!$isposted || $iserror)
        {               
            print "<form action='#' method='post'>";
            print "<input type='hidden' name='tkid' id='tkid' value='$tkid'>";            
            print "<table border='4'>";
            print "        <tr>";
            print "            <td>Kérdés</td>";
            print "            <td><input class='editmezo' type='text' name='kerdestxt' id='kerdestxt' value='$teszt_kerdes->kerdestxt'></td>";
            print "        </tr>";            
            // Kérdés típus
            print "        <tr>";
            print "            <td>Típus</td>";
            print "            <td>";
            print "             <select name='tipus' id='tipus'>";
            foreach (self::$KerdesTipusok as $tk) {
                print "<option value='$tk' ".($tk==$teszt_kerdes->tipus ? "selected='selected'" : "").">$tk</option>";                              
            }
            print "             </select>";            
            print "            </td>";            
            print "        </tr>";            

            // Kategória
            print "        <tr>";
            print "            <td>Kategória</td>";
            print "            <td>";
            print "             <select name='kategoria' id='kategoria'>";
            foreach (self::$KerdesKategoriak as $kk) {
                print "<option value='$kk' ".($kk==$teszt_kerdes->kategoria ? "selected='selected'" : "").">$kk</option>";                                
            }
            print "             </select>";            
            print "            </td>";            
            print "        </tr>";                       
            
            print "        <tr>";
            print "            <td>Nehézség</td>";
            print "            <td><input class='editmezo' type='text' name='nehezseg' id='nehezseg' value='$teszt_kerdes->nehezseg'></td>";
            print "        </tr>";            
            print "        <tr>";
            print "            <td colspan='2' align='center'>";
            print "                <input type='button' name='elkuld' id='elkuld' value='Mentés' onClick='Save_TesztKerdesForm()'>";
            print "            </td>";
            print "        </tr>";                                    
            print "    </table>";
            print "  </form>"; 
        }    
        print " </div> ";                    
    }
 
    public static function OsszsTesztkerdesForm( ) {
     
        print "<head><meta charset='UFTf-8'></head>";
        print "<div id='osszestesztkerdesform'> ";       

        print "<table border='1'>";
        print "        <tr>";
        print "            <th>tkid</th>";
        print "            <th>Kérdés</th>";
        print "            <th>Típus</th>";
        print "            <th>Kategória</th>";
        print "            <th>Nehézség</th>";        
        print "        </tr>";
        $row = self::GetTesztKerdesek();
        foreach ($row as $tk) {
            print "        <tr>";
            print "            <td>$tk->tkid</td>";
            print "            <td><a href='#' onClick='Load_TesztKerdesForm($tk->tkid)'>$tk->kerdestxt</a></td>";
            print "            <td>$tk->tipus</td>";
            print "            <td>$tk->kategoria</td>";
            print "            <td>$tk->nehezseg</td>";        
            print "        </tr>";          
        }
        print "</table>";     
        print " </div> ";      
    } 
}

