<?php
    require './vendor/autoload.php';
    header('Content-Type', 'application/json');

 

$items = array();

if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $title1 = $parts[0];
        if ($title1 != "PHPSESSID"){
            $value = explode(',',$parts[1]);
            $b = array($title1,$value[0],$value[2]);
            array_push($items,$b);
        }
    }
}

$line_items = [];

foreach($items as $a){
    $v = [
        "price_data" =>[  
            "currency" =>"inr",
            "product_data" =>[
                "name"=> $a[0]
            ],
            "unit_amount" => $a[1] * 100
        ],
        "quantity" => $a[2] 
    ];
    array_push($line_items,$v);
}

    $stripe = new Stripe\StripeClient("sk_test_51MoHmPSJKkdwyKwt62oVyFtGI3JP92Z934kaesQQRz64srdLRg6AJWyeVJenyTjqu26KkcnEKBFJTxq0cvrad1tG00AOkQ6KYF");
    $session = $stripe->checkout->sessions->create([
        "success_url" => "http://localhost:8080/success.php",
        "cancel_url" => "http://localhost:8080/Mainpage.php",
        "payment_method_types" => ['card'],
        "mode" => 'payment',
        "line_items" => $line_items
    ]);

    echo json_encode($session);

    ?>