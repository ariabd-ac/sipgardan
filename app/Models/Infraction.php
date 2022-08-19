<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infraction extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function scopeFilter($query, array $filters)
    // {
    //     if(isset($filters['search']) ? $filters['search'] : false) {
    //         return $query->where('nama', 'like', '%' . $filters('search') . '%')
    //         ->orWhere('status', 'like', '%' . $filters('search') . '%');
    //     }
    // }

    public function scopeFilter($query) {
       if (request('search')) { 
           return $query->where('nama', 'like', '%' . request('search') . '%')->orWhere('status' , 'like', '%' . request('search') . '%');
       }
    }
}
