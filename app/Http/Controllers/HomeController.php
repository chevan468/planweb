<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Price_Per;
use App\Province;
use App\District;
use App\Service;

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
        $service = DB::table('services')
             ->select('services.id', 'services.name', 'services.description','services.price','users.name as auth',
             'users.lastName as lastName', 'categories.name as category', 'price_pers.name as pricePer', 'provinces.name as province')
             ->join('users', 'services.user_id', '=', 'users.id')
             ->join('categories', 'services.category_id', '=', 'categories.id')
             ->join('price_pers', 'services.pricePer_id', '=', 'price_pers.id')
             ->join('provinces', 'services.province_id', '=', 'provinces.id')
             ->get();
        return view('home')->with('services',$service)->with('provinces',$provinces)->with('districts',$districts);
    }
    
    public function showServicesByProvinceDistrict(Request $request,$id){
        if($request->ajax()){

            $categories = Category::lists('name','id')->prepend('Seleccione una categoría');
            $price_pers = Price_Per::lists('name','id')->prepend('Seleccione un tipo de precio');
            $provinces=DB::table('provinces')->get();
            $districts=DB::table('districts')->where('province_id',1)->get();
            $service = DB::table('services')
             ->select('services.id', 'services.name', 'services.description','services.price','users.name as auth',
             'users.lastName as lastName', 'categories.name as category', 'price_pers.name as pricePer', 'provinces.name as province')
             ->join('users', 'services.user_id', '=', 'users.id')
             ->join('categories', 'services.category_id', '=', 'categories.id')
             ->join('price_pers', 'services.pricePer_id', '=', 'price_pers.id')
             ->join('addresses', 'services.address_id', '=', 'addresses.id')
             ->join('provinces', 'addresses.province_id', '=', 'provinces.id')
             ->where(['addresses.province_id',$request['province']],['addresses.district_id',$request['district']])
             ->get();
        return view('home')->with('services',$service)->with('provinces',$provinces)->with('districts',$districts);
        

        }else{
     return response()->json([
                "ErrorS" => "No existe la pagina solicitada"
                ]);}
    }
}
