<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'name',
        'email',
        'birth_date',
        'gender',
        'address',
        'division',
        'level',
        'position',
        'salary',
        'photo_id'
    ];

    public function employee_photos()
    {
        return $this->hasMany(EmployeePhoto::class, 'employee_id', 'employee_id');
    }
}
