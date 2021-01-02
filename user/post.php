<?php
require 'partials/header.php';
require 'partials/topbar.php';
require 'partials/sidebar.php';

if(isset($_POST['save']))
{
    $path=ROOT_PATH."/images/";
    $data['city']=$_POST['city'];
    $data['area']=$_POST['area'];
    $data['description']=htmlspecialchars($_POST['description']);
    $data['price']=$_POST['price'];
    $data['img']="false";
    $data['created_by']=$_SESSION['uid'];
     if(isset($_FILES['img1'])){
        $file_name = $_FILES['img1']['name'];
        $file_tmp = $_FILES['img1']['tmp_name'];
        $temp = explode(".", $_FILES["img1"]["name"]);
        $newfilename = $_SESSION['uid']."_".round(microtime(true)) ."1". '.' . end($temp);
        move_uploaded_file($file_tmp, $path.$newfilename);
        $data['img']="true";
         $data['img1']=$newfilename;
    }
    if(isset($_FILES['img2'])){
        $file_name = $_FILES['img2']['name'];
        $file_tmp =$_FILES['img2']['tmp_name'];
        $temp = explode(".", $_FILES["img2"]["name"]);
        $newfilename = $_SESSION['uid']."_".round(microtime(true)) ."2".'.' . end($temp);
        move_uploaded_file($file_tmp, $path.$newfilename);
        $data['img']="true";
        $data['img2']=$newfilename;
    }
    if(isset($_FILES['img3'])){
        $file_name = $_FILES['img3']['name'];
        $file_tmp =$_FILES['img3']['tmp_name'];
        $temp = explode(".", $_FILES["img3"]["name"]);
        $newfilename = $_SESSION['uid']."_".round(microtime(true)) ."3". '.' . end($temp);
        move_uploaded_file($file_tmp, $path.$newfilename);
        $data['img']="true";
        $data['img3']=$newfilename;
    }
    if(!Property::addProperty($data))
    {
        echo "<script>alert('Error in adding listing!');</script>";
    }
}

?>

<!--Add New Post/Proeprty-->
<?php if(isset($_GET['action']) && $_GET['action']=="add"):?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Add New Property</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Add New Property</li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City*</label>
                            <input type="text" class="form-control" id="country" placeholder="City" name="city" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="area">Area*</label>
                            <input type="text" class="form-control" id="area" placeholder="Area" name="area" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Price*</label>
                            <input type="text" class="form-control" id="price" placeholder="price" name="price" required>
                        </div>
                    </div>
                    <style>
                        .user-img img {
                            width: 200px;
                            height: 200px;
                            background-color: grey;
                            border-radius: 10px;
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

                    <?php if($_SESSION['mtype']=="paid"):?>
                    <div class="form-row t">
                        <div class="form-group col-md-4 text-center">
                            <div class="user-img">
                                <img class="" id="img1h" src="?>">
                            </div>
                            <label class="btn btn-default btn-file btn-success">
                                Upload Picture<input id="img1" type="file" style="display: none;" name="img1" onchange="readURL(this,1);" accept="image/*">
                            </label>
                        </div>
                        <div class="form-group col-md-4 text-center">
                            <div class="user-img">
                                <img class="" id="img2h" src="">
                            </div>
                            <label class="btn btn-default btn-file btn-success">
                                Upload Picture<input id="img2" type="file" style="display: none;" name="img2" onchange="readURL(this,2);" accept="image/*">
                            </label>
                        </div>
                        <div class="form-group col-md-4 text-center">
                            <div class="user-img">
                                <img class="" id="img3h" src="?>">
                            </div>
                            <label class="btn btn-default btn-file btn-success">
                                Upload Picture<input id="img3" type="file" style="display: none;" name="img3" onchange="readURL(this,3);" accept="image/*">
                            </label>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="description">Description*</label>
                        <textarea class="form-control" id="description" rows="9" placeholder="Type the description (Max characters: 500)" name="description" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success float-right" name="save">Save</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php endif;?>


<!--Edit Existing Proerpty-->
<?php if(isset($_GET['post_id']) && $_GET['action']=="edit"):
$property=$database->get("properties","*",["id"=>$_GET['post_id'], "LIMIT"=>"1"]);
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Edit Property Details</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Proeprty Details</li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <form method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City*</label>
                            <input type="text" class="form-control" id="country" placeholder="City" name="city" value="<?php echo $property['city'];?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="area">Area*</label>
                            <input type="text" class="form-control" id="area" placeholder="Area" name="area" value="<?php echo $property['area']?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description*</label>
                        <textarea class="form-control" id="description" rows="9" placeholder="Type the description (Max characters: 500)" name="description" value="<?php echo $property['description']?>" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success float-right" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php endif;?>

<?php
require 'partials/scripts.php';
?>
<script>
function readURL(input,i) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img'+i+'h').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php
require 'partials/footer.php';

?>
