<?php

$user = htmlspecialchars($_GET["id"]);
session_start();
$_SESSION['parishid']=$user;


$servername = "mysql10.quadrahosting.com.au";
$username = "msmith7_admin";
$password = "celticz12!";
$dbname = "msmith7_donations";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM organisation WHERE ID=" . $user;  
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    if($row = $result->fetch_assoc()) {
$parish_name = $row["name"];

    }
} 

$_SESSION['parish_name']=$parish_name;




?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Primary Meta Tags -->
<title>CDF Pay</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="title" content="Catholic Development Fund Donation Page">
<meta name="description" content="Catholic Development Fund Donation Page">
<!-- Favicon -->
<link rel="SHORTCUT ICON" href="https://www.catholicdevelopmentfund.org.au/Portals/2/hnet.com-image.ico?ver=2020-04-17-121517-927" type="image/x-icon">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">

<!-- Fontawesome -->
<link type="text/css" href="../node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Prism -->
<link type="text/css" href="../node_modules/prismjs/themes/prism.css" rel="stylesheet">

<!-- Pixel CSS -->
<link type="text/css" href="../css/pixel.css" rel="stylesheet">


</head>

<body>
    <header class="header-global">

</header>
    <main>



        <!-- Hero -->
        <section class="section section-header bg-primary text-white">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-8 text-center">
                    <img alt="" display="block" src="../assets/img/logo.svg" height="175" width="164" width="100%">      
                    </div>
                </div>
            </div>
        </section>
        <!-- Section -->
       
        <!-- Section -->
        <section class="section section-lg pt-1">
            <div class="container">
                <div class="row justify-content-center mb-5 mb-lg-6">
                    <div class="col-12 col-md-10 col-lg-8">
                        <!-- Contact Card -->
                        <div class="card border-0 p-2 p-md-3">
                            <div class="card-body px-0">
                               
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <!-- Contact Card -->
                                        <div class="card border-0 p-2 p-md-3 p-lg-5">
                                            <div class="card-header text-center">
                                                <h2><?php echo $parish_name ?></h2>
                                            <h3>My donation is for....</h3>
                                            </div>
                                            <div class="card-body pt-0">
                                                <form>
                                                <table class="table table-hover"><tbody>
    <tr><th scope="col" id="class3"><a href="../details?id=0">The Parish</a></th>
                                                </tr>

<?php
$servername = "mysql10.quadrahosting.com.au";
$username = "msmith7_admin";
$password = "celticz12!";
$dbname = "msmith7_donations";


$sql2 = "SELECT * FROM churches WHERE orgID=" . $user;   
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        echo " <tr><th scope=\"col\" id=\"class3\"><a href=\"../details?id=" . $row["ChurchID"]. "\">" . $row["name"]. "</a></th>
                                                </tr>";
    }
} 
$conn->close();
?>
                                            
                     
                                          </tbody>
                                                </table>
                                                    <!-- Form -->
                                     
                                    
                     
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End of Contact Card -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Contact Card -->
                    </div>
                </div>
              
            </div>
        </section>
        <!-- End of section -->
    </main>
    



   <footer class="footer pt-1 pb-6 bg-white text-gray">
    <div class="container">
        <hr class="my-5">
        <div class="row">
            <div class="col mb-md-0">
            <div class="d-flex text-center justify-content-center align-items-center" role="contentinfo">
             <p class="font-weight-normal font-small mb-0"> CDF respects the privacy of your personal information and is committed to upholding the Australian Privacy Principles. Your personal information will remain secure and confidential and never be sold to others.
      
              <br /><br /><a href="https://www.catholicdevelopmentfund.org.au/Privacy">Privacy Policy </a> | Copyright <span class="current-year">2020</span> Catholic Development Fund Melbourne</p>
                </div>
            </div>
        </div>
    </div>
</footer>

    <!-- Core -->
<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../node_modules/headroom.js/dist/headroom.min.js"></script>

<!-- Vendor JS -->
<script src="../node_modules/onscreen/dist/on-screen.umd.min.js"></script>
<script src="../node_modules/nouislider/distribute/nouislider.min.js"></script>
<script src="../node_modules/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="../node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="../node_modules/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="../node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="../node_modules/jarallax/dist/jarallax.min.js"></script>
<script src="../node_modules/jquery.counterup/jquery.counterup.min.js"></script>
<script src="../node_modules/jquery-countdown/dist/jquery.countdown.min.js"></script>
<script src="../node_modules/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="../node_modules/prismjs/prism.js"></script>
<script src="../node_modules/chart.js/dist/Chart.min.js"></script>
<script src="../node_modules/vivus/dist/vivus.min.js"></script>
<script src="../node_modules/vivus/src/pathformer.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- pixel JS -->
<script src="../assets/js/pixel.js"></script>
</body>

</html>