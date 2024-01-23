<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Store extends Model
{
    use HasFactory;
    protected $fillable = ['store_name','store_address','store_phone_number','store_email'];
    
    public function employees(): HasMany{
        return $this->hasMany(Employee::class, 'emp_store_id');
    }

}
