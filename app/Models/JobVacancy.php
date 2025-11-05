<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class JobVacancy extends Model
{
    protected $table = 'job_vacancies';
    protected $fillable = [
        'title',
        'description',
        'location',
        'company',
        'logo',
        'salary',
    ];
}
