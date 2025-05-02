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
use App\Inventory;
use App\Procedure;
use App\Category;
use App\Appointment;
use App\User;
use App\ProcedureTransaction;
use App\ActivityLog;

class TransactionsController extends Controller
{
    public function list(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $transactions = Transaction::with('procedures','patient','doctor','appointment')->get();

        $data = array(
            'permissions' => $permissions,
            'transactions'   =>   $transactions
        );

        
        return view('transactions.list')->with('data',$data);
    }

    public function create(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }
        $procedures = Procedure::all();
        $patients   = User::where('type','=',3)->with('patientDetails')->get();
        $doctors    = User::where('type','=',2)->with('doctorDetails')->get();
        $appointments   = Appointment::with('patient','patient.patientDetails')->get();

        $data = array(
            'permissions' => $permissions,
            'procedures'  => $procedures,
            'patients'    => $patients,
            'doctors'     => $doctors,
            'appointments'=> $appointments
        );

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Created a transaction'
        ]);

        
        return view('transactions.create')->with('data',$data);
    }

    public function edit(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }
        $procedures     = Procedure::all();
        $transaction    = Transaction::where('id','=',$request->id)->get();
        $patients       = User::where('type','=',3)->with('patientDetails')->get();
        $doctors        = User::where('type','=',2)->with('doctorDetails')->get();
        $appointments   = Appointment::with('patient','patient.patientDetails')->get();

        $data = array(
            'permissions' => $permissions,
            'procedures'  => $procedures,
            'patients'    => $patients,
            'doctors'     => $doctors,
            'appointments'=> $appointments,
            'transaction' => $transaction
        );

        
        return view('transactions.edit')->with('data',$data);
    }

    public function update(Request $request){
        $lab_fee = 0;
        foreach($request->procedures as $procedure){
            $lab_fee = $lab_fee + (int)Procedure::find($procedure, ['price'])['price'];
        }

        $total_amount = 0;
        if($request->discount){
            $total_amount    = (int)$request->doctor_fee + (int)$lab_fee;
            $discount =  $request->discount / 100;
            $discount_amount = $total_amount * $discount;
            $total_amount = $total_amount - $discount_amount;
        }else{
            $total_amount    = (int)$request->doctor_fee + (int)$lab_fee;
        }

        $tax_amount = (int)$total_amount * 0.12;
        $total_amount = $total_amount + $tax_amount;

        $transaction = Transaction::where('id','=',$request->transaction_id)->get();
        $transaction[0]->patient_id = $request->patient_id;
        $transaction[0]->doctor_id  = $request->doctor_id;
        $transaction[0]->schedule_id = $request->appointment_id;
        $transaction[0]->doctor_fee = $request->doctor_fee;
        $transaction[0]->lab_fee    = $lab_fee;
        $transaction[0]->total_amount = $total_amount;
        $transaction[0]->discount = $request->discount;
        $transaction[0]->status    = $request->status;
        $transaction[0]->save();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Updated a transaction'
        ]);

        Alert::success('', 'Transaction updated!');
        return redirect()->route('get-transactions-list');
    }

    public function delete(Request $request){
        $transaction = $transaction = Transaction::where('id','=',$request->id)->get();
        $transaction[0]->delete();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Deleted a transaction'
        ]);

        Alert::success('', 'Transaction deleted!');
        return redirect()->route('get-transactions-list');
    }

    public function markAsPaid (Request $request){
        $transaction = Transaction::where('id','=',$request->id)->get();
        // dd($transaction[0]->status);
        $transaction[0]->status = 'paid';
        $transaction[0]->save();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Marked a transaction as paid'
        ]);

        Alert::success('', 'Transaction marked as paid!');
        return redirect()->route('get-transactions-list');
    }

    public function saveTransaction(Request $request){

        // getting prices 

        $lab_fee = 0;
        foreach($request->procedures as $procedure){
            $lab_fee = $lab_fee + (int)Procedure::find($procedure, ['price'])['price'];
        }
        
        $total_amount = 0;
        if($request->discount){
            $total_amount    = (int)$request->doctor_fee + (int)$lab_fee;
            $discount =  $request->discount / 100;
            $discount_amount = $total_amount * $discount;
            $total_amount = $total_amount - $discount_amount;
        }else{
            $total_amount    = (int)$request->doctor_fee + (int)$lab_fee;
        }

        $tax_amount = (int)$total_amount * 0.12;
        $total_amount = $total_amount + $tax_amount;

        $transaction = Transaction::create([
            'patient_id'    => $request->patient_id,
            'doctor_id'     => $request->doctor_id,
            'schedule_id'   => $request->appointment_id,
            'doctor_fee'    => $request->doctor_fee,
            'lab_fee'       => $lab_fee,
            'total_amount'  => $total_amount,
            'discount'      => $request->discount,
            'status'        => 'unpaid'
        ]);

        foreach($request->procedures as $procedure){
            $procedure_transaction = ProcedureTransaction::create([
                'transaction_id' => $transaction->id,
                'procedure_id' => $procedure
            ]);
        }

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Created a transaction'
        ]);

        Alert::success('', 'Transaction Created!');
        return redirect()->route('get-transactions-list');
    }

    public function view(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }
        
        $transaction    = Transaction::where('id','=',$request->id)->with('procedures','patient','patient.patientDetails','doctor','appointment')->get();

        $subtotal = 0;
        $discount = 0;
        $discount_amount = 0;

        foreach($transaction[0]['procedures'] as $procedure){
            $subtotal = $subtotal + (int)$procedure['price'];
        }

        if($transaction[0]['discount'] != '' && $transaction[0]['discount'] != 0){
            $subtotal    = (int)$transaction[0]['doctor_fee'] + (int)$subtotal;
            $discount =  $transaction[0]['discount'] / 100;
            $discount_amount = $subtotal * $discount;
            $subtotal = $subtotal - $discount_amount;
        }else{
            $subtotal    = (int)$transaction[0]['doctor_fee'] + (int)$subtotal;
        }

        $tax_amount = (int)$subtotal * 0.12;
        $subtotal = $subtotal + $tax_amount;

        $data = array(
            'permissions' => $permissions,
            'transaction' => $transaction,
            'subtotal'    => $subtotal,
            'discount_amount' => $discount_amount,
            'tax_amount' => $tax_amount,
            'discount' => $discount
        );

        
        // dd($data);
        return view('transactions.view')->with('data',$data);
    }

}
