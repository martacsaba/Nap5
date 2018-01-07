<!-- MENU START -->                
                <div id="left">
                    <h2>Menü</h2>
                    <?php 
                        if (isset($_SESSION["user"])){
                            print "<p>Bejelentkezve:</p>";                            
                            print "<p><b>".$_SESSION["user"]->nev."</b></p>";                                                        
                            print "<ul>";
                            print "<li><a href='index.php'>Főoldal</a></li>";                                                                                                                
                            print "<li><a href='logout.php'>Kijelentkezés</a></li>";                                                        
                            print "<li><a href='#' onClick='Load_ChangePasswordForm()'>Jelszó módosítása</a></li>";
                            print "<li><a href='#' onClick='Load_TesztKerdesForm()'>Új tesztkérdés</a></li>";
                            print "<li><a href='#' onClick='Load_OsszesTesztKerdesForm()'>Összes tesztkérdés</a></li>";
                            print "</ul>";                                                                                    
                        }  else {
                            // Nem vagyunk belépve
                            print "<ul>";
                            print "<li><a href='index.php'>Főoldal</a></li>";                                                                                                                
                            print "<li><a href='register.php'>Regisztráció</a></li>";                                                        
                            print "<li><a href='login.php'>Login</a></li>";                                                                                    
                            print "</ul>";                                                        
                        }
                    ?>
                </div>
<!-- MENU END -->                