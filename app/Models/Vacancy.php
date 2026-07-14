<?php

namespace App\Models;

use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'reference_number',
        'job_title',
        'vacancy_type',
        'job_description',
        'company_name',
        'industry_id',
        'skills_required',
        'application_open',
        'application_close',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function scopeSearch($query, $value)
    {
        if ($value) {
            return $query
                ->where('reference_number', 'like', "%{$value}%")
                ->orWhere('job_title', 'like', "%{$value}%")
                ->orWhere('vacancy_type', 'like', "%{$value}%")
                ->orWhere('company_name', 'like', "%{$value}%")
                ->orWhereHas('industry', fn($q) =>
                $q->where('name', 'like', "%{$value}%"))
                ->orWhere('application_open', 'like', "%{$value}%")
                ->orWhere('application_close', 'like', "%{$value}%");
        }
        return $query;
    }
}
