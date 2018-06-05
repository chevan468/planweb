<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';

      protected $primarykey = 'id';

      public $timestamps = false;
      

      protected $fillable = [
         'id','name'
      ];
}
