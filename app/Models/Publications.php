<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Publications extends Model
{
    const TV = 1;
    const RADIO = 2;
    const PRESS = 3;

    public static $categories = [
        self::TV => array(
            'name' => 'Телепрограммы',
            'selector' => 'tv'
        ),
        self::RADIO => array(
            'name' => 'Радиоэфиры',
            'selector' => 'radio'
        ),
        self::PRESS => array(
            'name' => 'Пресса',
            'selector' => 'press'
        ),
    ];
}
