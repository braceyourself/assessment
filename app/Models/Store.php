<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $id
 * @property mixed $brand_id
 * @property mixed $number
 * @property mixed $address
 * @property mixed $city
 * @property mixed $state
 * @property mixed $zip_code
 * @property mixed $created_at
 * @property mixed $updated_at
 *
 * relations
 * @method HasMany stores()
 */
class Store extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];
    protected $with   = [
        'owner',
        'brand',
        'journal',
    ];

    protected $appends = [
        'total_revenue',
        'net_profit',
        'total_labor_expense',
        'total_food_expense',
    ];

    public function owner()
    {
        return $this->hasOneThrough(User::class, StoreUser::class, 'store_id', 'id', 'id', 'user_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function journal()
    {
        return $this->hasMany(Journal::class);
    }

    /**********************************************
     * attributes
     **********************************************/

    /**
     * Accessor for $this->total_revenue
     */
    public function getTotalRevenueAttribute()
    {
        return $this->journal()->sum('profit');
    }

    /**
     * Accessor for $this->net_profit
     */
    public function getNetProfitAttribute()
    {
        return $this->total_revenue - $this->total_labor_expense - $this->total_food_expense;
    }


    /**
     * Accessor for $this->total_labor_expense
     */
    public function getTotalLaborExpenseAttribute()
    {
        return $this->journal()->sum('labor_cost');
    }

    /**
     * Accessor for $this->total_food_expense
     */
    public function getTotalFoodExpenseAttribute()
    {
        return $this->journal()->sum('food_cost');
    }


}
