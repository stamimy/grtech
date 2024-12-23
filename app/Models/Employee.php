<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone', 'company_id'
    ];

    protected $appends = ['company_name'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getCompanyNameAttribute()
    {
        // @TODO why use $this->company->name error too much data?????
        return \App\Models\Company::find($this->company_id)->name;
    }
}
