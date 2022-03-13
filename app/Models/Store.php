<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

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
}
