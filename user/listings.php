<?php
require 'partials/header.php';
require 'partials/topbar.php';
require 'partials/sidebar.php';

if(isset($_GET['post_id']))
{
    $data['pid']=$_GET['post_id'];
    if(Property::deleteProeprty($data))
    {
        echo "<script>alert('Property has been deleted!');</script>";
    }
    else{
        echo "<script>alert('Property could not be deleted!');</script>";
    }
}
if($_SESSION['role']=="admin")
    $properties= Property::getAllProperties();
else
    $properties= Property::getMyProperties($_SESSION['uid']);
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Properties</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Properties</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>View All Properties</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>City</th>
                                <th>Area</th>
                                <th>Description</th>
                                <th>Posted By</th>
                                <th>Post Date</th>
                                <th>Contact</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if(count($properties)<=0)
                            {
                                echo "<tr><td colspan='3'>No Data Found</td></tr>";
                            }
                            else
                            {
                                $count=0;
                                foreach($properties as $property)
                                {
                                    $agentinfo=$database->get("users","*",["id"=>$property['created_by']]);
                                    echo "<tr>";
                                    echo "<td>".++$count."</td>";
                                    echo "<td>".$property['city']."</td>";
                                    echo "<td>".$property['area']."</td>";
                                    echo "<td>".$property['description']."</td>";
                                    echo "<td><a href='profile.php?userid=".$agentinfo['id']."'>".$agentinfo['fname']." ".$agentinfo['lname']."</a></td>";
                                    echo "<td>".$property['created_at']."</td>";
                                    echo "<td>".$agentinfo['phone']."</td>";
                                    if($_SESSION['uid']==$property['created_by'])
                                    {
                                        echo "<td>
                                    <a href=''><i class='fas fa-eye'></i></a>
                                    <a href='post.php?post_id=".$property['pid']."&action=edit'><i class='fas fa-edit'></i></a>
                                    <a href='listings.php?post_id=".$property['pid']."'><i class='fas fa-trash-alt'></i></a>
                                    </td>";
                                    }
                                    echo "</tr>";
                                }
                            }
                            
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require 'partials/scripts.php';
require 'partials/footer.php';

?>
