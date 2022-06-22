<?php 
require_once "core/isLogin.php" ;
require_once "core/base.php" ;
require_once "core/function.php" ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moonlight</title>
    <link rel="stylesheet" href="<?php echo $url ?>assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?php echo $url ?>assets/css/style.css" >

</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="group-form">
                            <div class="img-holder">
                                <img src="<?php echo $url ?>assets/img/moon.svg" width="300px" alt="">
                            </div>
                            <?php 
                        
                        if(isset($_POST['loginBtn'])){
                            if(login()){
                               echo acceptLogin();
                            }
                        }
                        ?>
                            <form action="" method="post">
                            <h4>Moon Login</h4>
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" required class="form-control <?php echo getError('email')?"is-invalid":"" ?>" name="email" value="<?php echo oldData('email') ?>">
                                    <?php if(getError('email')){ ?>
                                    <small class="text-danger"><?php echo getError('email') ?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" required class="form-control <?php echo getError('password')?"is-invalid":"" ?>" name="password" value="<?php echo oldData('password') ?>">
                                    <?php if(getError('password')){ ?>
                                    <small class="text-danger"><?php echo getError('password')?></small>
                                    <?php }?>
                                </div>
                                <button class="btn btn-primary text-uppercase mb-3" name="loginBtn">Log in</button>
                                <div class="text-center" >
                                <a href="register.php" class="text-decoration-none" style="color: #000;">Create an account</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php clearError() ?>
</html>