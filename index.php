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
                        <img src="logo-52.png" class="img-fluid" height="200" width="200" alt="arissto">                    
                    </div>                    
                </div>
                <div class="row justify-content-md-center mt-5">
                    <div class="col col-lg-7">
                        <form name="SinEnter" action="track.php" method="POST">                           
                            <div class="input-group mb-3">                                
                                <span class="input-group-text" id="basic-addon1">SIN</span>
                                <input type="text" class="form-control" name="sinNo" placeholder="Please enter your SIN" required>
                                <span class="input-group-text" id="basic-addon1">Role</span>
                                <select class="form-select" id="roleSelect" name="role">                                    
                                    <option value="cust">Cutomer</option>
                                    <option value="stf">Staff</option>                                    
                                </select>
                                <button type="submit" class="btn btn-danger">Track</button>
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