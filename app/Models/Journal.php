<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 * @property mixed $store_id
 * @property mixed $date
 * @property mixed $revenue
 * @property mixed $food_cost
 * @property mixed $labor_cost
 * @property mixed $profit
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class Journal extends Model
{
    use HasFactory;

    public static function intervals($key = null)
    {
        $intervals = collect([
            'today'      => today(),
            'past_week'  => now()->subWeek(),
            'past_month' => now()->subMonth(),
            'past_year'  => now()->subYear(),
            'ytd'        => now()->setMonth(1)->setDay(1),
            'mtd'        => now()->setDay(1)
        ]);

        if ($key) {
            return $intervals->get($key);
        }

        return $intervals;
    }

    /**********************************************
     * relations
     **********************************************/
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**********************************************
     * scopes
     **********************************************/
    public function scopeSince(Builder $q, $since)
    {
        return $q->whereBetween('created_at', [Journal::intervals($since), now()]);
    }

}
