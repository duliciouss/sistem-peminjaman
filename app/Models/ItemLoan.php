<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemLoan extends Model
{
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
