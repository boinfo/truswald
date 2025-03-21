<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');



$credentials_json = file_get_contents('assets/config.json');

$credentials_arr = json_decode($credentials_json, true);


$dat_decode = base64_decode($_GET['dat']);

parse_str($dat_decode, $params);

// Assign variables for easy use
    $price = $params['p'] ?? '';
    $invoice = $params['i'] ?? '';
    $payer_Reference = $params['payer_Reference'] ?? '';
    $full_name = $params['full_name'] ?? '';
    $email = isset($params['email']) ? urldecode($params['email']) : '';
    
    $username = $params['username'] ?? '';
    $user_id = $params['user_id'] ?? '';
    
    $p_type = $params['p_type'] ?? '';
    
    $external_callback_url= $params['external_callback_url'] ?? '';

$mfs = $_GET['mfs'];

$pay_numberr = $credentials_arr[$mfs];





include('./database.php');

// Database connection
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// General
$general = "SELECT * FROM seo_details WHERE id = 1";
 $general_result = $conn->query($general);
   if ($general_result->num_rows > 0) {
   	while ($row = $general_result->fetch_assoc()) {   
   $name = $row['name'];
   $logo = $row['logo'];   
   }
}

// Get user data
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($query);

// Assign variables from database
$row = $result->fetch_assoc();
$merchant = $row['merchant'];
$Bkash = $row['Bkash'];
$rocket = $row['16216'];
$NAGAD = $row['NAGAD'];
$upay = $row['upay'];
$cellfin = $row['cellfin'];
$tap = $row['tap'];
$b_number = $row['b_number'];
$b_pass = $row['b_pass'];
$b_api = $row['b_api'];
$b_secret = $row['b_secret'];
$business_name = $row['business_name'];
$business_logo = $row['business_logo'];



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta Tag -->
    <title>Secure Checkout</title>
    <meta name="title" content="Secure Checkout">
    <link rel="icon" href="assets/favicon.png">
    <meta name="description" content="Personal payment gateway for seamless, secure, and fast transactions">

    

    <!-- Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://mtpay.pro/">
    <meta property="og:title" content="Secure Checkout">
    <meta property="og:description" content="Personal payment gateway for seamless, secure, and fast transactions">
    <meta property="og:image" content="assets/favicon.png">

    

    <!-- CSS -->
    <link href="assets/uddoktapay.css" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="assets/toastr.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400;500;600;700;800&family=Inter:wght@100;200;300;400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>



<?php

if ($mfs == "NAGAD") {
	
?>
	
<style type="text/css">
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(350deg, #f4f9ff, #edf4ffc9), url('assets/body.png');
        }


        .font-bangla {
            font-family: 'Baloo Da 2', cursive;
        }


        
        /* Nagad */
        .brand-bg {
            --tw-bg-opacity: 1;
            background-color: rgb(201 0 8 / var(--tw-bg-opacity));
        }

        .brand-hr {
            --tw-border-opacity: 1;
            border-color: rgb(175 0 7 / var(--tw-border-opacity));
        }

        .brand-btn {
            --tw-bg-opacity: 1;
            background-color: rgb(201 0 8 / var(--tw-bg-opacity));
        }

        .brand-btn:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(236 28 36 / var(--tw-bg-opacity));
        }
        
        
        .logo {
            font-family: Arial, sans-serif;
            font-weight: bold;
            font-size: 2em;
            color: #007bff;
        }
        .logo span {
            color: #6c757d;
        }


            </style>
<body class="w-full min-h-screen sm:h-auto sm:p-12 sm:flex sm:items-center sm:justify-center">

<div id="page-overlay" class="visible incoming">
<div class="loader-wrapper-outer">
<div class="loader-wrapper-inner">
<div class="lds-double-ring">
<div></div>
<div></div>
<div>
<div></div>
</div>
<div>
<div></div>
</div>
</div>
</div>
</div>
</div>


<div class="up-container max-w-md overflow-hidden mx-auto p-8 sm:relative sm:bg-white sm:rounded-lg sm:shadow-lg sm:shadow-[#0057d0]/10 sm:min-w-[650px] sm:flex sm:flex-wrap">

<div class="w-full h-12 shadow-md shadow-[#0057d0]/5 rounded-lg overflow-hidden flex justify-between items-center p-5 bg-white sm:bg-[#fbfcff]  sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
<div class="logo">
        <img alt="<?php echo $name; ?>" style="height:auto;max-width:160px" src="<?php echo $logo; ?>?v=<?php echo time(); ?>">
    </div>

</div>




<div class="w-full">
<div class="flex flex-col sm:flex-row flex-wrap sm:mt-5 sm:justify-between sm:items-center">
<div class="w-full h-20 mb-4 sm:mt-0 flex justify-center items-center">
<img src="assets/nagad.png" alt="Logo" class="h-[80%]">
</div>
<div class="bg-white shadow shadow-[#0057d0]/5 rounded-lg px-5 py-3 sm:h-[85px] flex items-center sm:w-[70%] sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
<div class="w-[55px] h-[55px] p-1.5 flex justify-center items-center mr-4 ring-1 ring-[#0057d0]/10 rounded-full">
<img src="<?php echo $business_logo; ?>" alt="<?php echo $business_name; ?>" class="rounded-full" style="width:45px;height:45px;">
</div>
<div class="flex flex-col">
<h3 class="font-semibold text-[#6D7F9A]"><?php echo $business_name; ?></h3>
<span class="text-[#94a9c7] text-sm font-english">Invoice ID:</span>
<p class="text-[#6D7F9A] text-sm select-all"><?php echo $invoice; ?></p>
</div>
</div>
<div class="bg-white shadow shadow-[#0057d0]/5 rounded-lg py-3 px-2 sm:h-[85px] flex flex-col sm:items-center sm:justify-center sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10 mt-3 sm:w-[25%] sm:mt-0">
<h1 class="text-xl sm:text-2xl font-semibold text-[#6D7F9A] justify-center items-center" style="text-align: center;">TOTAL ৳ <?php echo $price; ?></h1>
</div>
</div>
<form action="mfs_verify.php" class="actionForm" method="post" accept-charset="utf-8">
<input type="hidden" name="payment_id" value="<?php echo $invoice; ?>" />          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
<input type="hidden" name="email" value="<?php echo $email; ?>" />
<input type="hidden" name="full_name" value="<?php echo $full_name; ?>" />
<input type="hidden" name="amount" value="<?php echo $price; ?>" />
<input type="hidden" name="username" value="<?php echo $username; ?>" />
<input type="hidden" name="payment_method" value="<?php echo $mfs; ?>" />
<input type="hidden" name="p_type" value="<?php echo $p_type; ?>" />
<input type="hidden" name="payer_Reference" value="<?php echo $payer_Reference; ?>" />
<input type="hidden" name="external_callback_url" value="<?php echo $external_callback_url; ?>" />

<div class="brand-bg p-5 mt-3 rounded-lg overflow-auto">
<div class="text-center mt-3">
<h2 class="mb-3 font-semibold text-white font-english">Enter Transaction ID</h2>
<input type="text" name="transaction_id" placeholder="Enter Transaction ID" class="font-english appearance-none w-full text-[15px] rounded-[10px] sm:bg-[#fbfcff] shadow shadow-[#0057d0]/5 px-5 py-3.5 placeholder-[#94A9C7] focus:outline-none focus:ring-1 focus:ring-[#0057d0]" maxlength="8" required>
</div>

<div id="sender_number" class="text-center mt-3 hidden">
<h2 class="mb-3 font-semibold text-white font-english">Enter Phone Number</h2>
<input type="text" name="phone_number" placeholder="Enter Phone Number" class="font-english appearance-none w-full text-[15px] rounded-[10px] sm:bg-[#fbfcff] shadow shadow-[#0057d0]/5 px-5 py-3.5 placeholder-[#94A9C7] focus:outline-none focus:ring-1 focus:ring-[#0057d0]" maxlength="12">
</div>

<div class>
<ul class="mt-5 text-slate-200">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Go to your NAGAD Mobile Menu by dialing: *167# or Open NAGAD App.</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Choose: <span class="text-yellow-300 font-semibold ml-1">
"Send Money"
</span> </p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="sm:w-[90%] font-english">Enter the Receiver Account Number: <span class="text-yellow-300 font-semibold ml-1"> <?php echo $mfs; ?></span>

</p>
</li>
<div id="contentQR" class="hidden fixed top-0 left-0 w-full h-full overflow-hidden bg-[#00000080] justify-center items-center">
<div class="modal-content w-[70%] sm:w-[300px] bg-white p-[10px] rounded-lg border border-[#0057d0] shadow-lg shadow-[#00000030]">
<div>

</div>
</div>
</div>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Enter the amount: <span class="text-yellow-300 font-semibold ml-1"> <?php echo $price; ?></span></p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Now enter your NAGAD Mobile Menu PIN to confirm.</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Done! You will receive a confirmation message from NAGAD</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Put the<span class="text-yellow-300 font-semibold ml-1">Transaction ID</span> in the upper box and press<span class="text-yellow-300 font-semibold ml-1">VERIFY</span> </p>
</li>
</ul>
</div>
</div>

<div class="mt-5">
<button type="submit" id="form_submit" class="brand-btn block rounded-[10px] px-4 py-3.5 text-center font-semibold text-white transition-colors w-full">VERIFY</button>
</div>
</form> </div>
</div>


<?php

elseif ($mfs == "BkashP") {
	
?>
	
<style type="text/css">
        .brand-bg {
    --tw-bg-opacity: 1;
    background-color: rgb(227 16 109 / var(--tw-bg-opacity)); /* bKash primary color #E3106D */
}

.brand-hr {
    --tw-border-opacity: 1;
    border-color: rgb(166 30 78 / var(--tw-border-opacity)); /* bKash secondary color #A61E4E */
}

.brand-btn {
    --tw-bg-opacity: 1;
    background-color: rgb(227 16 109 / var(--tw-bg-opacity)); /* bKash primary color #E3106D */
}

.brand-btn:hover {
    --tw-bg-opacity: 1;
    background-color: rgb(166 30 78 / var(--tw-bg-opacity)); /* bKash secondary color #A61E4E */
}

.logo {
    font-family: Arial, sans-serif;
    font-weight: bold;
    font-size: 2em;
    color: #E3106D; /* bKash primary color for logo */
}

.logo span {
    color: #6c757d; /* Default gray color */
}

            </style>
<body class="w-full min-h-screen sm:h-auto sm:p-12 sm:flex sm:items-center sm:justify-center">

<div id="page-overlay" class="visible incoming">
<div class="loader-wrapper-outer">
<div class="loader-wrapper-inner">
<div class="lds-double-ring">
<div></div>
<div></div>
<div>
<div></div>
</div>
<div>
<div></div>
</div>
</div>
</div>
</div>
</div>


<div class="up-container max-w-md overflow-hidden mx-auto p-8 sm:relative sm:bg-white sm:rounded-lg sm:shadow-lg sm:shadow-[#0057d0]/10 sm:min-w-[650px] sm:flex sm:flex-wrap">

<div class="w-full h-12 shadow-md shadow-[#0057d0]/5 rounded-lg overflow-hidden flex justify-between items-center p-5 bg-white sm:bg-[#fbfcff]  sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
<div class="logo">
        <img alt="<?php echo $name; ?>" style="height:auto;max-width:160px" src="<?php echo $logo; ?>?v=<?php echo time(); ?>">
    </div>

</div>




<div class="w-full">
<div class="flex flex-col sm:flex-row flex-wrap sm:mt-5 sm:justify-between sm:items-center">
<div class="w-full h-20 mb-4 sm:mt-0 flex justify-center items-center">
<img src="assets/bkash.png" alt="Logo" class="h-[80%]">
</div>
<div class="bg-white shadow shadow-[#0057d0]/5 rounded-lg px-5 py-3 sm:h-[85px] flex items-center sm:w-[70%] sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
<div class="w-[55px] h-[55px] p-1.5 flex justify-center items-center mr-4 ring-1 ring-[#0057d0]/10 rounded-full">
<img src="<?php echo $business_logo; ?>" alt="<?php echo $business_name; ?>" class="rounded-full" style="width:45px;height:45px;">
</div>
<div class="flex flex-col">
<h3 class="font-semibold text-[#6D7F9A]"><?php echo $business_name; ?></h3>
<span class="text-[#94a9c7] text-sm font-english">Invoice ID:</span>
<p class="text-[#6D7F9A] text-sm select-all"><?php echo $invoice; ?></p>
</div>
</div>
<div class="bg-white shadow shadow-[#0057d0]/5 rounded-lg py-3 px-2 sm:h-[85px] flex flex-col sm:items-center sm:justify-center sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10 mt-3 sm:w-[25%] sm:mt-0">
<h1 class="text-xl sm:text-2xl font-semibold text-[#6D7F9A] justify-center items-center" style="text-align: center;">TOTAL ৳ <?php echo $price; ?></h1>
</div>
</div>
<form action="mfs_verify.php" class="actionForm" method="post" accept-charset="utf-8">
<input type="hidden" name="payment_id" value="<?php echo $invoice; ?>" />          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
<input type="hidden" name="email" value="<?php echo $email; ?>" />
<input type="hidden" name="full_name" value="<?php echo $full_name; ?>" />
<input type="hidden" name="amount" value="<?php echo $price; ?>" />
<input type="hidden" name="username" value="<?php echo $username; ?>" />
<input type="hidden" name="payment_method" value="<?php echo $mfs; ?>" />
<input type="hidden" name="p_type" value="<?php echo $p_type; ?>" />
<input type="hidden" name="payer_Reference" value="<?php echo $payer_Reference; ?>" />
<input type="hidden" name="external_callback_url" value="<?php echo $external_callback_url; ?>" />

<div class="brand-bg p-5 mt-3 rounded-lg overflow-auto">
<div class="text-center mt-3">
<h2 class="mb-3 font-semibold text-white font-english">Enter Transaction ID</h2>
<input type="text" name="transaction_id" placeholder="Enter Transaction ID" class="font-english appearance-none w-full text-[15px] rounded-[10px] sm:bg-[#fbfcff] shadow shadow-[#0057d0]/5 px-5 py-3.5 placeholder-[#94A9C7] focus:outline-none focus:ring-1 focus:ring-[#0057d0]" maxlength="8" required>
</div>

<div id="sender_number" class="text-center mt-3 hidden">
<h2 class="mb-3 font-semibold text-white font-english">Enter Phone Number</h2>
<input type="text" name="phone_number" placeholder="Enter Phone Number" class="font-english appearance-none w-full text-[15px] rounded-[10px] sm:bg-[#fbfcff] shadow shadow-[#0057d0]/5 px-5 py-3.5 placeholder-[#94A9C7] focus:outline-none focus:ring-1 focus:ring-[#0057d0]" maxlength="12">
</div>

<div class>
<ul class="mt-5 text-slate-200">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Go to your BKASH Mobile Menu by dialing: *247# or Open BKASH App.</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Choose: <span class="text-yellow-300 font-semibold ml-1">
"Send Money"
</span> </p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="sm:w-[90%] font-english">Enter the Receiver Account Number: <span class="text-yellow-300 font-semibold ml-1"> <?php echo $mfs; ?></span>

</p>
</li>
<div id="contentQR" class="hidden fixed top-0 left-0 w-full h-full overflow-hidden bg-[#00000080] justify-center items-center">
<div class="modal-content w-[70%] sm:w-[300px] bg-white p-[10px] rounded-lg border border-[#0057d0] shadow-lg shadow-[#00000030]">
<div>

</div>
</div>
</div>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Enter the amount: <span class="text-yellow-300 font-semibold ml-1"> <?php echo $price; ?></span></p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Now enter your BKASH Mobile Menu PIN to confirm.</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Done! You will receive a confirmation message from BKASH</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Put the<span class="text-yellow-300 font-semibold ml-1">Transaction ID</span> in the upper box and press<span class="text-yellow-300 font-semibold ml-1">VERIFY</span> </p>
</li>
</ul>
</div>
</div>

<div class="mt-5">
<button type="submit" id="form_submit" class="brand-btn block rounded-[10px] px-4 py-3.5 text-center font-semibold text-white transition-colors w-full">VERIFY</button>
</div>
</form> </div>
</div>


<?php

} elseif ($mfs == "tap") {

?>


<style type="text/css">
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(350deg, #f4f9ff, #edf4ffc9), url('assets/body.png');
        }


        .font-bangla {
            font-family: 'Baloo Da 2', cursive;
        }


        
                /* tap */
        .brand-bg {
            --tw-bg-opacity: 1;
            background-color: #D32F2F;
        }

        .brand-hr {
            --tw-border-opacity: 1;
            border-color: #FFCDD2;
        }

        .brand-btn {
            --tw-bg-opacity: 1;
            background-color: #D32F2F;
        }

        .brand-btn:hover {
            --tw-bg-opacity: 1;
            background-color: #F44336;
        }


.logo {
            font-family: Arial, sans-serif;
            font-weight: bold;
            font-size: 2em;
            color: #007bff;
        }
        .logo span {
            color: #6c757d;
        }

            </style>

<body class="w-full min-h-screen sm:h-auto sm:p-12 sm:flex sm:items-center sm:justify-center">

<div id="page-overlay" class="visible incoming">
<div class="loader-wrapper-outer">
<div class="loader-wrapper-inner">
<div class="lds-double-ring">
<div></div>
<div></div>
<div>
<div></div>
</div>
<div>
<div></div>
</div>
</div>
</div>
</div>
</div>


<div class="up-container max-w-md overflow-hidden mx-auto p-8 sm:relative sm:bg-white sm:rounded-lg sm:shadow-lg sm:shadow-[#0057d0]/10 sm:min-w-[650px] sm:flex sm:flex-wrap">

<div class="w-full h-12 shadow-md shadow-[#0057d0]/5 rounded-lg overflow-hidden flex justify-between items-center p-5 bg-white sm:bg-[#fbfcff]  sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
<div class="logo">
        <img alt="<?php echo $name; ?>" style="height:auto;max-width:160px" src="<?php echo $logo; ?>?v=<?php echo time(); ?>">
    </div>

</div>




<div class="w-full">
<div class="flex flex-col sm:flex-row flex-wrap sm:mt-5 sm:justify-between sm:items-center">
<div class="w-full h-20 mb-4 sm:mt-0 flex justify-center items-center">
<img src="assets/tap.png" alt="Logo" class="h-[80%]">
</div>
<div class="bg-white shadow shadow-[#0057d0]/5 rounded-lg px-5 py-3 sm:h-[85px] flex items-center sm:w-[70%] sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
<div class="w-[55px] h-[55px] p-1.5 flex justify-center items-center mr-4 ring-1 ring-[#0057d0]/10 rounded-full">
<img src="<?php echo $business_logo; ?>" alt="<?php echo $business_name; ?>" class="rounded-full" style="width:45px;height:45px;">
</div>
<div class="flex flex-col">
<h3 class="font-semibold text-[#6D7F9A]"><?php echo $business_name; ?></h3>
<span class="text-[#94a9c7] text-sm font-english">Invoice ID:</span>
<p class="text-[#6D7F9A] text-sm select-all"><?php echo $invoice; ?></p>
</div>
</div>
<div class="bg-white shadow shadow-[#0057d0]/5 rounded-lg py-3 px-2 sm:h-[85px] flex flex-col sm:items-center sm:justify-center sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10 mt-3 sm:w-[25%] sm:mt-0">
<h1 class="text-xl sm:text-2xl font-semibold text-[#6D7F9A] justify-center items-center" style="text-align: center;">TOTAL ৳ <?php echo $price; ?></h1>
</div>
</div>
<form action="mfs_verify.php" class="actionForm" method="post" accept-charset="utf-8">
<input type="hidden" name="payment_id" value="<?php echo $invoice; ?>" />          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
<input type="hidden" name="email" value="<?php echo $email; ?>" />
<input type="hidden" name="full_name" value="<?php echo $full_name; ?>" />
<input type="hidden" name="amount" value="<?php echo $price; ?>" />
<input type="hidden" name="username" value="<?php echo $username; ?>" />
<input type="hidden" name="payment_method" value="<?php echo $mfs; ?>" />
<input type="hidden" name="p_type" value="<?php echo $p_type; ?>" />
<input type="hidden" name="payer_Reference" value="<?php echo $payer_Reference; ?>" />
<input type="hidden" name="external_callback_url" value="<?php echo $external_callback_url; ?>" />

<div class="brand-bg p-5 mt-3 rounded-lg overflow-auto">
<div class="text-center mt-3">
<h2 class="mb-3 font-semibold text-white font-english">Enter Transaction ID</h2>
<input type="text" name="transaction_id" placeholder="Enter Transaction ID" class="font-english appearance-none w-full text-[15px] rounded-[10px] sm:bg-[#fbfcff] shadow shadow-[#0057d0]/5 px-5 py-3.5 placeholder-[#94A9C7] focus:outline-none focus:ring-1 focus:ring-[#0057d0]" maxlength="8" required>
</div>

<div id="sender_number" class="text-center mt-3 hidden">
<h2 class="mb-3 font-semibold text-white font-english">Enter Phone Number</h2>
<input type="text" name="phone_number" placeholder="Enter Phone Number" class="font-english appearance-none w-full text-[15px] rounded-[10px] sm:bg-[#fbfcff] shadow shadow-[#0057d0]/5 px-5 py-3.5 placeholder-[#94A9C7] focus:outline-none focus:ring-1 focus:ring-[#0057d0]" maxlength="12">
</div>

<div class>
<ul class="mt-5 text-slate-200">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Go to your TAP Mobile Menu by dialing: *733# or Open TAP App.</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Choose: <span class="text-yellow-300 font-semibold ml-1">
"SEND MONEY"
</span> </p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="sm:w-[90%] font-english">Enter the Receiver Account Number: <span class="text-yellow-300 font-semibold ml-1"> <?php echo $mfs; ?></span>

</p>
</li>
<div id="contentQR" class="hidden fixed top-0 left-0 w-full h-full overflow-hidden bg-[#00000080] justify-center items-center">
<div class="modal-content w-[70%] sm:w-[300px] bg-white p-[10px] rounded-lg border border-[#0057d0] shadow-lg shadow-[#00000030]">
<div>

</div>
</div>
</div>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Enter the amount: <span class="text-yellow-300 font-semibold ml-1"> <?php echo $price; ?></span></p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Now enter your TAP Mobile Menu PIN to confirm.</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Done! You will receive a confirmation message from Tap</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Put the<span class="text-yellow-300 font-semibold ml-1">Transaction ID</span> in the upper box and press<span class="text-yellow-300 font-semibold ml-1">VERIFY</span> </p>
</li>
</ul>
</div>
</div>

<div class="mt-5">
<button type="submit" id="form_submit" class="brand-btn block rounded-[10px] px-4 py-3.5 text-center font-semibold text-white transition-colors w-full">VERIFY</button>
</div>
</form> </div>

</div>


<?php

} elseif ($mfs == "cellfin") {

?>
	
<style type="text/css">
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(350deg, #f4f9ff, #edf4ffc9), url('assets/body.png');
        }


        .font-bangla {
            font-family: 'Baloo Da 2', cursive;
        }


        
                /* Cellfin */
        .brand-bg {
            --tw-bg-opacity: 1;
            background-color: rgb(0 128 61 / var(--tw-bg-opacity));
        }

        .brand-hr {
            --tw-border-opacity: 1;
            border-color: rgb(1 110 53 / var(--tw-border-opacity));
        }

        .brand-btn {
            --tw-bg-opacity: 1;
            background-color: rgb(0 128 61 / var(--tw-bg-opacity));
        }

        .brand-btn:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(0 153 73 / var(--tw-bg-opacity));
        }


.logo {
            font-family: Arial, sans-serif;
            font-weight: bold;
            font-size: 2em;
            color: #007bff; /* Match the blue color of the original logo */
        }
        .logo span {
            color: #6c757d; /* Match the grey color of the original logo */
        }

            </style>

<body class="w-full min-h-screen sm:h-auto sm:p-12 sm:flex sm:items-center sm:justify-center">

<div id="page-overlay" class="visible incoming">
<div class="loader-wrapper-outer">
<div class="loader-wrapper-inner">
<div class="lds-double-ring">
<div></div>
<div></div>
<div>
<div></div>
</div>
<div>
<div></div>
</div>
</div>
</div>
</div>
</div>


<div class="up-container max-w-md overflow-hidden mx-auto p-8 sm:relative sm:bg-white sm:rounded-lg sm:shadow-lg sm:shadow-[#0057d0]/10 sm:min-w-[650px] sm:flex sm:flex-wrap">

<div class="w-full h-12 shadow-md shadow-[#0057d0]/5 rounded-lg overflow-hidden flex justify-between items-center p-5 bg-white sm:bg-[#fbfcff]  sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
<div class="logo">
        <img alt="<?php echo $name; ?>" style="height:auto;max-width:160px" src="<?php echo $logo; ?>?v=<?php echo time(); ?>">
    </div>

</div>




<div class="w-full">
<div class="flex flex-col sm:flex-row flex-wrap sm:mt-5 sm:justify-between sm:items-center">
<div class="w-full h-20 mb-4 sm:mt-0 flex justify-center items-center">
<img src="assets/cellfin.png" alt="Logo" class="h-[80%]">
</div>
<div class="bg-white shadow shadow-[#0057d0]/5 rounded-lg px-5 py-3 sm:h-[85px] flex items-center sm:w-[70%] sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
<div class="w-[55px] h-[55px] p-1.5 flex justify-center items-center mr-4 ring-1 ring-[#0057d0]/10 rounded-full">
<img src="<?php echo $business_logo; ?>" alt="<?php echo $business_name; ?>" class="rounded-full" style="width:45px;height:45px;">
</div>
<div class="flex flex-col">
<h3 class="font-semibold text-[#6D7F9A]"><?php echo $business_name; ?></h3>
<span class="text-[#94a9c7] text-sm font-english">Invoice ID:</span>
<p class="text-[#6D7F9A] text-sm select-all"><?php echo $invoice; ?></p>
</div>
</div>
<div class="bg-white shadow shadow-[#0057d0]/5 rounded-lg py-3 px-2 sm:h-[85px] flex flex-col sm:items-center sm:justify-center sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10 mt-3 sm:w-[25%] sm:mt-0">
<h1 class="text-xl sm:text-2xl font-semibold text-[#6D7F9A] justify-center items-center" style="text-align: center;">TOTAL ৳ <?php echo $price; ?></h1>
</div>
</div>
<form action="mfs_verify.php" class="actionForm" method="post" accept-charset="utf-8">
<input type="hidden" name="payment_id" value="<?php echo $invoice; ?>" />          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
<input type="hidden" name="email" value="<?php echo $email; ?>" />
<input type="hidden" name="full_name" value="<?php echo $full_name; ?>" />
<input type="hidden" name="amount" value="<?php echo $price; ?>" />
<input type="hidden" name="username" value="<?php echo $username; ?>" />
<input type="hidden" name="payment_method" value="<?php echo $mfs; ?>" />
<input type="hidden" name="p_type" value="<?php echo $p_type; ?>" />
<input type="hidden" name="payer_Reference" value="<?php echo $payer_Reference; ?>" />
<input type="hidden" name="external_callback_url" value="<?php echo $external_callback_url; ?>" />

<div class="brand-bg p-5 mt-3 rounded-lg overflow-auto">
<div class="text-center mt-3">
<h2 class="mb-3 font-semibold text-white font-english">Enter Transaction ID</h2>
<input type="text" name="transaction_id" placeholder="Enter Transaction ID" class="font-english appearance-none w-full text-[15px] rounded-[10px] sm:bg-[#fbfcff] shadow shadow-[#0057d0]/5 px-5 py-3.5 placeholder-[#94A9C7] focus:outline-none focus:ring-1 focus:ring-[#0057d0]" maxlength="8" required>
</div>

<div id="sender_number" class="text-center mt-3 hidden">
<h2 class="mb-3 font-semibold text-white font-english">Enter Phone Number</h2>
<input type="text" name="phone_number" placeholder="Enter Phone Number" class="font-english appearance-none w-full text-[15px] rounded-[10px] sm:bg-[#fbfcff] shadow shadow-[#0057d0]/5 px-5 py-3.5 placeholder-[#94A9C7] focus:outline-none focus:ring-1 focus:ring-[#0057d0]" maxlength="12">
</div>

<div class>
<ul class="mt-5 text-slate-200">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Open CELLFIN App.</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Choose: <span class="text-yellow-300 font-semibold ml-1">
"FUND TRANSFER"
</span> </p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="sm:w-[90%] font-english">Enter the Receiver Account Number: <span class="text-yellow-300 font-semibold ml-1"> <?php echo $mfs; ?></span>

</p>
</li>
<div id="contentQR" class="hidden fixed top-0 left-0 w-full h-full overflow-hidden bg-[#00000080] justify-center items-center">
<div class="modal-content w-[70%] sm:w-[300px] bg-white p-[10px] rounded-lg border border-[#0057d0] shadow-lg shadow-[#00000030]">
<div>

</div>
</div>
</div>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Enter the amount: <span class="text-yellow-300 font-semibold ml-1"> <?php echo $price; ?></span></p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Now enter your Cellfin Mobile Menu PIN to confirm.</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Done! You will receive a confirmation message from Cellfin</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Put the<span class="text-yellow-300 font-semibold ml-1">Transaction ID</span> in the upper box and press<span class="text-yellow-300 font-semibold ml-1">VERIFY</span> </p>
</li>
</ul>
</div>
</div>

<div class="mt-5">
<button type="submit" id="form_submit" class="brand-btn block rounded-[10px] px-4 py-3.5 text-center font-semibold text-white transition-colors w-full">VERIFY</button>
</div>
</form> </div>

</div>
	
	
	
<?php

} elseif ($mfs == "16216") {

?>
	
<style type="text/css">
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(350deg, #f4f9ff, #edf4ffc9), url('assets/body.png');
        }


        .font-bangla {
            font-family: 'Baloo Da 2', cursive;
        }


        
        /* Rocket */
        .brand-bg {
            --tw-bg-opacity: 1;
            background-color: rgb(137 40 143 / var(--tw-bg-opacity));
        }

        .brand-hr {
            --tw-border-opacity: 1;
            border-color: rgb(108 30 112 / var(--tw-border-opacity));
        }

        .brand-btn {
            --tw-bg-opacity: 1;
            background-color: rgb(137 40 143 / var(--tw-bg-opacity));
        }

        .brand-btn:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(157 45 163 / var(--tw-bg-opacity));
        }
        
        
        .logo {
            font-family: Arial, sans-serif;
            font-weight: bold;
            font-size: 2em;
            color: #007bff; /* Match the blue color of the original logo */
        }
        .logo span {
            color: #6c757d; /* Match the grey color of the original logo */
        }


            </style>

<body class="w-full min-h-screen sm:h-auto sm:p-12 sm:flex sm:items-center sm:justify-center">

<div id="page-overlay" class="visible incoming">
<div class="loader-wrapper-outer">
<div class="loader-wrapper-inner">
<div class="lds-double-ring">
<div></div>
<div></div>
<div>
<div></div>
</div>
<div>
<div></div>
</div>
</div>
</div>
</div>
</div>


<div class="up-container max-w-md overflow-hidden mx-auto p-8 sm:relative sm:bg-white sm:rounded-lg sm:shadow-lg sm:shadow-[#0057d0]/10 sm:min-w-[650px] sm:flex sm:flex-wrap">

<div class="w-full h-12 shadow-md shadow-[#0057d0]/5 rounded-lg overflow-hidden flex justify-between items-center p-5 bg-white sm:bg-[#fbfcff]  sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
<div class="logo">
        <img alt="<?php echo $name; ?>" style="height:auto;max-width:160px" src="<?php echo $logo; ?>?v=<?php echo time(); ?>">
    </div>

</div>




<div class="w-full">
<div class="flex flex-col sm:flex-row flex-wrap sm:mt-5 sm:justify-between sm:items-center">
<div class="w-full h-20 mb-4 sm:mt-0 flex justify-center items-center">
<img src="assets/rocket.png" alt="Logo" class="h-[80%]">
</div>
<div class="bg-white shadow shadow-[#0057d0]/5 rounded-lg px-5 py-3 sm:h-[85px] flex items-center sm:w-[70%] sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
<div class="w-[55px] h-[55px] p-1.5 flex justify-center items-center mr-4 ring-1 ring-[#0057d0]/10 rounded-full">
<img src="<?php echo $business_logo; ?>" alt="<?php echo $business_name; ?>" class="rounded-full" style="width:45px;height:45px;">
</div>
<div class="flex flex-col">
<h3 class="font-semibold text-[#6D7F9A]"><?php echo $business_name; ?></h3>
<span class="text-[#94a9c7] text-sm font-english">Invoice ID:</span>
<p class="text-[#6D7F9A] text-sm select-all"><?php echo $invoice; ?></p>
</div>
</div>
<div class="bg-white shadow shadow-[#0057d0]/5 rounded-lg py-3 px-2 sm:h-[85px] flex flex-col sm:items-center sm:justify-center sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10 mt-3 sm:w-[25%] sm:mt-0">
<h1 class="text-xl sm:text-2xl font-semibold text-[#6D7F9A] justify-center items-center" style="text-align: center;">TOTAL ৳ <?php echo $price; ?></h1>
</div>
</div>
<form action="mfs_verify.php" class="actionForm" method="post" accept-charset="utf-8">
<input type="hidden" name="payment_id" value="<?php echo $invoice; ?>" />          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
<input type="hidden" name="email" value="<?php echo $email; ?>" />
<input type="hidden" name="full_name" value="<?php echo $full_name; ?>" />
<input type="hidden" name="amount" value="<?php echo $price; ?>" />
<input type="hidden" name="username" value="<?php echo $username; ?>" />
<input type="hidden" name="payment_method" value="<?php echo $mfs; ?>" />
<input type="hidden" name="p_type" value="<?php echo $p_type; ?>" />
<input type="hidden" name="payer_Reference" value="<?php echo $payer_Reference; ?>" />
<input type="hidden" name="external_callback_url" value="<?php echo $external_callback_url; ?>" />

<div class="brand-bg p-5 mt-3 rounded-lg overflow-auto">
<div class="text-center mt-3">
<h2 class="mb-3 font-semibold text-white font-english">Enter Transaction ID</h2>
<input type="text" name="transaction_id" placeholder="Enter Transaction ID" class="font-english appearance-none w-full text-[15px] rounded-[10px] sm:bg-[#fbfcff] shadow shadow-[#0057d0]/5 px-5 py-3.5 placeholder-[#94A9C7] focus:outline-none focus:ring-1 focus:ring-[#0057d0]" maxlength="8" required>
</div>

<div id="sender_number" class="text-center mt-3 hidden">
<h2 class="mb-3 font-semibold text-white font-english">Enter Phone Number</h2>
<input type="text" name="phone_number" placeholder="Enter Phone Number" class="font-english appearance-none w-full text-[15px] rounded-[10px] sm:bg-[#fbfcff] shadow shadow-[#0057d0]/5 px-5 py-3.5 placeholder-[#94A9C7] focus:outline-none focus:ring-1 focus:ring-[#0057d0]" maxlength="12">
</div>

<div class>
<ul class="mt-5 text-slate-200">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Go to your Rocket Mobile Menu by dialing: *322# or Open rocket App.</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Choose: <span class="text-yellow-300 font-semibold ml-1">
"Send Money"
</span> </p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="sm:w-[90%] font-english">Enter the Receiver Account Number: <span class="text-yellow-300 font-semibold ml-1"> <?php echo $rocket; ?></span>

</p>
</li>
<div id="contentQR" class="hidden fixed top-0 left-0 w-full h-full overflow-hidden bg-[#00000080] justify-center items-center">
<div class="modal-content w-[70%] sm:w-[300px] bg-white p-[10px] rounded-lg border border-[#0057d0] shadow-lg shadow-[#00000030]">
<div>

</div>
</div>
</div>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Enter the amount: <span class="text-yellow-300 font-semibold ml-1"> <?php echo $price; ?></span></p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Now enter your rocket Mobile Menu PIN to confirm.</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Done! You will receive a confirmation message from rocket</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Put the<span class="text-yellow-300 font-semibold ml-1">Transaction ID</span> in the upper box and press<span class="text-yellow-300 font-semibold ml-1">VERIFY</span> </p>
</li>
</ul>
</div>
</div>

<div class="mt-5">
<button type="submit" id="form_submit" class="brand-btn block rounded-[10px] px-4 py-3.5 text-center font-semibold text-white transition-colors w-full">VERIFY</button>
</div>
</form> </div>

</div>

	
	
<?php

} elseif ($mfs == "upay") {

?>

<style type="text/css">
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(350deg, #f4f9ff, #edf4ffc9), url('assets/body.png');
        }


        .font-bangla {
            font-family: 'Baloo Da 2', cursive;
        }


        
        /* upay */
        
        .brand-bg {
            --tw-bg-opacity: 1;
            background-color: rgb(0 84 166 / var(--tw-bg-opacity));
        }

        .brand-hr {
            --tw-border-opacity: 1;
            border-color: rgb(0 70 138 / var(--tw-border-opacity));
        }

        .brand-btn {
            --tw-bg-opacity: 1;
            background-color: rgb(0 84 166 / var(--tw-bg-opacity));
        }

        .brand-btn:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(4 103 202 / var(--tw-bg-opacity));
        }


.logo {
            font-family: Arial, sans-serif;
            font-weight: bold;
            font-size: 2em;
            color: #007bff; /* Match the blue color of the original logo */
        }
        .logo span {
            color: #6c757d; /* Match the grey color of the original logo */
        }

            </style>

<body class="w-full min-h-screen sm:h-auto sm:p-12 sm:flex sm:items-center sm:justify-center">

<div id="page-overlay" class="visible incoming">
<div class="loader-wrapper-outer">
<div class="loader-wrapper-inner">
<div class="lds-double-ring">
<div></div>
<div></div>
<div>
<div></div>
</div>
<div>
<div></div>
</div>
</div>
</div>
</div>
</div>


<div class="up-container max-w-md overflow-hidden mx-auto p-8 sm:relative sm:bg-white sm:rounded-lg sm:shadow-lg sm:shadow-[#0057d0]/10 sm:min-w-[650px] sm:flex sm:flex-wrap">

<div class="w-full h-12 shadow-md shadow-[#0057d0]/5 rounded-lg overflow-hidden flex justify-between items-center p-5 bg-white sm:bg-[#fbfcff]  sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
<div class="logo">
        <img alt="<?php echo $name; ?>" style="height:auto;max-width:160px" src="<?php echo $logo; ?>?v=<?php echo time(); ?>">
    </div>

</div>




<div class="w-full">
<div class="flex flex-col sm:flex-row flex-wrap sm:mt-5 sm:justify-between sm:items-center">
<div class="w-full h-20 mb-4 sm:mt-0 flex justify-center items-center">
<img src="assets/upay.png" alt="Logo" class="h-[80%]">
</div>
<div class="bg-white shadow shadow-[#0057d0]/5 rounded-lg px-5 py-3 sm:h-[85px] flex items-center sm:w-[70%] sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
<div class="w-[55px] h-[55px] p-1.5 flex justify-center items-center mr-4 ring-1 ring-[#0057d0]/10 rounded-full">
<img src="<?php echo $business_logo; ?>" alt="<?php echo $business_name; ?>" class="rounded-full" style="width:45px;height:45px;">
</div>
<div class="flex flex-col">
<h3 class="font-semibold text-[#6D7F9A]"><?php echo $business_name; ?></h3>
<span class="text-[#94a9c7] text-sm font-english">Invoice ID:</span>
<p class="text-[#6D7F9A] text-sm select-all"><?php echo $invoice; ?></p>
</div>
</div>
<div class="bg-white shadow shadow-[#0057d0]/5 rounded-lg py-3 px-2 sm:h-[85px] flex flex-col sm:items-center sm:justify-center sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10 mt-3 sm:w-[25%] sm:mt-0">
<h1 class="text-xl sm:text-2xl font-semibold text-[#6D7F9A] justify-center items-center" style="text-align: center;">TOTAL ৳ <?php echo $price; ?></h1>
</div>
</div>
<form action="mfs_verify.php" class="actionForm" method="post" accept-charset="utf-8">
<input type="hidden" name="payment_id" value="<?php echo $invoice; ?>" />          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
<input type="hidden" name="email" value="<?php echo $email; ?>" />
<input type="hidden" name="full_name" value="<?php echo $full_name; ?>" />
<input type="hidden" name="amount" value="<?php echo $price; ?>" />
<input type="hidden" name="username" value="<?php echo $username; ?>" />
<input type="hidden" name="payment_method" value="<?php echo $mfs; ?>" />
<input type="hidden" name="p_type" value="<?php echo $p_type; ?>" />
<input type="hidden" name="payer_Reference" value="<?php echo $payer_Reference; ?>" />
<input type="hidden" name="external_callback_url" value="<?php echo $external_callback_url; ?>" />


<div class="brand-bg p-5 mt-3 rounded-lg overflow-auto">
<div class="text-center mt-3">
<h2 class="mb-3 font-semibold text-white font-english">Enter Transaction ID</h2>
<input type="text" name="transaction_id" placeholder="Enter Transaction ID" class="font-english appearance-none w-full text-[15px] rounded-[10px] sm:bg-[#fbfcff] shadow shadow-[#0057d0]/5 px-5 py-3.5 placeholder-[#94A9C7] focus:outline-none focus:ring-1 focus:ring-[#0057d0]" maxlength="8" required>
</div>

<div id="sender_number" class="text-center mt-3 hidden">
<h2 class="mb-3 font-semibold text-white font-english">Enter Phone Number</h2>
<input type="text" name="phone_number" placeholder="Enter Phone Number" class="font-english appearance-none w-full text-[15px] rounded-[10px] sm:bg-[#fbfcff] shadow shadow-[#0057d0]/5 px-5 py-3.5 placeholder-[#94A9C7] focus:outline-none focus:ring-1 focus:ring-[#0057d0]" maxlength="12">
</div>

<div class>
<ul class="mt-5 text-slate-200">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Go to your upay Mobile Menu by dialing: *268# or Open upay App.</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Choose: <span class="text-yellow-300 font-semibold ml-1">
"Send Money"
</span> </p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="sm:w-[90%] font-english">Enter the Receiver Account Number: <span class="text-yellow-300 font-semibold ml-1"> <?php echo $mfs; ?></span>

</p>
</li>
<div id="contentQR" class="hidden fixed top-0 left-0 w-full h-full overflow-hidden bg-[#00000080] justify-center items-center">
<div class="modal-content w-[70%] sm:w-[300px] bg-white p-[10px] rounded-lg border border-[#0057d0] shadow-lg shadow-[#00000030]">
<div>

</div>
</div>
</div>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Enter the amount: <span class="text-yellow-300 font-semibold ml-1"> <?php echo $price; ?></span></p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Now enter your upay Mobile Menu PIN to confirm.</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Done! You will receive a confirmation message from upay</p>
</li>
<hr class="brand-hr my-3">
<li class="flex text-sm">
<div><span class="inline-block w-1.5 h-1.5 mr-2 bg-white rounded-full mb-0.5"></span>
</div>
<p class="font-english">Put the<span class="text-yellow-300 font-semibold ml-1">Transaction ID</span> in the upper box and press<span class="text-yellow-300 font-semibold ml-1">VERIFY</span> </p>
</li>
</ul>
</div>
</div>

<div class="mt-5">
<button type="submit" id="form_submit" class="brand-btn block rounded-[10px] px-4 py-3.5 text-center font-semibold text-white transition-colors w-full">VERIFY</button>
</div>
</form> </div>

</div>

<?php

}

?>


</body>
</html>
