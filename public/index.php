<?php
// Serveur PHP intégré : laisser passer les fichiers statiques
if (php_sapi_name() === 'cli-server') {
    $f = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($f)) return false;
}

session_start();

spl_autoload_register(function ($class) {
    foreach (['core', 'controllers', 'models'] as $dossier) {
        $f = __DIR__ . "/../app/$dossier/$class.php";
        if (file_exists($f)) { require $f; return; }
    }
});

(new Router())->run();