<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name', 'school_id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->order = Student::select("id","school_id")->where('school_id', $model->school_id)->count() + 1;
        });
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

}
