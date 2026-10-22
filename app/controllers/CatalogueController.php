<?php
class CatalogueController extends Controller
{
    public function index(): void
    {
        $q = trim($_GET['q'] ?? '');
        $this->view('catalogue/index', [
            'livres' => Livre::catalogue($q),
            'q'      => $q,
        ]);
    }
}