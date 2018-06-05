<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

      protected $primarykey = 'id';

      public $timestamps = false;
      

      protected $fillable = [
         'id','name'
      ];
}
