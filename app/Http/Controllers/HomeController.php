<?php

namespace App\Http\Controllers;

use domain\Facades\UserFacade;
use Inertia\Inertia;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
class HomeController extends Controller
{
    public function index()
    {

        $response['students'] = UserFacade::all();
        return Inertia::render('Home/index', $response);

    }

    public function list()
    {

        $response = UserFacade::all();

        return response()->json($response);

    }

    

    public function add(Request $request)
    {
       
        if ($request->hasFile('image')) {
            
            $c_image = $request->file('image');
            $c_image->store('public/img');

            $data = $request->all();

            $hashName = $c_image->hashName() ;

            $data =[
                'image' => $c_image->storeAs('storage/img', $hashName),
                'name' => $request->name,
                'age' => $request->age,
                'status' => 'active'
            ];

            UserFacade::add($data);
            return redirect()->back();
            

            
        }



    }

    public function update(Request $request)
    {
        

        if ($request->hasFile('image')) {

            $data = $request->all();
            $id = $request->id;

            $c_image = $request->file('image');
            $c_image->store('public/img');

            $hashName = $c_image->hashName() ;

            $data =[
                'image' => $c_image->storeAs('storage/img', $hashName),
                'name' => $request->name,
                'age' => $request->age,
            ];

            UserFacade::update($data, $id);
            return redirect()->back();
            
        }else {

            $data = $request->all();
            $id = $request->id;

            UserFacade::update($data , $id);
        }
            

            

    }


    public function delete($id)
    {

        UserFacade::delete($id);
        return redirect()->back();


    }

    public function status($id)
    {

        UserFacade::status($id);
        return redirect()->back();



    }
}

