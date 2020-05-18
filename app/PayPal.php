<?php 
namespace App;

use URL;
use Config;

use PayPal\Core\PayPalHttpClient;
use PayPal\v1\Payments\PaymentCreateRequest;
use PayPal\v1\Payments\PaymentExecuteRequest;
use PayPal\Core\SandboxEnvironment; //ProductionEnvironment for production calls


class PayPal{
    //2 prop, son dos objetos que necesitamos congf para realizar el cobro
    public $client, $environment;

    public function __construct(){

        //van y buscan en el archivo . env los valores para las correspondientes claves
        $clientid=Config::get('services.paypal.clientid');
        $secret=Config::get('services.paypal.secret');

        $this->environment= new SandboxEnvironment($clientid,$secret);//recibe 2 argumentos, por un lado el clinte_id y por otro el secreto

        //creamos un cliente
        $this->client=new PayPalHttpClient($this->environment);

    }

    //creamos unas funciones que nos permitan construir la solicitud de pago
    //primero lo que enviamos es la sol de cobro

    //solicitud de cobro
    public function buidlPaymentRequest($amount){
        $request= new PaymentCreateRequest();

        $body = [
            "intent" => "sale",
            "transactions" => [
              [
                "amount" => ["total" => $amount, "currency" => "USD"]
              ]
            ],
            "payer" => [
              "payment_method" => "paypal",
            ],      
            'redirect_urls'=>[
                'cancel_url'=>URL::route('shopping_cart.show'),
                'return_url'=>URL::route('payments.execute')
                ]
            ];
            
            $request->body=$body;
            return $request;
        }


    
    public function charge($amount){
        return $this->client->execute($this->buidlPaymentRequest($amount));
    }

    //ejecutamos el cobro
    public function execute($paymentId,$payerId){
        $paymentExecute = new PaymentExecuteRequest($paymentId);
        $paymentExecute->body = [
            "payer_id" => $payerId
          ];
      
          return $this->client->execute($paymentExecute);
      

        

    }
    
}




?>