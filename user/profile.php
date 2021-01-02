<?php
require 'partials/header.php';
require 'partials/topbar.php';
require 'partials/sidebar.php';
$path= ROOT_PATH."/images/users/";
if(isset($_GET['userid']))
{
    $user= getRowById("users",$_GET['userid']);
    $user=$user[0];
}
if(isset($_POST['update']))
{
    $data['fname']=$_POST['fname'];
    $data['lname']=$_POST['lname'];
    $data['email']=$_POST['email'];
    $data['phone']=$_POST['phone'];
    $data['membership']=$_POST['membership'];
    $data['role']=$_POST['usertype'];
    $data['id']=$_POST['id'];
    if(isset($_POST['password']) && $_POST["password"]!=="")
    {
      $data['password']=md5($_POST['password']); 
    }
    else
     {
         $data['password']="0";
     }
    if(User::UpdateUser($data))
    {
        $user= getRowById("users",$_POST['id']);
        $user=$user[0];
    }
}
$user['photo']=BASE_URL."images/users/".$user['photo'];
if(isset($_FILES['image'])){
    $user= getRowById("users",$_POST['uid']);
    $user=$user[0];

      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
     
      $temp = explode(".", $_FILES["image"]["name"]);
      $newfilename = $user['id']."_".round(microtime(true)) . '.' . end($temp);
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp, $path.$newfilename);
          $data['id']=$user['id'];
          $data['photo']=$newfilename;
        if(User::UpdatePhoto($data))
        {
            $user['photo']=BASE_URL."/images/users/".$newfilename;
        }
      }else{
         print_r($errors);
      }
   }

?>
<?php if(isset($_GET['userid']) || isset($_POST['update'])):?>
<main>
    <div class="container-fluid">
        <h5 class="mt-4">Howdy <?php echo $user['fname'] ?> ?</h5>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">MyProfile</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>My Info</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <style>
                            .user-img img {
                                width: 200px;
                                height: 200px;
                                background-color: grey;
                                border-radius: 100px
                            }

                            .btn-file {
                                margin-top: 20px;
                                position: relative;
                                overflow: hidden;
                            }

                            .btn-file input[type=file] {
                                position: absolute;
                                top: 0;
                                right: 0;
                                min-width: 100%;
                                min-height: 100%;
                                font-size: 100px;
                                text-align: right;
                                filter: alpha(opacity=0);
                                opacity: 0;
                                outline: none;
                                background: white;
                                cursor: inherit;
                                display: block;
                            }

                        </style>
                        <div class="user-img">
                            <img class="" id="userprofile" src="<?php echo $user['photo'];?>">
                        </div>

                        </script>
                        <?php if($_SESSION['uid']==$user['id']): ?>
                        <form id="imageform" class="md-form" method="post" enctype="multipart/form-data" action="">
                            <label class="btn btn-default btn-file btn-success">
                                Upload Picture<input id="image" type="file" style="display: none;" name="image" accept="image/*">
                            </label>
                            <input type="hidden" value="<?php echo $user['id']?>" name="uid">
                        </form>
                        <?php endif ?>
                    </div>
                    <div class="col-md-8">
                        <?php if($user['membership']=="paid"):?>
                        <span class="badge badge-success"><i class="fa fa-check"></i> Verified</span>
                        <?php else: ?>
                        <span class="badge badge-primary"><i class="fa fa-times"></i> NotVerified</span>
                        <?php endif;?>
                        <form method="post" id="updateform">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $user['fname']?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $user['lname']?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']?>">
                                </div>
                            </div>
                            <?php if($_SESSION['role']=="admin"):?>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="membership">Membership</label>
                                    <select id="membership" class="form-control" name="membership">
                                        <option value="free" <?php if($user['membership']=="free") echo "selected"?>>Free</option>
                                        <option value="paid" <?php if($user['membership']=="paid") echo "selected"?>>Paid</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="usertype">User type</label>
                                    <select id="usertype" class="form-control" name="usertype">
                                        <option value="agent" <?php if($user['role']=="agent") echo "selected"?>>Agent</option>
                                        <option value="admin" <?php if($user['role']=="admin") echo "selected"?>>Admin</option>
                                    </select>
                                </div>
                            </div>
                            <?php elseif($_SESSION['role']=="agent"):?>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="membership">Membership</label>
                                    <input type="text" class="form-control" id="membership" name="membership" value="<?php echo $user['membership']?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="usertype">User Type</label>
                                    <input type="text" class="form-control" id="usertype" name="usertype" value="<?php echo $user['role']?>" readonly>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" class="form-control" id="c-password" name="c-password" value="">
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo $user['id']?>" name="id">
                            <button type="submit" class="btn btn-success float-right" name="update">Update Profile</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
<?php endif;?>
<?php
require 'partials/scripts.php';
?>
<script>
    //option A
    $("#updateform").submit(function(e) {
        if ($("#password").val() != '' && $("#password").val() !== $("#c-password").val()) {
            e.preventDefault(e);
            alert("Password must match!");
            return false;
        }
    });
    $("#image").change(function(e){ 
        $("#imageform").submit();
    });

</script>
<?php
require 'partials/footer.php';

?>
