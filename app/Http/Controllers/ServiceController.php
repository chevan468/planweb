<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\MarkCreateRequest;
use App\Http\Requests\MarkUpdateRequest;
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
        $service = Service::
         select('id','name','description','price')->where('user_id',(Auth::id()))->get();;
        return View('/service/listall')->with('services',$service);

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


    public function store( Request $request)
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
         	  ]);
         $address = DB::table('addresses')
         ->insert([
            'user_id'=> (Auth::id()),
            'service_id'=> ($service),
            'province_id'=> ($request['province']),
            'district_id'=> ($request['district']),
            'fullAddress'=> ($request['fullAddress']),
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


    public function update(MarkUpdateRequest $request, $id)
    {
       
        if ($request->ajax())
        {
            $mark = mark::FindOrFail($id);
            $input = $request->all();
            $result = $mark->fill($input)->save();
            
            if ($result){
                return response()->json(['success'=>'true']);
            } 
            else
            {
              return response()->json(['success'=>'false']);  
            }
        }   
 
        
    }


    public function destroy($id)
    {

        $address = Address::FindOrFail($id);
        $address=DB::table('addresses')->where('service_id',$id)->get();
        $result = $address->delete();
        
        $service = Service::FindOrFail($id);
        $id_service = $service->id;
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
}
