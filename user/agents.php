<?php
require 'partials/header.php';
require 'partials/topbar.php';
require 'partials/sidebar.php';
 $agents=User::getAllAgents();
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Agent List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Agents</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Agents List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Start date</th>
                                <th>Membership</th>
                                <th>Listings</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                             if(count($agents)<=0)
                                 echo "<tr><td colspan='7'>No Data Found!</td></tr>";
                            else{
                                    foreach($agents as $agent){
                                        $li_count=$count = $database->count("properties", ["created_by" => $agent['id']]);
                                        echo "<tr>";
                                        echo "<td>".$agent['fname']." ".$agent['lname']."</td>";
                                        echo "<td>".$agent['email']."</td>";
                                        echo "<td>".$agent['phone']."</td>";
                                        echo "<td>".$agent['created_at']."</td>";
                                        echo "<td>".$agent['membership']." <a href='profile.php?userid=".$agent['id']."'><i class='fas fa-pencil-alt' style='color:red;font-size:12px;'></i></a></td>";
                                        echo "<td>".$li_count."</td>";
                                        echo "</tr>";
                                    }
                            }
                            ?>
                            <tr>
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
