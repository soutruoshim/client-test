<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function clientPhoto()
    {
        return $this->hasMany(ClientPhoto::class, 'client_id', 'id');
    }
}
