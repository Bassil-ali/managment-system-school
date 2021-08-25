<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{

    use HasTranslations;
    protected $table = 'Grades';
    public $translatable = ['Name'];

    protected $fillable=['Name','Notes'];
   
    public $timestamps = true;


    public function Sections() {
        
        return $this->HasMany('App\Models\Section','Grade_id');
    }

}
