<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\DataTables\OrderDataTable;
use Auth;
use DB;

class UserController extends Controller
{
    public function getSignup(){
        return view('user.signup');
    }

    public function signUp(Request $request){
        $this->validate($request, [
            'email' => 'email| required|unique:users',
            'password' => 'required| min:4'
        ]);
        $user = new User([
            'name' => $request->input('fname').' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'admin'
        ]);
         $user->save();
         $customer = new Customer;
         $customer->user_id = $user->id;
         $customer->fname = $request->fname;
         $customer->lname = $request->lname;
         $customer->address = $request->address;
         $customer->phone = $request->phone;
         $customer->save();
         Auth::login($user);
         return redirect()->route('categories.index');
    }
    public function index(ItemsDataTable $dataTable)
    {
        return $dataTable->render('items.index');
    }
    public function getProfile(OrderDataTable $dataTable){
        $customer = Customer::where('user_id',Auth::id())->first();
        // $orders = Order::with('customer','items')->where('customer_id',$customer->customer_id)->get();
        // dd($customer, $orders);
        $orders = DB::table('customer as c')->join('orderinfo as o','o.customer_id', '=', 'c.customer_id')
                    ->join('orderline as ol','o.orderinfo_id', '=', 'ol.orderinfo_id')
                    ->join('item as i','ol.item_id', '=', 'i.item_id')
                    ->where('c.user_id', Auth::id())
                    ->select('o.orderinfo_id', 'o.date_placed',DB::raw("SUM(ol.quantity * i.sell_price) as total"))
                    ->groupBy('o.orderinfo_id', 'o.date_placed');
                    // ->get()->toJson();
                    // foreach ($orders as $order) {
                    //     dump ($order->sell_price);
                    // }
        // return view('user.profile',compact('orders'));
        // dd($orders);
        return $dataTable->render('user.profile');
       
        // return view('user.profile');
    }


    public function getUsers(UsersDataTable $dataTable){
        return $dataTable->render('admin.users');
    }
   

}