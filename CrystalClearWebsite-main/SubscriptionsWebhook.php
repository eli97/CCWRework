<?php
//constants defined for each service offered, correspond to plan id in business dashboard.
define("TEST_SUBSCRIPTION", "P-7YC00723S7003023BMOGXSQQ");
define("FULL_SERVICE5", "P-1T820724FE3270944MOB563Y");
define("FULL_SERVICE4", "P-0BP340016E096322YMOB55KA");
define("FULL_SERVICE3", "P-5G4302032C805280UMOB5WVY");
define("FULL_SERVICE2", "P-7DP89350A4104772AMOB5R2I");
define("FULL_SERVICE1", "P-5M55712851419515UMNLSLFI");
define("CHEMICAL_BASKETS", "P-56D36467UM5356547MNLSN6A");
define("BASIC_SERVICE", "P-9HF66130V58251053MNKGDKA");

$myfile = fopen("subscriptionsWebhookLog.txt", "a");
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

$webhookID = "8MK39731XM8109006";

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
} else if ($sigVerificationResult == "SUCCESS") {

    //paypal webhook signature is valid
//proceed to process webhook payload
//decode raw request body

    $requestBodyDecode = json_decode($requestBody);

    //fwrite($myfile, "\n Printing JSON:");
    //fwrite($myfile, "\n" . print_r($requestBodyDecode, TRUE));
    //fwrite($myfile, "\n End of JSON");
    fwrite($myfile, $date);
    $eventType = $requestBodyDecode->event_type;
    fwrite($myfile, "\nEvent Type: " . $eventType);
    $paymentSystemID = $requestBodyDecode->id;
    fwrite($myfile, "\nPayment System ID: " . $paymentSystemID);
    $email = $requestBodyDecode->resource->subscriber->email_address;
    $upper_email = strtoupper($email);
    fwrite($myfile, "\nCustomer Email: " . $email);
    //$amount = $requestBodyDecode->resource->purchase_units[0]->amount->value;
    //fwrite($myfile, "\nAmount: ".$amount);
    $address = $requestBodyDecode->resource->subscriber->shipping_address->address->address_line_1;
    fwrite($myfile, "\nAddress: " . $address);
    $name = $requestBodyDecode->resource->subscriber->name->given_name;
    $surname = $requestBodyDecode->resource->subscriber->name->surname;
    $fullname = $name . " " . $surname;
    fwrite($myfile, "\nName: " . $fullname);
    $upper_fullname = strtoupper($fullname);
    $plan_id = $requestBodyDecode->resource->plan_id;
    fwrite($myfile, "\nPlan ID: " . $plan_id . "\n");
    


    error_reporting(E_ALL & ~E_NOTICE);
    define("DB_HOST", "localhost");
    define("DB_NAME", "rystaly5_CrystClearMainDB");
    define("DB_CHARSET", "utf8");
    define("DB_USER", "rystaly5_eli");
    define("DB_PASSWORD", "loveKTN19$97");

    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        fwrite($myfile, "\nConnection to database established");
    } catch (Exception $ex) {
        fwrite($myfile, "\nError connecting to database");
        exit($ex->getMessage());
    }


    /*
    find the customer in question
    update their subscription status
    insert transaction data into invoice table 
    may need webhooks for PAYMENT.SALE.COMPLETED and BILLING.SUBSCRIPTION.UPDATED
    only BILLING.SUBSCRIPTION.ACTIVATED has all the information.
    may need to utuilizse billing_agreement_id from PAYMENT.SALE.COMPLETED to set isActive
    and retrieve amount paid.
    */

    if ($eventType == "BILLING.SUBSCRIPTION.ACTIVATED") {
        //just check the subscription type and update it every time. 
        $stmt = $pdo->prepare('SELECT cid FROM CUSTOMER WHERE UPPER(email) = :email');
        $stmt->bindParam(':email', $upper_email, PDO::PARAM_STR);
        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$customers) { //what about the case where there are duplicate customers?
            fwrite($myfile, "\n Customer id not found! ");
        }
         else {
            //determine the service type
            //set isActive true
            //set appropriate service type
            //set subscription date 
            //on first subscription, add appropriate number of filter washes
            switch ($plan_id) {
                case TEST_SUBSCRIPTION :
                    $service_type = "Test Service";
                    break;
                case FULL_SERVICE5 :
                    $service_type = "Full Service";
                    break;
                case FULL_SERVICE4 :
                    $service_type = "Full Service";
                    break;
                case FULL_SERVICE3 :
                    $service_type = "Full Service";
                    break;
                case FULL_SERVICE2 :
                    $service_type = "Full Service";
                case FULL_SERVICE1 :
                    $service_type = "Full Service";
                    break;
                case CHEMICAL_BASKETS :
                    $service_type = "Chemical+Baskets";
                    break;
                case BASIC_SERVICE :
                    $service_type = "Basic Service";
                    break;
                default:
                    fwrite($myfile, "\nError determining which service customer subscribed to");
            }
            $cid = $customers[0]['cid'];
            fwrite($myfile, "\nCustomer ID " . $cid . " has made a payment for " . $service_type . ". Updating databse.");
            $stmt = $pdo->prepare('UPDATE CUSTOMER SET isActive = 1, subscriptionDate = CURRENT_DATE(), serviceName = :service_type WHERE cid = :cid');
            $stmt->bindParam(':cid', $cid, PDO::PARAM_INT);
            $stmt->bindParam(':service_type', $service_type, PDO::PARAM_STR);
            try {
                $stmt->execute();
            }
            catch (Exception $ex)
            {
                fwrite($myfile, "\nError updating database with customer subscription: ".$ex);
            }
            $pdo = null;
            $stmt = null;
        }
    } elseif (
        $eventType == "PAYMENT.SALE.REFUNDED" ||
        $eventType == "PAYMENT.SALE.REVERSED" ||
        $eventType == "BILLING.SUBSCRIPTION.SUSPENDED" ||
        $eventType == "BILLING.SUBSCRIPTION.EXPIRED" ||
        $eventType == "BILLING.SUBSCRIPTION.CANCELLED" ||
        $eventType == "BILLING.SUBSCRIPTION.PAYMENT.FAILED"
    ) {
        //a customer's subscription will be inactive for any of the above reasons. 
        $stmt = $pdo->prepare('SELECT cid FROM CUSTOMER WHERE UPPER(email) = :email');
        $stmt->bindParam(':email', $upper_email, PDO::PARAM_STR);
        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$customers) { //what about the case where there are duplicate customers?
            fwrite($myfile, "\n Customer id not found! ");
        }
        else{
            $service_type = "No Service";
            $cid = $customers[0]['cid'];
            $stmt = $pdo->prepare('UPDATE CUSTOMER SET isActive = 0, serviceName = :service_type WHERE cid = :cid');
            $stmt->bindParam(':cid', $cid, PDO::PARAM_INT);
            $stmt->bindParam(':service_type', $service_type, PDO::PARAM_STR);
            $stmt->execute();
        }
        $pdo = null;
        $stmt = null;
    }
    fwrite($myfile, "\n=========================================================================\n");
    fclose($myfile);
}