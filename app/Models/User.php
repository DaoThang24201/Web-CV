<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password'
    ];

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getRoleName() {
        return UserRoleEnum::getKeys($this->role)[0];
    }

    public function getGenderName() {
        return ($this->gender == 0) ? 'Male' : 'Female';
    }

}
