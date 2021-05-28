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
                    <p class="fs-4">Tracking</p>
                </div>
                <div class="row justify-content-md-center mt-3">
                    <div class="col col-lg-7">
                        <form name="SinEnter" action="track.php" method="POST">                           
                            <div class="input-group mb-3">                                
                                <span class="input-group-text" id="basic-addon1">Tracking No.</span>
                                <input type="text" class="form-control" id="trackingNo" name="trackingNo" placeholder="eg. 5012359761254711" required>
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
                <div class="row justify-content-md-center mt-3">
                    <p class="fs-4">Upload</p>
                </div>  
                <div class="row justify-content-md-center mt-3">                    
                    <div class="col col-lg-7">
                        <form name="upload" action="upload.php" method="POST" enctype="multipart/form-data">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="file" id="toMySQL" accept=".csv">
                                <span class="input-group-text" id="basic-addon1">Type</span>
                                <select class="form-select" id="type" name="type">
                                    <option value="AdHoc">AdHoc</option>
                                    <option value="Batch">Batch</option>
                                </select>
                                <button type="submit" class="btn btn-danger">Upload</button>                            
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