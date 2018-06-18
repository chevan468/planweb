<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

      protected $primarykey = 'id';

      public $timestamps = false;
      

      protected $fillable = [
         'id','name','province_id','district_id','fullAddress'
      ];
}
