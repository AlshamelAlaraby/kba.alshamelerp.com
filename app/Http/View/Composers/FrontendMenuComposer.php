<?php

namespace App\Http\View\Composers;

use App\Modules\Category\CategoryLibrary;
use App\Modules\Page\PageLibrary;
use Illuminate\View\View;

class FrontendMenuComposer
{
    private $categoryLibrary,$pageLibrary;

    public function __construct(CategoryLibrary $categoryLibrary,PageLibrary $pageLibrary)
    {
        $this->categoryLibrary = $categoryLibrary;
        $this->pageLibrary = $pageLibrary;
    }

    public function compose(View $view)
    {
        $view->with([
            'menuCategoriesList'=> $this->categoryLibrary->toTree(),
            'pages'=> $this->pageLibrary->all()
        ]);
    }
}
