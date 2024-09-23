<?php
date_default_timezone_set('Australia/Melbourne');
session_start();
$date = date('F', strtotime('+1 month'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- Primary Meta Tags -->
<title>Pixel Pages - Contact</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="title" content="Pixel Pages - Contact">
<meta name="author" content="Themesberg">
<meta name="description" content="Premium Bootstrap 4 UI Kit featuring over 1k components and 17 example pages.">
<meta name="keywords" content="bootstrap, bootstrap ui kit, accessibility, wcag bootstrap, bootstrap 4" />
<link rel="canonical" href="https://themesberg.com/product/ui-kits/pixel-pro-premium-bootstrap-4-ui-kit">







<!-- Fontawesome -->
<link type="text/css" href="https://ballarat.cdfpay.org.au/node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Prism -->
<link type="text/css" href="https://ballarat.cdfpay.org.au/node_modules/prismjs/themes/prism.css" rel="stylesheet">

<!-- Pixel CSS -->
<link type="text/css" href="https://ballarat.cdfpay.org.au/css/pixel.css" rel="stylesheet">


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
                    <img alt="" display="block" src="https://ballarat.cdfpay.org.au/assets/img/logo.svg" height="175" width="164" width="100%">      
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
                                                <h2>Thank-you for supporting our Parish</h2>
                                            
                                            </div>
                                            <div class="card-body pt-0">
                                          
                                          <div class="card-header">
                                          
                                          <div class="mb-3">
                    <span class="h6"><h3>Dear <?php echo $_SESSION["first_name"] ?></h3></span>
                </div>

<div class="row py-3 align-items-center">
Thank-you for doing your part to support <?php echo $_SESSION["parish_name"] ?>.
 </div>  


<div class="row py-3 align-items-center">
Your <?php echo $_SESSION["frequency"] ?> offering of <?php echo "$" . $_SESSION["amount"] ?> is truly appreciated and will greatly assist our parish with its many pastoral activities.
        </div>                                           

                    <div class="mb-3">
                    <span class="h6">Offering Summary:</span>
                </div>

<ul>
<li>First Payment Date: 1st of <?php echo $date ?></li>
<li>Monthly Recurring Date: 1st of each month</li>
<li>Offering Note: <?php echo $_SESSION["comment"] ?></li>
</ul>

<div class="row py-3 align-items-center">
Thank-you again for your support.

        </div> 
<div class="row py-3 align-items-center">

 <img alt="" display="block" src="https://ballarat.cdfpay.org.au/assets/img/cdffooterlogo.png">
</div> 
<div class="row py-3 align-items-center">
If you have any questions regarding your transaction, please contact your parish office. 
</div> 
                                            </div>
                                          
       
                                                        </div></div></div>
                                                        
                                                           
                         
                       
                                                        
                                                        
                                                
                                    
                     
                                       
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
    




    <!-- Core -->
<script src="https://ballarat.cdfpay.org.au/node_modules/jquery/dist/jquery.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/headroom.js/dist/headroom.min.js"></script>

<!-- Vendor JS -->
<script src="https://ballarat.cdfpay.org.au/node_modules/onscreen/dist/on-screen.umd.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/nouislider/distribute/nouislider.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/jarallax/dist/jarallax.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/jquery.counterup/jquery.counterup.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/jquery-countdown/dist/jquery.countdown.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/prismjs/prism.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/chart.js/dist/Chart.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/vivus/dist/vivus.min.js"></script>
<script src="https://ballarat.cdfpay.org.au/node_modules/vivus/src/pathformer.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- pixel JS -->
<script src="https://ballarat.cdfpay.org.au/assets/js/pixel.js"></script>
</body>

</html>