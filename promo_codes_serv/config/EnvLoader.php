<?php

namespace Config;

use Dotenv\Dotenv;

class EnvLoader {
    private static $isLoaded = false;

    public static function loadEnv() {
        if (!self::$isLoaded) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();
            self::$isLoaded = true;
        }
    }

    public static function get($key, $default = null) {
        self::loadEnv();
        return $_ENV[$key] ?? $default;
    }
}
