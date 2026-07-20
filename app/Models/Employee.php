<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    //
    //
    use HasFactory;

    public $fillable = [
        'employee_number', 'last_name', 'middle_name', 'first_name', 'gender', 'birth_date', 'status', 'position', 'grade', 'department', 'phone', 'email', 'address', 'hire_date', 'retirement_date',
    ];

    public function folder(): HasOne
    {
        return $this->hasOne(Folder::class);
    }
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
