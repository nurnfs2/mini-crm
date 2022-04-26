<?php

namespace App\Http\Controllers\Admin;

use App\Mail\ContactMe;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
//use App\Models\CampanyMaster;
use App\Models\CompanyMaster;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.companies');
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
        $data = CompanyMaster::get();
        return $data;
    }

    public function getAllCompany() {
        $data = CompanyMaster::get();
        return response()->json($data);
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
                'name'=>'required',
                'email'=>'required|email'
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(),202);
            }

             $request->validate([
                 'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
               ]);


            if ($request->file('file')) {
                $imagePath = $request->file('file');
                $imageName = $imagePath->getClientOriginalName();

                $request->file('file')->move(public_path('/images/companies/'), $imageName);

             //   $path = $request->file('file')->storeAs('uploads/products', $imageName, 'public');

            }else{
                return response()->json(['error' => 'Image Upload Problem.']);
            }

                $input = $request->all();
                $input['logo'] = $imageName;

                Mail::to($input['email'])->send(new ContactMe());

                CompanyMaster::create($input);




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
        $data = CompanyMaster::findOrFail($request->id);
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
        try {

            $id = $request->Id;
            $data = CompanyMaster::findOrFail($id);
            $data->name             = $request->name;
            $data->email         = $request->email;

            if ($request->file('file')) {
                $imagePath = $request->file('file');
                $imageName = $imagePath->getClientOriginalName();

                $request->file('file')->move(public_path('/images/companies/'), $imageName);

                $data->logo         = $imageName;

                unlink(public_path('/images/companies/'.$request->oldimage));

            }

            $data->website       = $request->website;
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
        $data = CompanyMaster::findOrFail($request->id);
        $data->delete();

        unlink(public_path('/images/companies/'.$request->image));

        return response()->json(['success' => 'Data successfully deleted...']);
    }
}
