<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = [
        'user_id',
        'group_id',
        'category_id',
        'description',
        'amount',
        'concept',
        'type',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
