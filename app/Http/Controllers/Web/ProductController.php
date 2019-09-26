<?php


namespace App\Http\Controllers\Web;


use App\Domain\Brand\Entities\Brand;
use App\Domain\Line\Entities\Line;
use Illuminate\View\View;

/**
 * Class ProductController
 * @package App\Http\Controllers\Web
 *
 * @property Brand $brands
 * @property Line $lines
 */
class ProductController extends WebController
{
    private $brands;
    private $lines;

    public function __construct(Brand $brands, Line $lines)
    {
        $this->brands = $brands;
        $this->lines = $lines;
    }

    /**
     * @param Brand $brand
     * @return View
     */
    public function brandList(Brand $brand = null): View
    {
        $brand = $brand ?? $this->brands->find(1);
        $products = $brand->products()->with('mainImage')->paginate()->mapToGroups(function ($item){
            return [$item->line_id => $item];
        });

        $lines = $this->lines->find($products->keys());

        return $this->render('brands.brandProductList', [
            'brand' => $brand,
            'brands' => $this->brands->all(),
            'products' => $products,
            'lines' => $lines
        ]);
    }
}
