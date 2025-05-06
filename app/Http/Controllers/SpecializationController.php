<?php

namespace App\Http\Controllers;

use App\User;
use App\ActivityLog;
use App\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SpecializationController extends Controller
{
    public function list(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $specialization = Specialization::all();

        $data = array(
            'permissions' => $permissions,
            'specialization'   =>    $specialization
        );

        
        return view('specialization.specialization_list')->with('data',$data);
    }

    public function edit(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $Specialization = Specialization::where('id','=',$request->id)->get();

        $data = array(
            'permissions' => $permissions,
            'specialization'    => $Specialization
        );

        
        
        return view('specialization.specialization_edit')->with('data',$data);
    }

    public function update(Request $request){

        $Specialization = Specialization::find($request->specialization_id);

        $Specialization->name = $request->specialization_name;
        $Specialization->description = $request->description;
        $Specialization->save();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Updated a specialization from inventory'
        ]);

        Alert::success('', 'Specialization Updated!');
        return redirect()->route('get-specialization-list');
    }

    public function delete(Request $request){
        $Specialization = Specialization::find($request->id);

        $Specialization->delete();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Deleted a specialization from inventory'
        ]);

        Alert::success('', 'Specialization Deleted!');
        return redirect()->route('get-specialization-list');
    }

    public function create(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $categories = Specialization::all();

        $data = array(
            'permissions' => $permissions,
        );

        
        return view('specialization.specialization_add')->with('data',$data);
    }

    public function save(Request $request){
        $request->validate([
            'specialization_name' => 'required|string|unique:specializations,name',
            'description' => 'nullable|string|max:255'
        ]);
    
        Specialization::create([
            'name'        => $request->specialization_name,
            'description' => $request->description
        ]);
    
        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Created a specialization from users'
        ]);
    
        Alert::success('', 'Specialization saved!');
        return redirect()->route('get-specialization-list');
    }
}
