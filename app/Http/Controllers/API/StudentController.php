<?php

namespace App\Http\Controllers\API;

use App\Models\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Students::all();
        if($students->count() > 0){
            return response()->json([
                'status' =>  200,
                'students' => $students 
             ], 200);
        } else {
            return response()->json([
                'status' =>  404,
                'message' => "Data Not Found" 
             ], 404);
        }
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:91',
            'nim' => 'required|integer',
            'email' => 'required|email:dns',
            'phone' => 'required|digits:13'
        ]);

        if($validator->fails()){
            return response()->json([
               'status' =>  422,
               'message' => $validator->messages() 
            ], 422);
        }else {
            $student = Students::create([
                'name' => $request->name,
                'nim' => $request->nim,
                'email' => $request->email,
                'phone' => $request->phone
            ]);

            if($student) {
                return response()->json([
                    'status' => 200,
                    'message' => "Data Created Add"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No Record Found"
                ], 404);
            }

           
        };

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Students::find($id);
        if($students){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:91',
                'nim' => 'required|integer',
                'email' => 'required|email:dns',
                'phone' => 'required|digits:13'
            ]);

            return response()->json([
                'status' =>  200,
                'students' => $students 
             ], 200);
        } else {
            return response()->json([
                'status' =>  404,
                'message' => "Data Not Found" 
             ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:91',
            'nim' => 'required|integer',
            'email' => 'required|email:dns',
            'phone' => 'required|digits:13'
        ]);

        if($validator->fails()){
            return response()->json([
               'status' =>  422,
               'message' => $validator->messages() 
            ], 422);
        }else {
            $student = Students::find($id);           

            if($student) {
                $student->update([
                    'name' => $request->name,
                    'nim' => $request->nim,
                    'email' => $request->email,
                    'phone' => $request->phone
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => "Data Created Add"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No Record Found"
                ], 404);
            }

           
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
