<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigTypes extends Model
{
    use HasFactory;

    protected $table = 'config_types';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    public function config()
    {
        return $this->hasMany('\App\Models\Config', 'type_name', 'name');
    }
}
