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

class AccountingController extends Controller
{
    public function index(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $now = Carbon::now();

        $transactions = Transaction::whereYear('created_at',$now->year)
                                ->with('patient','doctor','appointment')
                                ->where('status','=','paid')
                                ->get();

        $total = 0;

        foreach($transactions as $transaction){
            $total = $total + $transaction->total_amount;
        }
        $data = array(
            'permissions'    => $permissions,
            'transactions'   => $transactions,
            'total'          => $total
        );

        // dd($transactions);
        return view('accounting.financial_report')->with('data',$data);
    }

    public function dailyEarningsReport(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $now = Carbon::now();

        $transactions = Transaction::whereDay('created_at',$now->day)
                                ->with('patient','doctor','appointment')
                                ->where('status','=','paid')
                                ->get();

        $total = 0;

        foreach($transactions as $transaction){
            $total = $total + $transaction->total_amount;
        }
        $data = array(
            'permissions'    => $permissions,
            'transactions'   => $transactions,
            'total'          => $total
        );

        // dd($transactions);
        return view('accounting.daily_earnings_report')->with('data',$data);
    }
}
