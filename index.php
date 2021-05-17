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
                                <span class="input-group-text" id="basic-addon1">SIN</span>
                                <input type="text" class="form-control" id="sinNo" name="sinNo" placeholder="Please enter your SIN" 
                                data-bs-toggle="popover" data-bs-trigger="focus" title="Invalid Format" 
                                data-bs-content="Please enter the correct format of SIN. eg. MYxxxxxxxSINxxxxx" required>
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
        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))

            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
    </body>
</html>