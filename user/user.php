<?php
require 'partials/header.php';
require 'partials/topbar.php';
require 'partials/sidebar.php';

if(isset($_POST['save']))
{
    $data['city']=$_POST['city'];
    $data['area']=$_POST['area'];
    $data['description']=htmlspecialchars($_POST['description']);
    $data['created_by']=$_SESSION['uid'];
    
    if(Property::addProperty($data))
    {
        header ("location: listings.php");
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
                <form method="post">
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
                        <textarea class="form-control" id="description" rows="9" placeholder="Type the description (Max characters: 500)" name="description" value="<?php echo $property['description']?>"  required></textarea>
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
require 'partials/footer.php';

?>
