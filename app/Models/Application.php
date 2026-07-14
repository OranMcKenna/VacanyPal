<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacancy_id',
        'name',
        'email',
        'mobile_number',
        'statement',
        'cv',
    ];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
