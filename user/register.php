<?php
require '../config.php';
require '../vendor/users.php';
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{
    header ("location:index.php");
}
if(isset($_POST['login']))
{
    $data['email']=$_POST['email'];
    $data['password']=$_POST['password'];
    $user=User:: getuser($data);
    if(count($user)>0)
    {
        $_SESSION['loggedin']=true;
        $_SESSION['uid']=$user['id'];
        $_SESSION['mtype']=$user['membership'];
        $_SESSION['role']=$user['role'];
        $_SESSION['email']=$data['email'];
    }
    else
    {
         echo "<script>alert('Try correct login info!');</script>";
    }
    
}
if(isset($_POST['signup']))
{
    $data['fname']=$_POST['fname'];
    $data['lname']=$_POST['lname'];
    $data['password']=md5($_POST['password']);
    $data['email']=$_POST['email'];
    $data['phone']=""; 
    if(User::isAlreadyExist($data)){
      echo "<script>alert(User with this email already exists!);</script>";   
    }
    else{
        if(User::addUser($data)===true)
            header ("location: login.php");
        else
         echo "<script>alert(Error in Creating your account!);</script>";
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
    <title>Real Estate Site</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form id="signupform" method="post">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small mb-1" for="inputFirstName">First Name</label><input class="form-control py-4" id="fname" type="text" placeholder="Enter first name" name="fname"/></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small mb-1" for="inputLastName">Last Name</label><input class="form-control py-4" id="lname" type="text" placeholder="Enter last name" name="lname"/></div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email" /></div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="password" type="password" placeholder="Enter password" name="password"/></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Confirm Password</label><input class="form-control py-4" id="c-password" type="password" placeholder="Confirm password" name="c-passsword"/></div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-4 mb-0">
                                            <input type="submit" name="signup" id="signup" value="Create Account" class="btn btn-primary btn-block">
                                        
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="register.html">Have an account? Go to login</a></div>
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
    <script>
         //option A
            $("#signupform").submit(function(e){
                if($("#password").val()!==$("#c-password").val())
                {
                     e.preventDefault(e);
                    alert("Password must match!");return false;
                }
            });
    </script>
</body></html>
