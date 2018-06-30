<?php

namespace App\Models;

use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use HasRoles, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeRegisteredBetween(Builder $builder, Carbon $dateFrom = null, Carbon $dateTo = null)
    {
        if (null !== $dateFrom) {
            $builder = $builder->whereRaw('DATE(created_at) >= ?', [$dateFrom->toDateString()]);
        }

        if (null !== $dateTo) {
            $builder = $builder->whereRaw('DATE(created_at) <= ?', [$dateTo->toDateString()]);
        }

        return $builder;
    }

    public function getCountUsersByDays(Carbon $dateFrom, Carbon $dateTo = null) : array
    {
        if (null === $dateTo) {
            $dateTo = Carbon::now();
        }

        $items = $this->registeredBetween($dateFrom, $dateTo)
            ->selectRaw('COUNT(*) as counter, DATE(created_at) as created_at')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('created_at')
            ->pluck('counter', 'created_at');

        $result = [];
        do {
            if (!$items->has($dateFrom->toDateString())) {
                $result[] = 0;
            } else {
                $result[] = $items->get($dateFrom->toDateString());
            }
            $dateFrom->addDay(1);
        } while ($dateTo > $dateFrom);

        return $result;
    }
}
