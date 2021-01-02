<?php
require 'partials/header.php';
require 'partials/topbar.php';
require 'partials/sidebar.php';
 $agents=User::getAllAgents();
?>

<main>
    <div class="container-fluid">
        <h4 class="mt-4">Dashboard</h4>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Agents</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Become Verified Memeber!</div>
            <div class="card-body">
                <h4>Show Images on your Lsiting</h4>
                <p>Buy <b>Subscription</b> and beome th verfiied agent!</p>
                <a herf="#" class="btn btn-success" style="color:#fff;">Contact now</a>
            </div>
        </div>
    </div>
</main>

<?php
require 'partials/scripts.php';
require 'partials/footer.php';

?>
