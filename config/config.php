<?php
$env = [];
$path = __DIR__ . '/../.env';
if (file_exists($path)) {
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $ligne) {
        if (strpos($ligne, '=') === false) continue;
        [$k, $v] = explode('=', $ligne, 2);
        $env[trim($k)] = trim($v);
    }
}
return $env;