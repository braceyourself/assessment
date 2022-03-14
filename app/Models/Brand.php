<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed $name
 * @property mixed $color
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class Brand extends Model
{
    use HasFactory;

    /**********************************************
     * relations
     **********************************************/
    public function stores()
    {
        return $this->hasMany(Store::class, 'brand_id');
    }

    /**********************************************
     * attributes
     **********************************************/
    /**
     * Accessor for $this->logo_text
     */
    public function getLogoTextAttribute()
    {
        return \Str::of($this->name)
                   ->upper()
                   ->explode(" ")
                   ->take(2)
                   ->map(fn($i) => $i[0])->join('');
    }

}
