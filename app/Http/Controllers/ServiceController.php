<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ServiceCreateRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Product;
use App\Mark;
use App\Address;
use App\Category;
use App\Price_Per;
use App\Province;
use App\District;
use App\Service;
use DB;
use Auth;
use Hash;
use Validator;
use Response;
use Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function  __construct()
    {

    }


    public function index()
    {

       return view('/service.index');

    }


    public function listall()
    {
         $service = DB::table('services')
              ->select('services.id', 'services.name', 'services.description', 'services.price','services.category_id'
              ,'provinces.name as province_id', 'services.fulladdress')
              ->join('provinces', 'services.province_id', '=', 'provinces.id')
              ->where('services.user_id',(Auth::id()))->get();
        // $service = Service::
        //  select('id','name','description','price')->where('user_id',(Auth::id()))->get();
        return View('/service/listall')->with('services',$service);

    }
    
    public function listhome()
    {
         $service = DB::table('services')
             ->select('services.id', 'services.name', 'services.description','services.price','users.name as auth',
             'users.lastName as lastName', 'categories.name as category', 'price_pers.name as pricePer', 'provinces.name as province')
             ->join('users', 'services.user_id', '=', 'users.id')
             ->join('categories', 'services.category_id', '=', 'categories.id')
             ->join('price_pers', 'services.pricePer_id', '=', 'price_pers.id')
             ->join('provinces', 'services.province_id', '=', 'provinces.id')
             ->get();

        return View('/listservice')->with('services',$service);

    }

    public function create()
    {
        $categories = Category::lists('name','id')->prepend('Seleccione una categoría');
        $price_pers = Price_Per::lists('name','id')->prepend('Seleccione un tipo de precio');
        $provinces = Province::lists('name','id');
        $districts = District::lists('name','id');
        return view('/service.create')->with('categories',$categories)->with('price_pers',$price_pers)
        ->with('provinces',$provinces)->with('districts',$districts);

    }


    public function store(ServiceCreateRequest $request)
    {
        
        if ($request->ajax())
        {
            
          $service = DB::table('services')
	           ->insertGetId([
            'name'=>($request['name']),
            'user_id'=> (Auth::id()),
            'category_id'=> ($request['category']),
            'description'=> ($request['description']),
            'price'=> ($request['price']),
            'pricePer_id'=> ($request['pricePer']),
            'legalNumber'=> 0,
            'contactNumber'=> ($request['contactNumber']),
            'contactEmail'=> ($request['contactEmail']),
            'province_id'=> ($request['province']),
                'district_id'=> ($request['district']),
                'fullAddress'=> ($request['fullAddress'])
         	  ]);

            return response()->json(['success'=>'true']);
        }else{
            return response()->json(['success'=>'false']);
        }

    }


    public function show($id)
    {
        $service = Service::FindOrFail($id);
        return response()->json($service);

    }


    public function edit($id)
    {

        $service = Service::FindOrFail($id);
        return response()->json($service);

    }


    public function update(ServiceUpdateRequest $request, $id)
    {
       
        if ($request->ajax())
        {
            $service = Service::findOrFail($id);
            $service->name =($request['name']);
            $service->category_id = ($request['category']);
            $service->description = ($request['description']);
            $service->price = ($request['price']);
            $service->pricePer_id = ($request['pricePer']);
            $service->legalNumber= 0;
            $service->contactNumber = ($request['contactNumber']);
            $service->contactEmail = ($request['contactEmail']);
            
            
            $service->province_id = ($request['province']);
            $service->district_id = ($request['district']);
            $service->fullAddress = ($request['fullAddress']);
            
            $service->save();
            
            return response()->json(['success'=>'true']);
            
            
        } else
            {
              return response()->json(['success'=>'false']);  
            }  
 
        
    }


    public function destroy($id)
    {
        $service = Service::FindOrFail($id);
        $result = $service->delete();

        if ($result)
        {
            return response()->json(['success'=>'true']); 
        }
        else
        {
            return response()->json(['success'=> 'false']);
        }



    }
    
    public function openUserService($id){
        
    $service =  DB::table('services')
             ->select('services.id', 'services.name', 'services.description','services.price','services.fullAddress',
             'services.contactEmail','services.contactNumber','users.name as auth',
             'users.lastName as lastName', 'categories.name as category', 'price_pers.name as pricePer', 'provinces.name as province'
             ,'districts.name as district')
             ->where('services.id','=',$id)
             ->join('users', 'services.user_id', '=', 'users.id')
             ->join('categories', 'services.category_id', '=', 'categories.id')
             ->join('price_pers', 'services.pricePer_id', '=', 'price_pers.id')
             ->join('provinces', 'services.province_id', '=', 'provinces.id')
             ->join('districts', 'services.district_id', '=', 'districts.id')
             ->first();
              
    return view('service.userservice')->with('service',$service);
        
    }
}
