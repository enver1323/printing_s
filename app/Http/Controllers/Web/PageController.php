<?php


namespace App\Http\Controllers\Web;


use App\Domain\Page\Entities\Page;

class PageController extends WebController
{
    public function show(Page $page)
    {
        return $this->render('pages.pageShow', [
            'page' => $page
        ]);
    }
}
