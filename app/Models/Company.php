<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'logo', 'website'
    ];

    protected $appends = ['employees_num'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function getEmployeesNumAttribute()
    {
        return $this->employees->count();
    }
}
