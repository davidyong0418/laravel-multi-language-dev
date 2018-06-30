<?php
namespace App\Http\Controllers;

use Nutnet\Artifico2\Pages\App\Models\Page;
use Nutnet\Artifico2\App\Facades\AppSettings;

class IndexController extends Controller
{
    /**
     * @var Page
     */
    private $model;

    /**
     * Pages constructor.
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    /**
     * Show page
     * @param $alias
     * @return mixed
     */
    public function page()
    {
        /** @var Page $page */
        $page = $this->model->alias(config('index_page.page_alias'))->first();
        if (!$page)
            return view('welcome');
        else
        $viewData = [
            'page' => $page
        ];
        $phone = AppSettings::get('cms.phone');
        return view(config('index_page.page_template'), $viewData)->with(['phone' => $phone]);

    }
}

?>