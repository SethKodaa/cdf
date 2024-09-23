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
                                            <div class="card-body pt-0">
                                                <form>
                   <?php

date_default_timezone_set('Australia/Melbourne');
session_start();

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
    $username = $row["username"];
    $token_password = $row["token"];
    }
} else {
    echo "0 results";
}
$conn->close();

$responsecode = htmlspecialchars($_GET["r"]);
$success = htmlspecialchars($_GET["successful"]);
$txnref = htmlspecialchars($_GET["reference"]);
$txnid = htmlspecialchars($_GET["id"]);
$cardtoken = htmlspecialchars($_GET["token"]);


if ($responsecode == '1' && $_SESSION['interval']=="ongoing"){

$customer = addCustomer($username, $token_password, $cardtoken);

$recurring = addPlan($username, $token_password, $customer->response->id);

if ($recurring->successful){
echo "<h2>Thank you for your financial<br />offering to " . $_SESSION['parish_name'] . "</h2>";
echo "<h4>We are grateful for your ongoing support of our Parish community.</h4>";
echo "<br /><a href=\"..\">Make Another Donation</a>";

send_recurring_email();

  }else{

echo "<h5>Transaction Declined</h5><br />";
echo "<a href=\"..\payment\">Please try again</a>";

   }


}
elseif ($_SESSION['interval']=="onetime" && $responsecode == '1' ){


$onceoff_response = processPayment($username, $token_password, $cardtoken);

if ($onceoff_response->response->successful){

$customer = addCustomer($username, $token_password, $cardtoken);
echo "<h2>Thank you for your financial<br />offering to " . $_SESSION['parish_name'] . "</h2>";
echo "<h4>We are grateful for your ongoing support of our Parish community.</h4>";

echo "<br /><a href=\"..\">Make Another Donation</a>";

send_email();


 }else{

echo "<h5>Transaction Declined</h5><br />";
echo "<a href=\"..\payment\">Please try again</a>";

 }


}

elseif ($responsecode != '1'){

echo "<h5>Transaction Declined</h5><br />";
echo "<a href=\"..\payment\">Please try again</a>";


}

function send_email() {

$to = $_SESSION['customer_email'];

$url = "https://api.sendgrid.com/v3/mail/send";

       $payload = array (
  'personalizations' => 
  array (
    0 => 
    array (
      'to' => 
      array (
        0 => 
        array (
          'email' => $to,
        ),
      ),
       'dynamic_template_data' => 
      array ('amount' => '$' . $_SESSION['amount'],
			 'firstName' => $_SESSION['first_name'],
            'parish_name' => $_SESSION['parish_name'],
'donation_date' => date("jS F Y"),
 'offer_type' => $_SESSION['intent'],
 'comment' => $_SESSION['comment']
      ),
    ),
  ),
    'from' => 
  array (
    'email' => 'noreply@cdfpay.org.au',
  ),
  'subject' => 'Thank-you for supporting your Parish',
  'template_id' => 'd-4ed45272ce5c471cac557455ef86a20a'
);
            
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);


curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json", "Authorization: Bearer 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"));
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_SSLVERSION, "CURL_SSLVERSION_TLSv1_0");

$data = curl_exec($curl);		
	
curl_close($curl);

}

function send_recurring_email() {

$to = $_SESSION['customer_email'];

$url = "https://api.sendgrid.com/v3/mail/send";

       $payload = array (
  'personalizations' => 
  array (
    0 => 
    array (
      'to' => 
      array (
        0 => 
        array (
          'email' => $to,
        ),
      ),
       'dynamic_template_data' => 
      array ('amount' => '$' . $_SESSION['amount'],
			 'firstName' => $_SESSION['first_name'],
            'parish_name' => $_SESSION['parish_name'],
			 'frequency' => $_SESSION['frequency'],
'donation_date' => date("jS F Y"),
 'comment' => $_SESSION['comment']
      ),
    ),
  ),
    'from' => 
  array (
    'email' => 'noreply@cdfpay.org.au',
  ),
  'subject' => 'Thank-you for supporting your Parish',
  'template_id' => 'd-ccd7a5428f084b35b1592aa5d4042dcc'
);
            
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);


curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json", "Authorization: Bearer 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"));
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_SSLVERSION, "CURL_SSLVERSION_TLSv1_0");

$data = curl_exec($curl);		
	
curl_close($curl);



}

function processPayment($username, $token_password, $cardtoken) {

$url = "https://gateway.fatzebra.com.au/v1.0/purchases";

       $payload = array(
        "card_token" => $cardtoken, 
        "amount"=> $_SESSION['amount'] * 100,
        "reference"=> $_SESSION['intent'] . "-" . $_SESSION['txnref'],
        "customer_ip"=> "127.0.0.1",
        "currency"=> "AUD"
            );
            

     $payload["metadata"] = array(

            "Comment" =>  $_SESSION['comment'] 
            );
            
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $token_password);

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json", "User-agent: FatZebra PHP Library v1.0"));
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_SSLVERSION, "CURL_SSLVERSION_TLSv1_0");
curl_setopt($curl, CURLOPT_CAINFO, dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cacert.pem');

$data = curl_exec($curl);

if (curl_errno($curl) !== 0) {
				echo "cURL error: " . $curl;

}		

$response_attempt = curl_getinfo($curl);

print curl_error($curl);
	
curl_close($curl);

$records =  json_decode($data);


return $records;


 }

function addCustomer($username, $token_password, $cardtoken) {

$url = "https://gateway.fatzebra.com.au/v1.0/customers";

         $payload = array(
        "first_name" => $_SESSION['first_name'],
        "last_name" => $_SESSION['last_name'],
        "reference"=> $_SESSION['intent'] . "-" . $_SESSION['txnref'],
        "ip_address"=> "127.0.0.1",
        "email_address"=> $_SESSION['customer_email'],
        "card_token"=> $cardtoken
        );
        
      $payload["address"] = array(
    "address" => $_SESSION['customer_address'],
    "city" => $_SESSION['customer_suburb'], 
    "state" => $_SESSION['customer_state'],  
    "postcode" => $_SESSION['customer_postcode'], 
    "country"=> "Australia"   
            );

      $payload["metadata"] = array( 
    "Comments"=> $_SESSION['comment']   
            );
            



$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $token_password);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json", "User-agent: FatZebra PHP Library v1.0"));
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_CAINFO, dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cacert.pem');
$data = curl_exec($curl);

if (curl_errno($curl) !== 0) {
				echo "cURL error: " . $curl;

}		

$response_attempt = curl_getinfo($curl);

print curl_error($curl);
	
curl_close($curl);

$response =  json_decode($data);

return $response;

}

function addPlan($username, $token_password, $CustomerID) {

$url = "https://gateway.pmnts.io/v1.0/payment_plans";

 $payload = array(
  "customer" => $CustomerID,
  "amount" => $_SESSION['amount'] * 100,
  "setup_fee" => 0,
  "frequency" => $_SESSION['frequency'],
  "payment_method" => "Credit Card",
  "anniversary" => 1,
  "start_date" => date("Y-m-d"),
  "currency" => "AUD"
  );           


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $token_password);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json", "User-agent: FatZebra PHP Library v1.0"));
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_CAINFO, dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cacert.pem');
$data = curl_exec($curl);

if (curl_errno($curl) !== 0) {
				echo "cURL error: " . $curl;

}		

$response_attempt = curl_getinfo($curl);

print curl_error($curl);
	
curl_close($curl);

$response =  json_decode($data);

return $response;

}


?>
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