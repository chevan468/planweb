<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

      protected $primarykey = 'id';

      public $timestamps = false;
      

      protected $fillable = [
         'id','name', 'user_id', 'category_id', 'description', 'price','pricePer_id', 'legalNumber','contactNumber','contactEmail'
      ];
}
