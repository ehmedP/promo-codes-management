<?php
namespace Models;

class PromoCode extends BaseModel {
    private $table_name = "promo_codes";
    private $users_table = "promocode_users";

    public function getPromoCodeId($code) {
        $sql = "SELECT id FROM " . $this->table_name . " WHERE code = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $stmt->bind_result($promoCodeId);
        $stmt->fetch();

        return $promoCodeId;
    }

    public function saveUserPromoCode($promoCodeId, $name, $email) {
        $sql = "INSERT INTO " . $this->users_table . " (name, email, used_promocode_id) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $promoCodeId);
        $stmt->execute();
    }
}