<?php
class Controller
{
    protected function view(string $vue, array $data = []): void
    {
        extract($data);
        ob_start();
        require __DIR__ . "/../views/$vue.php";
        $content = ob_get_clean();
        require __DIR__ . '/../views/layouts/main.php';
    }

    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }
}