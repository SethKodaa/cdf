<?php

session_start();
$user = htmlspecialchars($_GET["id"]);
$_SESSION['parishid']=$user;


$servername = "localhost:3306";
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

$parish_church_name=$parish_name;


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- Primary Meta Tags -->
<title>CDF Pay</title>
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
<link type="text/css" href="../css/prism.css" rel="stylesheet">

<!-- Pixel CSS -->
<link type="text/css" href="../css/pixel.css" rel="stylesheet">

<script language="JavaScript" type="text/javascript">
	


function Amount10(){

amountDIV.style.display = 'none';
document.getElementById("amount").value = "10.00";

}
function Amount25(){

amountDIV.style.display = 'none';
document.getElementById("amount").value = "25.00";
document.getElementById("25").show = true;
	
}

function Amount50(){
amountDIV.style.display = 'none';
document.getElementById("amount").value = "50.00";

}

function AmountOther(){

amountDIV.style.display = 'inline';
document.getElementById("amount").value = "10.00";

}

function onceOnly(){
monthlyDIV.style.display = 'none';
document.getElementById("payment_interval").value = "onetime";
anonymousDIV.style.display = 'inline';
document.getElementById("fname").required = false;
document.getElementById("lname").required = false;
}

function Monthly(){

monthlyDIV.style.display = 'inline';
document.getElementById("payment_interval").value = "monthly";
anonymousDIV.style.display = 'none';
contactDIV.style.display = 'inline';
document.getElementById("fname").required = true;
document.getElementById("lname").required = true;
document.getElementById("address").required = true;
document.getElementById("suburb").required = true;
document.getElementById("state").required = true;
document.getElementById("postcode").required = true;


}

function Anonymous(){

contactDIV.style.display = 'none';
 var checkBox = document.getElementById("makeAnonymous");

if(makeAnonymous.checked){
contactDIV.style.display = 'none';
document.getElementById("fname").required = false;
document.getElementById("lname").required = false;
document.getElementById("address").required = false;
document.getElementById("suburb").required = false;
document.getElementById("state").required = false;
document.getElementById("postcode").required = false;

}else{

contactDIV.style.display = 'inline';
document.getElementById("fname").required = true;
document.getElementById("lname").required = true;
document.getElementById("address").required = true;
document.getElementById("suburb").required = true;
document.getElementById("state").required = true;
document.getElementById("postcode").required = true;

  }


}

$(document).ready(function() {
  $("#details-form").validate();
});

</script>



<style type="text/css">
<!--
#amountDIV { display: none; }
#monthlyDIV { display: none; }
#contactDIV { display: inline; }
input.error, textarea.error {
    border: 1px dashed red;
    font-weight: 300;
    color: red;
}
-->
</style>

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
                                                <h2>Thank you for giving to <br/>
<?php echo $parish_church_name ?></h2>
                                            <h4>I would like to give....</h4>
                                            </div>
                                            <div class="card-body pt-0">
                                                <form id="details-form" action="../payment/" method="post">
                                          <div class="nav-wrapper position-relative"><ul class="nav nav-pills nav-fill flex-column flex-sm-row">
                                         <li class="nav-item"><a class="nav-link mb-sm-3 mb-md-0 active" data-toggle="tab" onClick="onceOnly()">Once Only</a></li>
                                         <li class="nav-item"><a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" onClick="Monthly()">Monthly</a></li></ul>
                                          </div>
  <div class="row">
<div id="monthlyDIV">	
<div class="col-sm-12"><div class="form-group">
<h6>Monthly payments are deducted on the 1st of each month</h6>
  </div></div>
</div></div>

 <input name="payment_interval" id="payment_interval" type="hidden" value="onetime">
                                                <div class="nav-wrapper position-relative"><ul class="nav nav-pills nav-fill flex-column flex-sm-row">
                                          <li class="nav-item"><a class="nav-link mb-sm-3 mb-md-0 active" onClick="Amount10()" data-toggle="tab" href="">$10</a></li>
                                           <li id="25" class="nav-item"><a class="nav-link mb-sm-3 mb-md-0" onClick="Amount25()" data-toggle="tab" href="">$25</a></li>
                                            <li class="nav-item"><a class="nav-link mb-sm-3 mb-md-0" onClick="Amount50()" data-toggle="tab" href="#">$50</a></li>
                                          <li class="nav-item"><a class="nav-link mb-sm-3 mb-md-0 active" onClick="AmountOther()" data-toggle="tab" href="#">Other</a></li></ul>
                                          </div>

<div id="amountDIV">
              <div class="row">
                                          
                                          <div class="col-sm-12"><div class="form-group">
                                          <input class="form-control" name="amount" id="amount" type="number" min="0.01" placeholder="0.00" value="10.00" step="0.01">
                                          </div></div>
                                          
                                          </div>
 </div>
              <div class="row">
                                          
                                          <div class="col-sm-12"><div class="form-group">
                                                   <select class="form-control select2-hidden-accessible" id="inlineFormCustomSelectPref2" data-toggle="select" title="Intention" name="intention" required>
                                         <option selected="selected" value="">My Giving is For...</option>
                                                       <option value="First">First Collection</option>
                                                       <option value="Second">Second Collection</option>
                                                        <option value="Other">Other Collection</option>
                                        </select>
                                          </div></div>
                                          
                                          </div>
                                          
                                          <div class="card-header text-center">
                                           <h4>Please enter your details below</h4>
                                            </div>

    <div class="row">
<div id="anonymousDIV">
<div class="col-sm-12"><div class="form-group">
<div class="custom-control custom-switch">
                    <input type="checkbox" onClick="Anonymous()" class="custom-control-input" name="makeAnonymous" id="makeAnonymous">
                    <label class="custom-control-label" for="makeAnonymous"><h6>I would like my giving to be Anonymous</h6></label>

      </div>
                    </div> </div>
 </div>

 </div>
                                          <div id="contactDIV">
                                                        <div class="row">
                                          
                                          <div class="col-sm-6"><div class="form-group">
                                          <label class="h6" for="fname">First Name</label> 
                                          <input class="form-control" name="fname" id="fname" type="text" maxlength="50" placeholder="First Name" required>
                                          </div></div>
                                          
                                          
                                          <div class="col-sm-6"><div class="form-group">
                                          <label class="h6" for="exampleInputText9">Last Name</label> 
                                          <input class="form-control" name="lname" id="lname" type="text" maxlength="50" placeholder="Last Name" required>
                                          </div></div>
                                          
                                          </div>
                                          
                                                 <div class="row">
                                          
                                          <div class="col-sm-12"><div class="form-group">
                                          <label class="h6" for="exampleInputText8">Address</label> 
                                          <input class="form-control" name="address" id="address" type="text" maxlength="150" placeholder="Address" required>
                                          </div></div>
                                          
                                          
                                       
                                          
                                          </div>
                                          
                                          <div class="row">
                                          
                                          <div class="col-sm-4"><div class="form-group">
                                          <label class="h6" for="exampleInputText8">Suburb</label> 
                                          <input class="form-control" name="suburb" id="suburb" type="text" maxlength="50" placeholder="Suburb" required>
                                          </div></div>
                                          
                                          <div class="col-sm-4"><div class="form-group focused">
                                          <label class="h6" for="inlineFormCustomSelectPref2">State</label> 
                                          <select class="form-control select2-hidden-accessible" id="state" data-toggle="select" title="Country" name="state" required>
                                         <option selected="selected" value="">Please Select...</option>
                                                       <option value="ACT">ACT</option>
                                                       <option value="NSW">NSW</option>
                                                        <option value="QLD">QLD</option>
                                                       <option value="SA">SA</option>
                                                       <option value="TAS">TAS</option>
                                                       <option value="VIC">VIC</option>
                                                       <option value="WA">WA</option></select>
                                          </div></div>
                                          
                                          <div class="col-sm-4"><div class="form-group">
                                          <label class="h6" for="exampleInputText9">Postcode</label> 
                                          <input class="form-control" name="postcode" id="postcode" type="text" maxlength="4" placeholder="Postcode" required>
                                          </div></div>
                                          
                                          </div>
                                           </div>
                                                       <div class="row">
                                          
                                          <div class="col-sm-12"><div class="form-group">
                                          <label class="h6" for="email">Email (This is required for payment authentication and receipting purposes)</label> 
                                          <input class="form-control" type="email" name="email" id="email" placeholder="Email" maxlength="50" required>
                                          </div></div>
                                          
                                          </div>

               <div class="row">
                                          
                                          <div class="col-sm-12"><div class="form-group">
                                          <label class="h6" for="exampleInputText8">Comments</label> 
                                          <input class="form-control" name="comments" id="comments" type="text" maxlength="150" placeholder="Comments">
                                          </div></div>
 
                                          
                                          </div>
                                                  
                                          <div class="row">
                                          
                                           <div class="col-12">
                                             <button type="submit" class="btn btn-dark shadow-soft btn-block" data-loading-text="Sending">
                                <span>Next</span>
                            </button>
                                          </div> </div>
                                                       
                                                        </div></div></div>
                    
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
<script src="../css/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/headroom.js/dist/headroom.min.js"></script>

<!-- Vendor JS -->
<script src="https://demo.themesberg.com/pixel-pro/vendor/onscreen/dist/on-screen.umd.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/nouislider/distribute/nouislider.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/jarallax/dist/jarallax.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/jquery.counterup/jquery.counterup.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/jquery-countdown/dist/jquery.countdown.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/prismjs/prism.js"></script>
<script src="../node_modules/chart.js/dist/Chart.min.js"></script>
<script src="https://demo.themesberg.com/pixel-pro/vendor/vivus/dist/vivus.min.js"></script>
<script src="../node_modules/vivus/src/pathformer.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- pixel JS -->
<script src="../assets/js/pixel.js"></script>
</body>

</html>