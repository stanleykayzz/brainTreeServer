<?php
include_once 'braintree-php-3.23.1/lib/Braintree.php';
/*Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('34ry6d2x25b9z8wb');
Braintree_Configuration::publicKey('9dwc9b6tsxtxs4gm');
Braintree_Configuration::privateKey('d61791350b7c6af607824cb97a2ceab0');*/
Braintree_Configuration::environment('production');
Braintree_Configuration::merchantId('8rb6vdg4yh67h3kc');
Braintree_Configuration::publicKey('y5vpjpgb8bq5g98n');
Braintree_Configuration::privateKey('9a86d7fddcc6efdf9d61980f7816bac6');
if(isset($_POST["NONCE"])){
  $nonceFromTheClient = $_POST["NONCE"];
  $amount = $_POST["amount"];
  $result = Braintree_Transaction::sale([
    //'amount' => '1',
    'amount' => $amount,    
    'paymentMethodNonce' => $nonceFromTheClient,
    'options' => ['submitForSettlement' => true ]
  ]);
  if ($result->success) {
      echo("success!: " . $result->transaction->id);
  } else if ($result->transaction) {
      echo "Error processing transaction: \n" . " code: " . $result->transaction->processorResponseCode . " \n " . " text: " . $result->transaction->processorResponseText;
  } else {
      echo "Validation errors: \n"; //+ $result->errors->deepAll();
  }
}else{
  echo($clientToken = Braintree_ClientToken::generate());
}
?>