<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 12.12.16
 */

namespace App\Http\Controllers;

use Nutnet\Artifico2\Pages\App\Models\Page;
use Nutnet\Artifico2\App\Facades\AppSettings;

class PagesController extends Controller
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
    public function page($alias)
    {
        /** @var Page $page */
        $page = $this->model->alias($alias)->firstOrFail();
        if (!$page->active)
            abort(404);
        else
        $viewData = [
            'page' => $page
        ];
        $phone = AppSettings::get('cms.phone');
        return view(config('artifico-pages.page_template'), $viewData)->with(['phone' => $phone]);
    }
}
