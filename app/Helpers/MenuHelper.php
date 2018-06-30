<?php
namespace App\Helpers;

use App\Services\Navigation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Nutnet\Artifico2\Navigation\App\Models\Item;


class MenuHelper
{
    static function checkElementIsActive(Item $item)
    {
        $uri = Request::url();
        $href = $item->getHref();
        if ($item->type == Item::TYPE_LINK){
            $path = Request::path();
            return strncmp($href, $path, strlen($href)) === 0;
        } else {
            return (strncmp($href, $uri, strlen($href)) === 0);
        }
    }
}