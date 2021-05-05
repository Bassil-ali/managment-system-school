<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $guarded=[];

    public function specializations()
    {
        return $this->belongsTo('App\Models\Specialication', 'Specialication_id');
    }

    public function genders()
    {
        return $this->belongsTo('App\Models\Gender', 'Gender_id');
    }


}