<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\MarkCreateRequest;
use App\Http\Requests\MarkUpdateRequest;
use App\Product;
use App\Gender;
use App\User;
use App\Mark;
use DB;
use Auth;
use Hash;
use Validator;
use Response;
use Session;

class UserController extends Controller
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

       return view('user.index');

    }


    public function listall()
    {
        $genders_id =DB::table('genders')->pluck('name', 'id');
        $users = User::find(Auth::id());
        return View('user/listall',compact('users'))->with('genders_id',$genders_id)->render();

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

        $user = User::find($id);
        return response()->json($user);

    }


    public function update(Request $request, $id)
    {
       
        if ($request->ajax())
        {
            $mark = mark::FindOrFail($id);
            $user =User::find(Auth::id());
            $user->name=$request['name'];
            $user->lastName=$request['lastName'];
            $user->study=$request['study'];
            $user->save();
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
