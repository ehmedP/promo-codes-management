<?php
namespace Controllers;

use Config\EnvLoader;

class BaseController {
    protected function sendJsonResponse($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }

    public function __construct() {
        $this->checkAppType();
    }

    protected function handle404() {
        $this->sendJsonResponse(["status" => false, "message" => "Not Found"], 404);
    }

    protected function checkAppType() {
        $appType = EnvLoader::get('APP_TYPE', 'web');
        if ($appType !== 'api') {
            $this->sendJsonResponse(["status" => false, "message" => "Invalid request type"], 400);
        }
    }
}
