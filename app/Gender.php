<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'genders';

      protected $primarykey = 'id';

      public $timestamps = false;
      

      protected $fillable = [
         'id','name'
      ];
}
