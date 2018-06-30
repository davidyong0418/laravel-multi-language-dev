<?php

namespace App\Http\Controllers;
use App\Publications;
use Nutnet\Artifico2\App\Facades\AppSettings;
class PublicationsController extends Controller
{
    public function getIndex()
    {
        $allpublcations = Publications::orderBy('date','desc')->get();
        $publications = [];
        foreach ($allpublcations as $publication) {
            $publications[$publication->categories_id][] = $publication;
        }
        $phone = AppSettings::get('cms.phone');
        return view('publications.publications')->with(['publications' => $publications,'phone' => $phone]);
    }
}
?>