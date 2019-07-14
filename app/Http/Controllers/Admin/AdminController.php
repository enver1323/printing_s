<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    private static $view = 'admin';

    private static $params = [];

    protected function render(string $view, array $params)
    {
        $this->setView($view);
        $this->setParams($params);

        return view(self::$view, self::$params);
    }

    private function setView(string $view): void
    {
        self::$view = sprintf('%s.%s', self::$view, $view);
    }

    private function setParams(array $params = []): void
    {
        self::$params = array_merge(self::$params, $params);
    }
}
