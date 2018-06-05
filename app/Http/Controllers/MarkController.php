<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\MarkCreateRequest;
use App\Http\Requests\MarkUpdateRequest;
use App\Product;
use App\Mark;
use DB;
use Auth;
use Hash;
use Validator;
use Response;
use Session;

class MarkController extends Controller
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

       return view('mark.index');

    }


    public function listall()
    {
        $mark = Mark::
         select('id','name')
                 ->paginate(5);
        return View('mark/listall')->with('marks',$mark);

    }

    public function create()
    {
        //

        return view('mark.create');

    }


    public function store( MarkCreateRequest $request)
    {
        
        if ($request->ajax())
        {
                $result = Mark::create($request->all());

                if ($result){
                    Session::flash('update','Se ha creado correctamente');
                    return response()->json(['success'=>'true']);
                } 
                else
                {
                  return response()->json(['success'=>'false']);  
                }


        }

    }


    public function show($id)
    {

    }


    public function edit($id)
    {

        $mark = mark::find($id);
        return response()->json($mark);

    }


    public function update(MarkUpdateRequest $request, $id)
    {
       
        if ($request->ajax())
        {
            $mark = mark::FindOrFail($id);
            // $user =User::find(1);
            // $user->name=$request['name'];
            // $user->save();
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


        $mark = Mark::FindOrFail($id);
        $result = $mark->delete();

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
