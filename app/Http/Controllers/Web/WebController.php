<?php


namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use Illuminate\View\View;


/**
 * Class WebController
 * @package App\Http\Controllers\Web
 */
class WebController extends Controller
{
    const ROOT_VIEW_DIR = 'frontend';

    const ITEMS_PER_PAGE = 15;

    private $viewParams = [];

    /**
     * @param string $view
     * @param array $params
     * @return View
     */
    protected function render(string $view, array $params = []): View
    {
        return view($this->modifyView($view), $this->modifyParams($params));
    }

    /**
     * @param string $view
     * @return string
     */
    private function modifyView(string $view)
    {
        return sprintf("%s.%s", self::ROOT_VIEW_DIR, $view);
    }

    /**
     * @param $params
     * @return array
     */
    private function modifyParams($params)
    {
        return array_merge($this->viewParams, $params);
    }
}
