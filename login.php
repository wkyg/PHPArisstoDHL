<!doctype html>
<html lang="en">
    <?php
        include_once "header.php";
    ?>
    <body>        
        <main class="container text-center mt-5">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col col-lg-5">     
                        <a href="index.php"><img src="logo-52.png" class="img-fluid" height="200" width="200" alt="arissto"></a>                                            
                    </div>                    
                </div>
                <div class="row justify-content-md-center mt-3">
                    <p class="fs-4">Login</p>
                </div>
                <div class="row justify-content-md-center mt-3">
                    <div class="col col-lg-7">
                        <form name="SinEnter" action="log.php" method="POST">                           
                            <div class="input-group mb-3">                                
                                <span class="input-group-text" id="basic-addon1">Username</span>
                                <input type="text" class="form-control" id="user" name="user" placeholder="username" required>
                                <span class="input-group-text" id="basic-addon1">Password</span>
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="password" required>
                                <button type="submit" class="btn btn-danger">Login</button>
                            </div>
                        </form>
                    </div>                                       
                </div>
            </div>
        </main> 
        <?php
            include_once "footer.php";
        ?>        
    </body>
</html>