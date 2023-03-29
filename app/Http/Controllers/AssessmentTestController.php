<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Form_Data;
use Illuminate\Support\Facades\DB;

class AssessmentTestController extends Controller
{
    public function index()
    {
        $datalist = Form_Data::all();
        $showdata['datalists'] = $datalist;
        return view('Assessment_Test', $showdata);

    }

    public function save_data(Request $request)
    {
//        dd($request->all());

        $request->validate([
            'name' => 'required|max:255 |min:4|regex:/^[a-zA-Z ]+$/',
            'email' => 'required|email',
            'image' => 'required |mimes:jpeg,png,jpg,gif',
            'gender' => 'required',
            'skill' => 'required',
        ]);
        $name = $request->name;
        $email = $request->email;
        $image = $request->image;
        $gender = $request->gender;
        $skill = $request->skill;



        $data = new Form_Data();
        $data->Name = $name;
        $data->Email = $email;
        $data->Gender = $gender;
        $data->Skills = json_encode($skill);

        if ($image) {
            $file = $image;
            $filename = $file->getClientOriginalName();
            $file->move(public_path('/image'), $filename);
            $data['Image'] = $filename;
        }
        $data->save();
        return redirect()->back()->with('success', 'Data Insert Successfully');

    }

    public function edit($id)
    {
        $data = Form_Data::where('id', '=', $id)->first();

        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }


    public function delete_data($id)
    {


        Form_Data::find($id)->delete();
        return redirect()->back()->with('success', 'Delete Successfully');
    }

    public function edit_data(Request $request)
    {
        $request->validate([
            'editname' => 'required|max:255 |min:4|regex:/^[a-zA-Z ]+$/',
            'editemail' => 'required|email',
            'editimage' => 'required |mimes:jpeg,png,jpg,gif',
            'editgender' => 'required',
            'editskill' => 'required',
        ]);

        DB::table('form__data')->where('id', $request->id)->update(array(
            'Name' => $request->editname,
            'Email' => $request->editemail,
            'Image' => $request->editimage,
            'Gender' => $request->editgender,
            'Skills' => $request->editskill,
        ));
        if ($request->editimage) {
            $file = $request->editimage;
            $filename = $file->getClientOriginalName();
            $file->move(public_path('/image'), $filename);
        }
        return redirect()->back()->with('success', 'Edit successfully');
    }
}
