<?php


namespace App\Http\Controllers\Web;


use App\Domain\Brand\Entities\Brand;
use App\Domain\Category\Entities\Category;
use App\Domain\Page\Entities\Page;
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
    protected function modifyView(string $view)
    {
        return sprintf("%s.%s", self::ROOT_VIEW_DIR, $view);
    }

    /**
     * @param $params
     * @return array
     */
    protected function modifyParams($params)
    {
        $reserved = [
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'pages' => Page::all()
        ];

        return array_merge($reserved, $params);
    }
}
