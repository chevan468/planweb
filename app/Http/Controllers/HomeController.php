<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Mark;
use App\Category;
use App\Price_Per;
use App\Province;
use App\District;
use App\Service;
use Auth;
use Hash;
use Validator;
use Response;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::lists('name','id')->prepend('Seleccione una categoría');
        $price_pers = Price_Per::lists('name','id')->prepend('Seleccione un tipo de precio');
        $provinces=DB::table('provinces')->get();
        $districts=DB::table('districts')->where('province_id',1)->get();
        // $service = DB::select("SELECT S.`id` , S.`name` , S.`description` , U.`name` as auth, U.`lastName` as lastName,  C.`name` as category
        //   FROM `services` AS S
        //   INNER JOIN `users` AS U ON U.`id` = S.`user_id`
        //   INNER JOIN `categories` AS C ON C.`id` = S.`category_id`"
        //   );
         $service = DB::table('services')
             ->select('services.id', 'services.name', 'services.description','users.name as auth', 'users.lastName as lastName', 'categories.name as category')
             ->join('users', 'services.user_id', '=', 'users.id')
             ->join('categories', 'services.category_id', '=', 'categories.id')
             ->get();
        return view('home')->with('services',$service)->with('provinces',$provinces)->with('districts',$districts);
    }
}
