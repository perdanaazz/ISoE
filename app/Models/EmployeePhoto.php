<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'rand',
        'image_name',
        'employee_id',
        'path',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
