<?php

require_once '../vendor/autoload.php';

use Controllers\NotFoundController;
use Controllers\PromoCodeController;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'], 'application/json') === 0) {
    $input = json_decode(file_get_contents("php://input"), true);
    
    $promo_code = isset($input['promo_code']) ? trim($input['promo_code']) : '';
    $name = isset($input['name']) ? trim($input['name']) : '';
    $email = isset($input['email']) ? trim($input['email']) : '';

    if (empty($promo_code) || empty($name) || empty($email)) {
        http_response_code(400);
        die(json_encode(["status" => false, "message" => "Promo code, name, and email are required."]));
    }

    $promoCodeController = new PromoCodeController();
    die($promoCodeController->applyPromoCode($promo_code, $name, $email));
} else {
    $notFoundController = new NotFoundController();
    $notFoundController->isNotFound();
}
