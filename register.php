<?php 
session_start();
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
                        
                        if(isset($_POST['regBtn'])){
                            if(register()){
                               echo acceptRegister();
                            }
                        }
                        ?>
                            <form action="" method="post" enctype="multipart/form-data">
                            <h4>Moon Register</h4>
                                <div class="form-group mb-3 ">
                                    <label for="name">Username</label>
                                    <input type="text" id="name" required class="form-control <?php echo getError('name')?"is-invalid":"" ?>" name="name" value="<?php echo oldData('name') ?>">
                                    <?php if(getError('name')){ ?>
                                    <small class="text-danger"><?php echo getError('name') ?></small>
                                    <?php }?>
                                </div>
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
                                <div class="form-group mb-3">
                                    <label for="cpassword">Confirm password</label>
                                    <input type="password" id="cpassword" required class="form-control <?php echo getError('cpassword')?"is-invalid":"" ?>" name="cpassword" value="<?php echo oldData('cpassword') ?>">
                                    <?php if(getError('cpassword')){ ?>
                                    <small class="text-danger"><?php echo getError('cpassword') ?></small>
                                    <?php }?>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="image">Profile Image</label>
                                    <input type="file" id="image" required class="form-control <?php echo getError('image')?"is-invalid":"" ?>" name="image" value="<?php echo oldData('image') ?>">
                                    <?php if(getError('image')){ ?>
                                    <small class="text-danger"><?php echo getError('image') ?></small>
                                    <?php }?>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="number">Phone</label>
                                    <input type="number" id="number" required class="form-control <?php echo getError('phone')?"is-invalid":"" ?>" name="number" value="<?php oldData('number') ?>">
                                    <?php if(getError('phone')){ ?>
                                    <small class="text-danger"><?php echo getError('phone') ?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group mb-4">
                                    <label >Gender</label>

                                    <div class="d-flex justify-content-evenly">
                                        <?php foreach($genderArr as $g){ ?>
                                            <div class="form-check">
                                            <label id="<?php echo $g ?>_id" class="form-check-label text-capitalize">
                                            <input type="radio"  class="form-check-input " name="gender" id="<?php echo $g ?>_id" <?php echo oldData("gender")===$g?"checked":"" ?> value="<?php echo $g ?>">
                                            <?php echo $g ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>

                                    <?php if(getError('gender')){ ?>
                                    <small class="text-danger"><?php echo getError('gender') ?></small>
                                    <?php } ?>
                                </div>
                                <button class="btn btn-primary text-uppercase mb-3" name="regBtn">sign up</button>
                                <div class="text-center" >
                                    <p>Already have an account? <a href="login.php" class="text-decoration-none text-primary">Log in</a></p>
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