<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price_Per extends Model
{
    protected $table = 'price_pers';

      protected $primarykey = 'id';

      public $timestamps = false;
      

      protected $fillable = [
         'id','name'
      ];
}
