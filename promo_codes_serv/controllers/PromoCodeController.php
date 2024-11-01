<?php
namespace Controllers;

use Models\PromoCode;

class PromoCodeController extends BaseController {
    private $promoCodeModel;

    public function __construct() {
        parent::__construct();
        $this->promoCodeModel = new PromoCode();
    }

    public function applyPromoCode($promo_code, $name, $email) {
        $promoCodeId = $this->promoCodeModel->getPromoCodeId($promo_code);

        if ($promoCodeId) {
            $this->promoCodeModel->saveUserPromoCode($promoCodeId, $name, $email);
            
            $this->sendJsonResponse(["status" => true, "message" => "Promo code applied successfully."]);
        } else {
            $this->sendJsonResponse(["status" => false, "message" => "Invalid promo code."]);
        }
    }
}
