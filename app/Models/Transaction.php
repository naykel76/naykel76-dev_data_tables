<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $casts = [
        'amount' => \Naykel\Gotime\Casts\MoneyCast::class,
        // 'created_at' => \Naykel\Gotime\Casts\DateCast::class,
    ];

    public function dateForHumans()
    {
        return $this->created_at->format('d-m-Y');
    }

    public function scopeFilterBy ($query, $felid = 'description', $filterBy)
    {
        return $query->where($felid, $filterBy);
    }
}
