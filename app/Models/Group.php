<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_group', 'group_id', 'user_id')
            ->withTimestamps();
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
