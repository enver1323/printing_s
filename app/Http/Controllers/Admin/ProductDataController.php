<?php


namespace App\Http\Controllers\Admin;


use App\Domain\Category\Entities\Category;
use App\Domain\Product\UseCases\ProductDataService;
use App\Domain\Translation\Entities\Language;
use Illuminate\View\View;

/**
 * Class ProductDataController
 * @package App\Http\Controllers\Admin
 *
 * @property ProductDataService $service
 * @property Language $languages
 */
class ProductDataController extends AdminController
{
    private $service;
    private $languages;

    public function __construct(ProductDataService $service, Language $languages)
    {
        $this->service = $service;
        $this->languages = $languages;
    }

    /**
     * @param Category|null $category
     * @return View
     */
    public function create(Category $category = null): View
    {
        return $this->render('products.data.keys.productDataKeyCreate', [
            'category' => $category,
            'languages' => $this->languages->all()
        ]);
    }
}
