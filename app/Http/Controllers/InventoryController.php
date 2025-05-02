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
use App\Inventory;
use App\User;
use App\ActivityLog;

class InventoryController extends Controller
{
    public function list(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $inventories = Inventory::with('category')->get();

        $data = array(
            'permissions' => $permissions,
            'inventories'   =>   $inventories
        );

        
        return view('inventory.inventory_list')->with('data',$data);
    }

    public function edit(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $inventory = Inventory::where('id','=',$request->id)->with('category')->get();
        $categories = Category::all();

        $data = array(
            'permissions'  => $permissions,
            'inventory'    => $inventory,
            'categories'   => $categories
        );

        
        return view('inventory.inventory_edit')->with('data',$data);
    }

    public function update(Request $request){

        $inventory = Inventory::find($request->inventory_id);
        $inventory->category_id = $request->category_id;
        $inventory->item_name = $request->item_name;
        $inventory->item_description = $request->item_description;
        $inventory->item_price = $request->item_price;
        $inventory->quantity = $request->quantity;
        $inventory->updated_by = Auth::user()->id;
        $inventory->save();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Updated an inventory'
        ]);

        Alert::success('', 'Inventory Updated!');
        return redirect()->route('get-inventory-list');
    }

    public function delete(Request $request){
        $inventory = Inventory::find($request->id);

        $inventory->delete();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Deleted an inventory'
        ]);

        Alert::success('', 'Inventory Deleted!');
        return redirect()->route('get-inventory-list');
    }

    public function create(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $inventories = Inventory::with('category')->get();
        $categories  = Category::all();

        $data = array(
            'permissions' => $permissions,
            'inventories' => $inventories,
            'categories'  => $categories,
        );

        
        return view('inventory.inventory_add')->with('data',$data);
    }

    public function save(Request $request){
        $new = Inventory::create([
            'category_id'        => $request->category_id,
            'item_name'          => $request->item_name,
            'item_description'   => $request->item_description,
            'item_price'         => $request->item_price,
            'arrival_date'       => $request->arrival_date,
            'expiration_date'    => $request->expiration_date,
            'add_stock'          => 0,
            'pull_out_stock'     => 0,
            'updated_by'         => Auth::user()->id,
            'quantity'           => $request->quantity,
        ]);

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Created an inventory'
        ]);

        Alert::success('', 'Inventory Saved!');
        return redirect()->route('get-inventory-list');
    }

    public function addStock(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $inventory = Inventory::where('id', $request->id)->with('category')->get();

        $data = array(
            'permissions' => $permissions,
            'inventory' => $inventory,
        );

        
        return view('inventory.addStock')->with('data',$data);
    }

    public function pullOut(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $inventory = Inventory::where('id', $request->id)->with('category')->get();

        $data = array(
            'permissions' => $permissions,
            'inventory' => $inventory,
        );

        
        return view('inventory.pullOut')->with('data',$data);
    }

    public function saveAddStock(Request $request){
        $inventory = Inventory::where('id',$request->inventory_id)->get();
        $inventory[0]->quantity = $inventory[0]->quantity + $request->quantity;
        $inventory[0]->updated_by = Auth::user()->id;
        $inventory[0]->add_stock = $inventory[0]->add_stock + $request->quantity;
        $inventory[0]->save();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Add Stock'
        ]);

        Alert::success('', 'Added '. $request->quantity .' items to ' . $inventory[0]->item_name . '!');
        return redirect()->route('get-inventory-list');
    }

    public function savePullOut(Request $request){
        $inventory = Inventory::where('id',$request->inventory_id)->get();
        $inventory[0]->quantity = $inventory[0]->quantity - $request->quantity;
        $inventory[0]->updated_by = Auth::user()->id;
        $inventory[0]->pull_out_stock = $inventory[0]->pull_out_stock + $request->quantity;
        $inventory[0]->save();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Pull-out stock'
        ]);

        Alert::success('', 'Pulled out '. $request->quantity .' items from ' . $inventory[0]->item_name . '!');
        return redirect()->route('get-inventory-list');
    }
}
