<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['section_name','room_no','session_id','class_id'];

    /**
     * Get the user's section.
     *
     * @param  string  $value
     * @return string
     */
    public function getSectionAttribute($value)
    {
        if (!$value) {
            return "Not Updated";
        }
        return strtoupper($value);
    }

    public function schoolClass() {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
