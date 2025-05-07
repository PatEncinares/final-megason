<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Category;
use App\User;
use App\ActivityLog;

class CategoryController extends Controller
{
    public function list(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $categories = Category::with('items')->get();

        $data = array(
            'permissions' => $permissions,
            'categories'   =>   $categories
        );

        
        return view('inventory.category_list')->with('data',$data);
    }

    public function edit(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $category = Category::where('id','=',$request->id)->with('items')->get();

        $data = array(
            'permissions' => $permissions,
            'category'    => $category
        );

        
        
        return view('inventory.category_edit')->with('data',$data);
    }

    public function update(Request $request){
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description'   => 'nullable|string'
        ]);

        $category = Category::find($request->category_id);

        $category->name = $request->category_name;
        $category->description = $request->description;
        $category->save();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Updated a Category from inventory'
        ]);

        Alert::success('', 'Category Updated!');
        return redirect()->route('get-category-list');
    }

    public function delete(Request $request){
        $category = Category::find($request->id);

        $category->delete();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Deleted a Category from inventory'
        ]);

        Alert::success('', 'Category Deleted!');
        return redirect()->route('get-category-list');
    }

    public function create(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $categories = Category::with('items')->get();

        $data = array(
            'permissions' => $permissions,
        );

        
        return view('inventory.category_add')->with('data',$data);
    }

    public function save(Request $request){
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description'   => 'nullable|string'
        ]);
         Category::create([
            'name'          => $request->category_name,
            'description'   => $request->description
        ]);

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Created a Category from inventory'
        ]);

        Alert::success('', 'Category Saved!');
        return redirect()->route('get-category-list');
    }
}
