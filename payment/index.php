<?php
session_start();


if ($_POST["amount"] != ""){

$_SESSION['amount'] = number_format($_POST["amount"], 2, '.', '');
$_SESSION['interval']=$_POST["payment_interval"];
$_SESSION['frequency']=$_POST["frequency"];
$_SESSION['first_name']=$_POST["fname"];
$_SESSION['last_name']=$_POST["lname"];
$_SESSION['customer_email']=$_POST["email"];
$_SESSION['customer_address']=$_POST["address"];
$_SESSION['customer_suburb']=$_POST["suburb"];
$_SESSION['customer_state']=$_POST["state"];
$_SESSION['customer_postcode']=$_POST["postcode"];
$_SESSION['comment']=$_POST["comments"];
$_SESSION['intent'] = $_POST["intention"];

}

$tokenise = "true";


$parish_church_name = $_SESSION['parish_name'];

$servername = "localhost:3306";
$username = "msmith7_admin";
$password = "l0o2nqQNAK,q";
$dbname = "donations";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM organisation WHERE ID =" . $_SESSION['parishid'] ;  
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $gatewayusername = $row["username"];
    $secretkey = $row["shared_secret"];
    }
} 
$conn->close();

$refnum = rand(1000000,10000000);
$reference = $_POST["intention"] . "-" . $refnum;
$_SESSION['txnref'] = $refnum;
$returnURL = "https://melbourne.cdfpay.org.au/complete/";
$verificationstring = $reference .":". $_SESSION['amount'] .":AUD:". $returnURL;
$VerificationHash = hash_hmac('md5', $verificationstring, $secretkey);
$postURL = "https://paynow.fatzebra.com.au/v3/". $gatewayusername . "/" . $reference . "/AUD/" . $_SESSION['amount'] . "/" . $VerificationHash . "?iframe=true&show_email=false&button_text=Give&l=v2&show_extras=false&tokenize_only=" . $tokenise . "&return_path=" . $returnURL;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- Primary Meta Tags -->
<title>CDFpay</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="title" content="Catholic Development Fund Giving Page">
<meta name="description" content="Catholic Development Fund Giving Page">

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
                                        <h4>To Give $<?php echo $_SESSION["amount"] . $amount_text?> to <br /><?php echo $parish_church_name ?>,<br /> please enter your payment details.</h4>


                                            </div>
<div class="card-header text-center">
                                            <div class="card-body pt-0">
                                                <form>
                     <iframe name="my_iframe" width="320" height="500" src="<?php echo $postURL?>" frameBorder="0" ></iframe>
                                                    <!-- Form -->
                                     
                                      </div>
                     
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