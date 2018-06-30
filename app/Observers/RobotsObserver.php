<?php

namespace App\Observers;

//use App\Robot;
use Nutnet\Artifico2\App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class RobotsObserver
{
    /**
     * Listen to the User updated event.
     *
     * @param  User  $user
     * @return void
     */
    public function updated(Setting $setting)
    {

        if ($setting->key == 'cms.robots')
        {
            Storage::disk('pub')->put('robots.txt', $setting->value);
        }
    }

}