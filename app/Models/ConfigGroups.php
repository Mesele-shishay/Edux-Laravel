<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigGroups extends Model
{
    use HasFactory;

    protected $table = 'config_groups';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description'
    ];

    public function config()
    {
        return $this->hasMany('\App\Models\Config', 'group_name', 'name');
    }
}
