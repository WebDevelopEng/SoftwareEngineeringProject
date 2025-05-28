<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\donation;
use Illuminate\Support\Facades\Storage;
use App\Models\donationorder;
use Illuminate\Support\Facades\Session;
class DonationController extends Controller
{
    // 
    function createdonation(Request $req){
        $req->validate(
            ['name'=>'required',
            'description'=>'required|max:50',
            'image'=>'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'price'=>'required|numeric',
            'count'=>'required|numeric'
            ]
        );
        $donation=new donation;
        $restaurantid=Session::get('restaurant')->id;
        $donation->name=$req->name;
        $donation->description=$req->description;
        $donation->restaurant_id=$restaurantid;
        $donation->count=$req->count;
        if($req->image!=null){
            $extension=$req->image->getClientOriginalExtension();
            $currenttime=now()->format('YmdHis');
            $stringformat='don'.$currenttime.'.'.$extension;
            $req->image->storeAs('/donationimages',$stringformat,'public');
            $donation->image=$stringformat;
        }
        $donation->price=$req->price;
        $donation->save();
        return redirect(route('donate'));
    }
    function viewalldonations(Request $req){
        if(Session::get('admin')){
        $alldonations=donation::paginate(20);
        return view('alldonations',['donations'=>$alldonations]);
        }
        if(Session::get('restaurant')){
            $alldonations=donation::where('restaurant_id','=',Session::get('restaurant')->id)->paginate(5);
            return view('mydonations',['donations'=>$alldonations]);
        }
        if(Session::get('user')){
            $alldonations=donation::paginate(20);
            return view('makeadonation',['donations'=>$alldonations]);
        }
    }

    function updatedonation(Request $req, $donationid){
        $donation=donation::find($donationid);
        $req->validate(
            ['name'=>'required',
            'description'=>'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'count'=>'required|numeric'
            ]
        );
        $donation->name=$req->name;
        $donation->description=$req->description;
        $donation->count=$req->count;
        if($req->image!=null){
            Storage::disk('public')->delete('donationimages/'.$resto->image);
            $extension=$req->image->getClientOriginalExtension();
            $currenttime=now()->format('YmdHis');
            $stringformat='don'.$currenttime.'.'.$extension;
            $req->image->storeAs('/donationimages',$stringformat,'public');
            $donation->image=$stringformat;
        }
        $donation->save();
        return redirect(route('donate'));
    }
    function deletedonation(Request $req,$donationid){
        $donation=donation::find($donationid);
        if($donation->image != null){
        Storage::disk('public')->delete('donationimages/'.$donation->image);
        }
        $donation->delete();
        return redirect(route('donate'));
    }

    function donate(Request $req,$donationid){
        $donation=donation::find($donationid);
        $req->validate([
            'quantity' => 'required',
            function ($attribute, $value, $failure){
                if ($value > $donation->count){
                    $failure('Insufficient Stock.');
                }
            }
        ]);
        $donationorder=new donationorder;
        $donation->count=$donation->count-$req->quantity;
        $donationorder->cost=$req->quantity * $donation->price;
        $donationorder->donationid=$donationid;
        $donationorder->quantity=$req->quantity;
        $donationorder->userid=Session::get('user')->id;
        $donationorder->save();
        return redirect(route('mydonations'));
    }
    function createdonationview(Request $req){
        return view('createdonationview');
    }
    function viewdonation(Request $req, $donationid){
        $donation=donation::find($donationid);
        return view('viewdonation',['donation'=>$donation]);
    }
    function searchdonations(Request $req){
        $donation=donation::where('name','=',$req->search)->paginate(20);
        return view('makeadonation',['donations'=>$donation]);
    }

    function editdonationview(Request $req,$donationid){
        $donation=donation::find($donationid);
        return view('editdonation',['donation'=>$donation]);
    }

    function editdonation(Request $req,$donationid){
        $donation=donation::find($donationid);
        $req->validate(
            ['name'=>'required',
            'description'=>'required|max:50',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'price'=>'required|numeric',
            'count'=>'required|numeric'
            ]
        );
        if($req->image!=null){
            Storage::disk('public')->delete('donationimages/'.$donation->image);
            $extension=$req->image->getClientOriginalExtension();
            $currenttime=now()->format('YmdHis');
            $stringformat='don'.$currenttime.'.'.$extension;
            $req->image->storeAs('/donationimages',$stringformat,'public');
            $donation->image=$stringformat;
        }
        $donation->price=$req->price;
        $donation->count=$req->count;
        $donation->description=$req->description;
        $donation->name=$req->name;
        $donation->save();
        return redirect(route('donate'));

    }
}
