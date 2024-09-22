<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'zone',
        'woreda',
        'school_name',
        'phone_number',
        'field',
        'id_number',
        'image',
        'admission',
        'status',
        'role',

    ];

    public function section()
    {
        return $this->hasOne('App\Models\Section','user_id','user_id') ;
    }

    public function grade()
    {
        return $this->hasOne('App\Models\Grade','user_id','user_id');
    }

    public function getAdmissionAttribute($value)
    {
        if (!$value) {
            return "Not Updated";
        }
        return $value;
    }

    public function getStatusAttribute($value)
    {
        if (!$value) {
            return "Pending";
        }
        return $value;
    }

    public function getFullNameAttribute($value)
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getImageAttribute($value)
    {
        if (!$value) {
            return  "default.png";
        }
        return $value;
    }

    public function getRoleAttribute($value='')
    {
        return Str::lower($value);
    }

    public function setRoleAttribute($value='')
    {
        $this->attributes['role'] = Str::lower($value);
    }

}
