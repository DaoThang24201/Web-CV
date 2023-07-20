<?php

namespace App\Models;

use App\Enums\PostCurentcySalaryEnum;
use App\Enums\PostStatusEnum;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'company_id',
        'job_title',
        'city',
        'status',
    ];

    protected $appends = ['currency_salary_code', 'status_name'];

    protected static function booted()
    {
        static::creating(static function ($object) {
            //->user_id = auth()->id();
            $object->user_id = 1;
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'job_title'
            ]
        ];
    }

    public function getCurrencySalaryCodeAttribute(): array
    {
        return PostCurentcySalaryEnum::getKeys($this->currency_salary);
    }

    public function getStatusNameAttribute(): array
    {
        return PostStatusEnum::getKeys($this->status);
    }
}
