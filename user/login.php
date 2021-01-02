<?php
session_start();
require '../config.php';
require '../vendor/users.php';
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{
    if(time()-$_SESSION['LAST_ACTIVITY']>1800)
     header ("location:index.php");
    else
       header ("location:logout.php");
}
else if(isset($_POST['login']))
{
    $data['email']=$_POST['email'];
    $data['password']=$_POST['password'];
    $user=User:: getuser($data);
    if(count($user)>0)
    {
        $_SESSION['loggedin']="true";
        $_SESSION['uid']=$user[0]['id'];
        $_SESSION['fname']=$user[0]['fname'];
        $_SESSION['mtype']=$user[0]['membership'];
        $_SESSION['role']=$user[0]['role'];
        $_SESSION['email']=$user[0]['email'];
        $_SESSION['LAST_ACTIVITY']=time();
        header ("location: index.php");
    }
    else
    {
         echo "<script>alert('Try correct login info!');</script>";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Real Estates</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="form-group"><label class="small mb-1" for="email">Email</label><input class="form-control py-4" id="email" type="email" placeholder="Enter email address" name="email" required/></div>
                                        <div class="form-group"><label class="small mb-1" for="password">Password</label><input class="form-control py-4" id="password" type="password" placeholder="Enter password" name="password" required /></div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">

                                            <!--<a class="small" href="password.html">Forgot Password?</a>-->

                                            <input type="submit" name="login" value="Log in" class="btn btn-primary btn-block" />
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Real Estate 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body></html>
