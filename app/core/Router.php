<?php
class Router
{
    private array $map = [
        'auth'      => 'AuthController',
        'livres'    => 'LivreController',
        'adherents' => 'AdherentController',
        'emprunts'  => 'EmpruntController',
        'catalogue' => 'CatalogueController',
    ];

    public function run(): void
    {
        $url = $_GET['url'] ?? trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $parts = $url === '' ? [] : explode('/', trim($url, '/'));

        $seg = $parts[0] ?? 'catalogue';
        $class = $this->map[$seg] ?? null;
        $method = $parts[1] ?? 'index';
        $params = array_slice($parts, 2);

        $obj = ($class && class_exists($class)) ? new $class() : null;

        if (!$obj || !is_callable([$obj, $method])) {
            http_response_code(404);
            echo '404 - Page introuvable';
            return;
        }
        $obj->$method(...$params);
    }
}