<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DeviceUserTrait;
use App\Models\User;

class device extends Model
{
    use HasFactory , DeviceUserTrait;


    public function Users()
    {
        return $this->belongsToMany(User::class);
    }
}
