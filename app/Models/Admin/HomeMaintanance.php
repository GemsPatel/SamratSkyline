<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeMaintanance extends Model
{
    use HasFactory;

    public function home(){
        return $this->hasOne( Home::class, 'id', 'home_id' );
    }
}
