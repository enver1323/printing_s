<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AdminController extends Controller
{
    const ROOT_VIEW_DIR = 'admin';

    const ITEMS_PER_PAGE = 15;

    private $viewParams = [];

    protected function render(string $view, array $params = []): View
    {
        return view($this->modifyView($view), $this->modifyParams($params));
    }

    private function modifyView(string $view)
    {
        return sprintf("%s.%s", self::ROOT_VIEW_DIR, $view);
    }

    private function modifyParams($params)
    {
        return array_merge($this->viewParams, $params);
    }
}
