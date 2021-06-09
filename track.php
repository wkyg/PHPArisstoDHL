<?php
    include "dbconn.php";
    include "DHL.php";
    include "test.php";
    include_once "header.php";

    $trackingNo = $_POST["trackingNo"];
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
                <div class="row justify-content-md-center mt-3">
                    <?php
                        if($role == "cust"){?>
                            <p class="fs-4">Customer</p><?php
                        }else if($role == "stf"){?>
                            <p class="fs-4">Staff</p><?php
                        }else{?>
                            <p class="fs-4">E R R O R</p><?php
                        }
                    ?>                    
                </div>
                <div class="row justify-content-md-center mt-3">
                    <div class="col col-lg-6">
                        <?php 
                            TestgetToken();                                            
                            //getToken();                           
                            //getTracking($trackingNo, $role);
                        ?>                                                
                    </div>                    
                </div>  
                <div class="row justify-content-md-center mt-3">
                    <p class="fst-italic">
                        Note: Your parcel should arrive within 3 to 7 working days.<br>
                        (*Longer delivery times may be required for remote areas and Public Holidays)
                    </p>                    
                </div>              
            </div>
        </main>
        <?php
            include_once "footer.php";
        ?>
    </body>
</html>

