<?php
    include "dbconn.php";
    include "DHL.php";
    include_once "header.php";

    $sinNo = $_POST["sinNo"];
    $role = $_POST["role"];
?>
<!doctype html>
<html lang="en">
    <body>        
        <main class="container text-center mt-5">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col col-lg-5">   
                        <a href="index.php"><img src="logo-52.png" class="img-fluid" height="200" width="200" alt="arissto"></a>
                    </div>                    
                </div>
                <div class="row justify-content-md-center">
                    <div class="col col-lg-5">
                        <?php                                               
                            getToken();
                            echo "</br>";
                            getTracking($sinNo, $role);
                        ?>                                                
                    </div>                    
                </div>                
            </div>
        </main>
        <?php
            include_once "footer.php";
        ?>
    </body>
</html>

