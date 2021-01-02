<?php
require 'config.php';
require 'vendor/users.php';
require 'vendor/properties.php';
require 'vendor/functions.php';
session_start();
$properties= Property::getAllProperties();
?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="includes/style.css">
    <title>Real Estate SIte</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#">Real Estate</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <!--<li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>-->
            </ul>
            <?php if (!isset($_SESSION['loggedin'])):?>
            <form class="form-inline my-2 my-lg-0 nav-btn-groups">
                <a class="btn btn-success" href="user/login.php">Login</a>
                <a class="btn btn-success" href="user/register.php">Signup</a>
            </form>
            <?php else: ?>
            <a href="user/index.php" class="btn btn-success">My Profile</a>
            <?php endif; ?>
        </div>
    </nav>
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                </div>

                <div class="table-responsive">
                    <table id="example" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>City</th>
                                <th>Area</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Images</th>
                                <th>Contact</th>
                                <th>Agent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(count($properties)<=0)
                            {
                                echo "<tr><td colspan=''>No Data Found</td></tr>";
                            }
                            else
                            {
                                $count=0;
                                foreach($properties as $property)
                                {
                                    $agentinfo=$database->get("users","*",["id"=>$property['created_by']]);
                                    $Images=$database->select("images","*",["listid"=>$property['pid']]);
                                    echo "<tr>";
                                    echo "<td width='10px'>".++$count."</td>";
                                    echo "<td>".$property['city']."</td>";
                                    echo "<td>".$property['area']."</td>";
                                    echo "<td>".$property['description']."</td>";
                                    echo "<td>".$property['price']."</td>";
                                    if(count($Images)>0)
                                    {
                                        echo "<td><a href='#' id='".$property['pid']."' class='slideron'><span class='badge badge-success'><i class='fa fa-check'></i> View</span></a></td>";
                                    }
                                    else{
                                        
                                        echo "<td>N/A</td>";
                                    }
                                    echo "<td>".$agentinfo['phone']."</td>";
                                    echo "<td><a href='#'>".$agentinfo['fname']." ".$agentinfo['lname']."</a></td>";
                                    echo "</tr>";
                                }
                            }
                            
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr#</th>
                                <th>City</th>
                                <th>Area</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Images</th>
                                <th>Contact</th>
                                <th>Agent</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div id="modalslider"  class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Property Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Each carousel needs a unique ID -->
                    <div id="carousel-id" class="carousel slide" data-ride="carousel">

                        <div id="sliderbody" class="carousel-inner" role="listbox">
                            
                            
                        </div>
                        <p class="text-xs-center text-center">
                            <a class="" href="#carousel-id" role="button" data-slide="prev">
                                <span class="icon-prev" aria-hidden="true"></span>
                                << Previous </a>&emsp; <a class="l" href="#carousel-id" role="button" data-slide="next">
                                    <span class="icon-next" aria-hidden="true"></span> Next >>
                            </a>
                        </p>
                        <!-- /.text-center -->
                    </div>
                    <!-- /.carousel -->

                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
    <footer>
        <p>All Rights Reserved</p>
    </footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="includes/script.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

    </script>
</body>

</html>
