<?php
namespace Controllers;

class NotFoundController extends BaseController {

    public function isNotFound() {
        http_response_code(404);
        $this->sendJsonResponse(["status" => false, "message" => "Invalid request method."]);
    }
}
