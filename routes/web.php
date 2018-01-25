<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use infobip\api\client\SendSingleTextualSms;
use infobip\api\configuration\BasicAuthConfiguration;
use infobip\api\model\sms\mt\send\textual\SMSTextualRequest;

Route::get('/', function () {
    return view('welcome');
});


Route::get('send-message', function () {
    	
// Initializing SendSingleTextualSms client with appropriate configuration
$client = new SendSingleTextualSms(new BasicAuthConfiguration('ademia', 'miguelon1982'));
// Creating request imap_body(imap_stream, msg_number)
$requestBody = new SMSTextualRequest();
$requestBody->setFrom('584126826027');
$requestBody->setTo(['584262401376']);
$requestBody->setText("This is an example message.");
// Executing request
try {
    $response = $client->execute($requestBody);
    $sentMessageInfo = $response->getMessages()[0];
 // dd($sentMessageInfo);
    echo "Message ID: " . $sentMessageInfo->getMessageId() . "\n";
    echo "Receiver: " . $sentMessageInfo->getTo() . "\n";
    echo "Message status: " . $sentMessageInfo->getStatus()->getName();
} catch (Exception $exception) {
    echo "HTTP status code: " . $exception->getCode() . "\n";
    echo "Error message: " . $exception->getMessage();
}



	// $curl = curl_init();

	// curl_setopt_array($curl, array(
	// 	  CURLOPT_URL => "http://api.infobip.com/sms/1/text/single",
	// 	  CURLOPT_RETURNTRANSFER => true,
	// 	  CURLOPT_ENCODING => "",
	// 	  CURLOPT_MAXREDIRS => 10,
	// 	  CURLOPT_TIMEOUT => 30,
	// 	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 	  CURLOPT_CUSTOMREQUEST => "POST",
	// 	  CURLOPT_POSTFIELDS => "{ \"from\":\"InfoSMS\", \"to\":\"41793026727\", \"text\":\"Test SMS.\" }",
	// 	  CURLOPT_HTTPHEADER => array(
	// 	    "accept: application/json",
	// 	    "authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==",
	// 	    "content-type: application/json"
	// 	  ),
	// ));
	// $response = curl_exec($curl);
	// dd($response);
	// $err = curl_error($curl);

	// curl_close($curl);

	// if ($err) {
	//   echo "cURL Error #:" . $err;
	// } else {
	//   echo $response;
	// }



});





