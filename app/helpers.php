<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 18.04.17
 */

if (!function_exists('random_array_item')) {
    // случайный элемент массива
    function random_array_item(array $range)
    {
        shuffle($range);

        return end($range);
    }
}

if (!function_exists('price_format')) {
    function price_format($price, $currencyPostfix = true)
    {
        $price = number_format($price, 0, '.', ' ');

        if (!$currencyPostfix) {
            return $price;
        }

        return sprintf('%s %s', $price, 'р.');
    }
}

if (!function_exists('user_can')) {
    function user_can($ability, \App\Models\User $user = null): bool
    {
        if (null === $user) {
            $user = request()->user();
        }

        if (null === $user) {
            return false;
        }

        return $user->can('*') || $user->can($ability);
    }
}

if (!function_exists('user_can_route')) {
    // может ли пользователь переходить по роуту?
    function user_can_route($route, \App\Models\User $user = null): bool
    {
        /** @var \Illuminate\Routing\Route $route */
        $route = \Illuminate\Support\Facades\Route::getRoutes()->getByName($route);

        if (null === $route) {
            return true;
        }

        // получаем middleware permission
        $permMw = array_filter($route->controllerMiddleware(), function ($m) {
            return strncmp($m, 'permission:', 11) === 0;
        });
        $neededAbilities = array_map(function ($m) {
            return str_replace('permission:', '', $m);
        }, $permMw);

        foreach ($neededAbilities as $ability) {
            if (!user_can($ability, $user)) {
                return false;
            }
        }

        return true;
    }
}
