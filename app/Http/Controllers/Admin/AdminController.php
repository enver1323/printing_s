<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $service;

    const ITEMS_PER_PAGE = 15;

    private $view = 'admin';

    private $params = [];

    protected function render($view, $params = [])
    {
        $this->setView($view);
        $this->setParams($params);

        return view($this->view, $this->params);
    }

    protected function setView(string $view): void
    {
        $this->view = sprintf('%s.%s', $this->view, $view);
    }

    private function setParams(array $params): void
    {
        $this->params = array_merge($this->params, $params);
    }
}
