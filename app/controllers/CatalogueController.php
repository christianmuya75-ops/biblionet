<?php
class CatalogueController extends Controller
{
    public function index(): void
    {
        $this->view('catalogue/index');
    }
}