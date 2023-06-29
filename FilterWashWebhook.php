<?php
$myfile = fopen("filterWashWebhookLog.txt", "a");
//get the webhook payload
$requestBody = file_get_contents('php://input');
$date = date("F j, Y, g:i a"); 
//check if webhook payload has data
if($requestBody) {
//request body is set
} else {
    fwrite($myfile, "Webhook Payload has no data\n");
    fwrite($myfile, $date);
//request body is not set
exit(); 
}

use \PayPal\Api\VerifyWebhookSignature;
use \PayPal\Api\WebhookEvent;
$apiContext = require __DIR__ . '/bootstrap.php';

//Receive HTTP headers that you received from PayPal webhook.

$headers = getallheaders();

//need header keys to be UPPERCASE

$headers = array_change_key_case($headers, CASE_UPPER);

/*
example header paypal signature content for webhook, these values are recieved as an array, we then need to use this data to verify the payload
CONTENT-LENGTH : 1376
CORRELATION-ID : 6db85170269e7
USER-AGENT : PayPal/AUHD-214.0-54377828
CONTENT-TYPE: application/json
PAYPAL-AUTH-ALGO : SHA256withRSA
PAYPAL-CERT-URL : https://api.paypal.com/v1/notifications/certs/CERT-360caa42-fca2a784-5edc0ebc
PAYPAL-AUTH-VERSION : v2
PAYPAL-TRANSMISSION-SIG : Hc2lsDedYdSjOM4/t3T/ioAVQqFPNVB/AY/EyPNlavXk5WYUfnAmt9dyEP6neAPOjFHiVkXMK+JlLODbr6dalw6i26aFQdsPXqGl38Mafuu9elPE74qgsqNferUFgHi9QFXL+UZCNYcb4mvlDePXZIIAPbB0gOuFGOdEv2uqNwTCSAa/D8aguv1/51FWb3RkytFuVwXK/XNfIEy2oJCpDs8dgtYAZeojH8qO6IAwchdSpttMods5YfNBzT7oCoxO80hncVorBtjj1zQrkoynEB9WNNN9ytepNCkT8l29fQ4Sx/WRndm/PESCqxqmRoYJoiSosxYU3bZP7QTtILDykQ==
PAYPAL-TRANSMISSION-TIME : 2020-04-05T14:40:43Z
PAYPAL-TRANSMISSION-ID : 6dec99b0-774b-11ea-b306-c3ed128f0c4b
*/

//if any of the relevant paypal signature headers are not set exit()

if(
(!array_key_exists('PAYPAL-AUTH-ALGO', $headers)) ||
(!array_key_exists('PAYPAL-TRANSMISSION-ID', $headers)) ||
(!array_key_exists('PAYPAL-CERT-URL', $headers)) ||
(!array_key_exists('PAYPAL-TRANSMISSION-SIG', $headers)) ||
(!array_key_exists('PAYPAL-TRANSMISSION-TIME', $headers)) 
){
    $txt = "PAYPAL HEADERS NOT SET CORRECTLY\n";
    fwrite($myfile, $txt);
exit();     
}

//specify the ID for the webhook that you have set up on the paypal developer website, each web hook that you create has a unique ID

$webhookID = "8RK41636GB7028228";

//start paypal webhook signature validation 

$signatureVerification = new VerifyWebhookSignature();
$signatureVerification->setAuthAlgo($headers['PAYPAL-AUTH-ALGO']);
$signatureVerification->setTransmissionId($headers['PAYPAL-TRANSMISSION-ID']);
$signatureVerification->setCertUrl($headers['PAYPAL-CERT-URL']);
$signatureVerification->setWebhookId($webhookID); 
$signatureVerification->setTransmissionSig($headers['PAYPAL-TRANSMISSION-SIG']);
$signatureVerification->setTransmissionTime($headers['PAYPAL-TRANSMISSION-TIME']);

$signatureVerification->setRequestBody($requestBody);
$request = clone $signatureVerification;

try {

$output = $signatureVerification->post($apiContext);

} catch (Exception $ex) {

//error during signature validation, capture error and exit

ResultPrinter::printError("Validate Received Webhook Event", "WebhookEvent", null, $request->toJSON(), $ex);
exit(1);

}


$sigVerificationResult = $output->getVerificationStatus();

// $sigVerificationResult is a string and will either be "SUCCESS" or "FAILURE"


//if not webhook signature failed validation exit
if($sigVerificationResult != "SUCCESS"){
    fwrite($myfile, "Signature verification failed: ");
    fwrite($myfile, $date);
exit(); 
}
else if($sigVerificationResult == "SUCCESS"){

//paypal webhook signature is valid
//proceed to process webhook payload
//decode raw request body

$requestBodyDecode = json_decode($requestBody);
//fwrite($myfile, "\n Printing JSON:");
//fwrite($myfile, "\n".print_r($requestBodyDecode, TRUE));
//fwrite($myfile, "\n End of JSON");
fwrite($myfile, $date);
$eventType = $requestBodyDecode->event_type;
fwrite($myfile, "\nEvent Type: ".$eventType);
$paymentSystemID = $requestBodyDecode->id;
fwrite($myfile, "\nPayment System ID: ".$paymentSystemID);
$email = $requestBodyDecode->resource->payer->email_address;
$upper_email = strtoupper($email);
fwrite($myfile, "\nCustomer Email: ".$email);
$amount = $requestBodyDecode->resource->purchase_units[0]->amount->value;
fwrite($myfile, "\nAmount: ".$amount);
$address = $requestBodyDecode->resource->purchase_units[0]->shipping->address->address_line_1;
fwrite($myfile, "\nAddress: ".$address);
$name = $requestBodyDecode->resource->payer->name->given_name;
$surname = $requestBodyDecode->resource->payer->name->surname;
$fullname = $name." ".$surname;
fwrite($myfile, "\nName: ".$fullname."\n");
$upper_fullname = strtoupper($fullname);


error_reporting(E_ALL & ~E_NOTICE);
define("DB_HOST", "localhost");
define("DB_NAME", "rystaly5_CrystClearMainDB");
define("DB_CHARSET", "utf8");
define("DB_USER", "rystaly5_eli");
define("DB_PASSWORD", "loveKTN19$97");

try{
    $pdo = new PDO("mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    fwrite($myfile, "\nConnection to database established");
    } catch (Exception $ex) {
        fwrite($myfile, "\nError connecting to database. Error: ".$ex);
        exit($ex->getMessage());
    }
/*
find the customer in question
increase their filter wash count by 1
insert transaction data into invoice table 
*/
    if ($eventType == "CHECKOUT.ORDER.APPROVED") {
        $stmt = $pdo->prepare('SELECT cid FROM CUSTOMER WHERE UPPER(email) = :email');
        $stmt->bindParam(':email', $upper_email, PDO::PARAM_STR);
        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!$customers){ //what about the case where there are duplicate customers?
            fwrite($myfile, "\n Customer id not found! ");
        } else {
            fwrite($myfile, "\nCustomer ID " . $customers[0]['cid'] . " has purchased a filter wash. Updating databse.");
            $cid = $customers[0]['cid'];
            $stmt = $pdo->prepare('SELECT filterWashes FROM CUSTOMER WHERE cid = :cid');
            $stmt->bindParam(':cid', $cid, PDO::PARAM_INT);
            $stmt->execute();
            $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $numWashes = $customers[0]['filterWashes'];
            if(!$numWashes or $numWashes == 0){
                $numWashes = 1;
            }
            else{
                $numWashes += 1;
            }
            $stmt = $pdo->prepare('UPDATE CUSTOMER SET filterWashes = :numWashes WHERE cid = :cid');
            $stmt->bindParam(':numWashes',$numWashes, PDO::PARAM_INT);
            $stmt->bindParam(':cid', $cid, PDO::PARAM_INT);
            try {
                $stmt->execute();
            }
            catch(Exception $ex){
                fwrite($myfile, "\n Customer filter wash update not executed! Error message: ".$ex);
            }
        }
        $pdo = null;
        $stmt = null;
    }

fwrite($myfile, "\n=========================================================================\n");
fclose($myfile);
} 

/*
<script type="text/javascript">
        $(document).ready(function() {
            $('#profileName').text(localStorage.getItem('name'));  //change to id 
            $('#name').text(localStorage.getItem('name'));
            $('#email').text(localStorage.getItem('email'));
            $('#image').attr("src", localStorage.getItem('image'));
        })
        var check = {};
        check.id = JSON.stringify(localStorage.getItem('id'));
        $.ajax({
        url:"https://crystalclearwestsac.com/assets/php/checkprofile.php",
        method: "post",
        data: check,
        datatype: "json",
        success: function(res) {
            //document.getElementById('name').innerHTML = res.cname;
            //document.getElementById('email').innerHTML = res.email;
            document.getElementById('phone').innerHTML = res.phone;
            document.getElementById('street').innerHTML = res.street;
            document.getElementById('city').innerHTML = res.city;
            document.getElementById('state').innerHTML = res.state;
            document.getElementById('zip').innerHTML = res.zip;
            document.getElementById('filter').innerHTML = res.filterWashes;
            document.getElementById('date').innerHTML = res.subscriptionDate;
            document.getElementById('service').innerHTML = res.serviceName;

        },
          error: function(res) {
              alert("Error!");
          }
        }
    );
*/