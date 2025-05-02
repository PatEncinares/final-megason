<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Transaction;
use App\User;
use App\Setting;
use App\ActivityLog;

class SettingsController extends Controller
{
    public function index(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $settings = Setting::find(1);

        $data = array(
            'permissions' => $permissions,
            'settings'   =>   $settings
        );

        
        return view('settings.index')->with('data',$data);
    }

    public function edit(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $settings = Setting::find(1);

        $data = array(
            'permissions' => $permissions,
            'settings'   =>   $settings
        );

        
        return view('settings.edit')->with('data',$data);
    }

    public function save(Request $request){
        $settings = Setting::find(1);
        $settings->am_limit = $request->am_limit;
        $settings->pm_limit = $request->pm_limit;
        $settings->save();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Updated app settings'
        ]);

        Alert::success('', 'Settings Updated!');
        return redirect()->route('get-settings');
    }
}
