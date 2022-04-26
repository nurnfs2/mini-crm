<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeMaster;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.employees');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public static function read()
    {
        //
        $data = DB::select("SELECT em.id, em.first_name, em.last_name,
                            cm.name AS company_name, em.email, em.phone, em.status
                            FROM employee_masters AS em
                            LEFT JOIN company_masters AS cm
                            ON em.company_id = cm.id");
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {

            $validator = Validator::make($request->all(),[
                'first_name'=>'required'
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(),202);
            }

            $input = $request->all();
            EmployeeMaster::create($input);

            return response()->json(['success' => 'Data Added successfully.']);

          } catch (\Exception $e) {
          //  DB::rollBack();
                return response()->json(['error' => $e->getMessage()]);
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $data = EmployeeMaster::findOrFail($request->id);
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        try {

            $id = $request->Id;
            $data = EmployeeMaster::findOrFail($id);
            $data->first_name    = $request->first_name;
            $data->last_name     = $request->last_name;
            $data->company_id    = $request->company_id;
            $data->email         = $request->email;
            $data->phone         = $request->phone;
            $data->status        = (int)$request->status;
            $data->save();

            return response()->json(['success' => 'Data is successfully updated']);


          } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $data = EmployeeMaster::findOrFail($request->id);
        $data->delete();

        return response()->json(['success' => 'Data successfully deleted...']);
    }
}
