
<div class="row">
    <div class="col-lg-8">
        <?php
            include 'carouselLogin.php';
        ?>
    </div>
    <div class="col-lg-4" style="background-color: whitesmoke; margin:0;">
        <div class="myCenter mt-2">
            <img src="../media/pictures-system/Logo IES.png" height="80px" width="80px" alt="">
        </div>
        <div class="myCenter mt-2">
            <h4 style="font-family: Arial; color: #519259;"><strong>TPM-A System</strong></h4>
            <!-- <h5 style="color: #519259;">Call-Center for Development, Stabilization and Humanitarian Actors</h5> -->
        </div>
        <hr>
        <div class="myCenter mt-2">
            <h5 style="font-family: garamond; color: #519259;">A Platform for Real-Time Third Part Monitoring and Accountability Haversting</h5>
            <!-- <h5 style="color: #519259;"><strong>Real-Time Monitoring & Evaluation Platform</strong></h5> -->
        </div>
        <hr>
        <div class="card mt-4">
            <div class="card-header">
                <i style="color: #008040;" class="fa fa-lock" aria-hidden="true"></i> Login
            </div>
            <div class="card-body">
                
                <form action="../controllers/login/loginController.php" method="POST">
                    <div class="input-group">
                        <span class="input-group-text" id="my-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input class="form-control" type="text" name="tb_nomUtilisateur" placeholder="Username" aria-label="UserName" aria-describedby="my-addon">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text" id="my-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <input class="form-control" type="password" name="tb_motDePasse" placeholder="Password" aria-label="Password" aria-describedby="my-addon">
                    </div>
                    <hr>
                    <button class="btn btn-primary" name="bt_login" type="submit">Sign in</button>

                </form>

            </div>
        </div>
    </div>
</div>