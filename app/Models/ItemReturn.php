<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemReturn extends Model
{
    protected $guarded = [];

    public function loan()
    {
        return $this->belongsTo(ItemLoan::class);
    }
}
