<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    /**********************************************
     * relations
     **********************************************/
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
