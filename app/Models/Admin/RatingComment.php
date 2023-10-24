<?php

namespace App\Models\Admin;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingComment extends Model
{
    use HasFactory;

    public function title(){
        return $this->HasOne(Title::class, 'id', 'title_id')->with( 'type', 'genre', 'sub_category' );
    }

    public function customer(){
        return $this->HasOne(Customer::class, 'id', 'customer_id');
    }
}
