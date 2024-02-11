<?php
require_once '../vendor/autoload.php';
 


$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AaT6ikYdyPuULkTYx6g9T-XK8T2X1t1nUr3fhiL0sc7XTNXkPOZlAfS8RICxWFgtyHMBiF9Owpus6TTN',     // ClientID
        'EILZNa4ANpYHS3oyzy-hNoa0X_XK16prhhj-jCPOqHAsWz_dODW9SvdFuMXbfkn21_ptLnBOkx4FbzIa'      // ClientSecret
    )
);
$apiContext->setConfig(
    array(
        'log.LogEnabled' => true,
        'log.FileName' => 'PayPal.log',
        'log.LogLevel' => 'DEBUG',
        'mode' => 'sandbox', //'live' or 'sandbox'
    )
);
// After Step 2
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$item1 = new \PayPal\Api\Item();
$item1->setName($_POST['item'])
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setPrice($_POST['amount']);


$itemList = new \PayPal\Api\ItemList();
$itemList->setItems(array($item1));

$amount = new \PayPal\Api\Amount();
$amount->setTotal($_POST['amount']);
$amount->setCurrency('USD');

$transaction = new \PayPal\Api\Transaction();
$transaction->setDescription("Payment For Service")
            ->setItemList($itemList)
            ->setAmount($amount);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("http://localhost/EducationPlatform/")
    ->setCancelUrl("http://localhost/EducationPlatform/error.php");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

// After Step 3
try {
    $payment->create($apiContext);
    echo $payment;
    setcookie('userPaid', 'yes', time() + 3600, '/');
    echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}