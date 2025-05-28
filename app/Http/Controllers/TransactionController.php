<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class TransactionController extends Controller
{
    function addtransaction(Request $req, $donationid){
        $req->validate([
            'quantity'=>'required|numeric|min:1'
        ]);
        $transaction=Transaction::where('user_id','=',Session::get('user')->id)->where('status','=','pending')->first();
        if($transaction==null){
            $transaction = new Transaction;
            $transaction->user_id=Session::get('user')->id;
            $transaction->status='pending';
            $transaction->save();
    };  

        $currentdonation=Donation::find($donationid);
        $transactionitem=TransactionItem::where('transaction_id','=',$transaction->id)->where('donation_id','=',$currentdonation->id)->first();
        if($transactionitem==null){
        $transactionitem= new TransactionItem;
        $transactionitem->transaction_id=$transaction->id;
        $transactionitem->donation_id=$currentdonation->id;
        $transactionitem->quantity=$req->quantity;
        $transactionitem->save();
        }
        else{
            $transactionitem->quantity=$transactionitem->quantity+$req->quantity;
            $transactionitem->save();
        }
        return redirect(route('donate'));
    }
    function viewactivetransaction(Request $req){
        $transaction=Transaction::where('user_id','=',Session::get('user')->id)->where('status','=','pending')->first();
        if($transaction!=null){
        $alltransactionitems=$transaction->items;
        $cost=0;
        foreach($alltransactionitems as $item){
            $cost=$cost+$item->donation->price *$item->quantity;
        }
        return view('transactionpage',['transaction'=>$transaction,'totalcost'=>$cost]);
        }
        else{
            return view('transactionpage');
        }
        
    }
    function deletetransactionitem(Request $req){
        $transactionitem=TransactionItem::find($req->transactionitemid);
        $transactionitem->delete();
        return redirect(route('viewtransaction'));
    }
    function edittransactionitem(Request $req){
         $req->validate([
            'quantity'=>'required|numeric'
        ]);
        $transactionitem=TransactionItem::find($req->transactionitemid);
        $transactionitem->quantity=$req->quantity;
        $transactionitem->save();
        return redirect(route('viewtransaction'));
    }
    function confirmtransaction(Request $req){
        $user=User::find(session('user')->id);
        $user->balance=$user->balance-$req->totalcost;
        $user->save();
        $transaction=Transaction::find($req->transactionid);
        $transaction->status="completed";
        $transaction->save();
        session(['user'=>$user]);
        return redirect(route('profile'));
    }

}
