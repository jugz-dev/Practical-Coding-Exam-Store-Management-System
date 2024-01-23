<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'emp_id';
    protected $fillable = ['first_name','middle_name','last_name','suffix','position','emp_phone_number','emp_email','emp_store_id'];

    public function store(): BelongsTo{
        return $this->belongsTo(Store::class, 'emp_store_id');
    }

    public static function checkEmployeeExists(array $data){
        if($data['indicator'] == 0){
            //query for create
            $employee = Employee::where('first_name',  $data['first_name'])->where('middle_name',  $data['middle_name'])->where('last_name', $data['last_name'] )->where('suffix', $data['suffix'])->exists();
        }else if($data['indicator'] == 1){
            //query for edit/update
            $employee = Employee::where('first_name',  $data['first_name'])->where('middle_name',  $data['middle_name'])->where('last_name', $data['last_name'] )->where('suffix', $data['suffix'])->whereNot('emp_id', $data['emp_id']) ->exists();
        }

        if($employee){
            return true;
        }else{
            return false;
        
        }
    }


}
