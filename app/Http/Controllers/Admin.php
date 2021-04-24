<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Users;
use App\Models\Products;
use App\Models\Checkout;
use App\Models\Cart;
use App\Models\Notifications;
use Auth;
class Admin extends Controller
{
    //Admin Controller
    public function dashboard()
    {
    	$title = "Admin Dashboard - Web Apparel";
    	$visitor = DB::table('visits')->get();
    	$visitorLastMonth = DB::table('visits')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get();
    	$visitorThisMonth = DB::table('visits')->whereMonth('created_at', date('m'))->get();
    	$all = Users::all();
        $totalShipped = Checkout::where(['status' => '1'])->get();
        $totalDelivered = Checkout::where(['status' => '2'])->get();
        $totalCancelled = Checkout::where(['status' => '4'])->get();
        $totalRejected = Checkout::where(['status' => '3'])->get();
    	$newUsersMonth = Users::whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))
                        ->get();
		$usersLastMonth = Users::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get();
        $topCountry = DB::select('select country, city,count(country) as total_country from checkout where status = 2 group by country, city LIMIT 5');
        $monthlySales = Checkout::where(['status' => '2'])->whereMonth('created_at', date('m'))->get();
        $yearlySales = Checkout::where(['status' => '2'])->whereYear('created_at', date('Y'))->get();
        $products = Products::orderBy('quantity','asc')->paginate(5);
        $months = array();
        $sales = array();
        $orders = array();
        $total = 0;
        $order = 0;
        $m = "";
        for($month = 1; $month <= 12; $month++)
        {
            $monthSales= DB::select("select * from checkout where Month(created_at)= ? AND Year(created_at)= ?",[$month, date('Y')]);
            foreach ($monthSales as $monthSale) {
                # code...
                $total = $total + $monthSale->grand_total;
                $order++;

            }
            array_push($sales, $total);
            $m =  date('M', mktime(0, 0, 0, $month, 1));
            array_push($months, $m);
            array_push($orders, $order);
        }

        $months = json_encode($months);
        $sales = json_encode($sales);
        $orders = json_encode($orders);


    	return view('admin.pages.dashboard', ['visitor' => $visitor, 'visitorLastMonth' => $visitorLastMonth, 'visitorThisMonth' => $visitorThisMonth, 'all' => $all,'newUsersMonth' => $newUsersMonth, 'usersLastMonth' => $usersLastMonth, 'monthlySales' => $monthlySales , 'yearlySales' => $yearlySales, 'months' => $months, 'sales' => $sales,'orders' => $orders, 'products' => $products, 'topCountry' => $topCountry, 'totalShipped' => $totalShipped,'totalDelivered' => $totalDelivered,'totalRejected' => $totalRejected,'totalCancelled' => $totalCancelled,])->with('title', $title);
    }
    public function productManagement($id = null)
    {
        $title = "Product Management - Web Apparel";
        $products = Products::paginate(10);
        return view('admin.pages.product',['products' => $products])->with('title',$title);
    }
    public function getProduct(Request $request)
    {
        $id = $request->id;
        $products = Products::where(['id' => $id])->get();
        return json_encode($products);
    }
    public function editProduct(Request $request)
    {
        $request->validate([
            'edPname' => 'required',
            'edPprice' => 'required',
            'edPquan' => 'required',
        ]);
        if($request->hasFile('edPImage'))
        {
            $photo = $request->file('edPImage');
            $destination = 'assets/uploads/products/';
            $product = Products::where(['product_number' => $request->edPnumber])->first();
            $product->product_name = $request->edPname;
            $product->product_price = $request->edPprice;
            $product->category = $request->edPcategory;
            $product->gender = $request->edGender;
            $product->product_desc = $request->edpDesc;
            $product->quantity = $request->edPquan;
            $product->product_imagelink = $destination.$request->edPnumber.$photo->getClientOriginalName();
            $request->file('edPImage')->move(public_path($destination), $request->edPnumber.$photo->getClientOriginalName());
            $product->save();
            return back()->with('editSuccess','Successfully Updated');
        }
        else
        {
            $product = Products::where(['product_number' => $request->edPnumber])->first();
            $product->product_name = $request->edPname;
            $product->product_price = $request->edPprice;
            $product->category = $request->edPcategory;
            $product->gender = $request->edGender;
            $product->product_desc = $request->edpDesc;
            $product->quantity = $request->edPquan;
            $product->save();
            return back()->with('editSuccess','Successfully Updated');
        }
        return back()->with('error', 'Did not update');
    }
    public function addProduct(Request $request)
    {
        $destination = 'assets/uploads/products/';
        $request->validate([
            'pName' => 'required',
            'pPrice' => 'required',
            'pCategory' => 'required',
            'pQuan' => 'required',
            'pGender' => 'required',
        ]);
        $photo = $request->file('pImage');

        Products::create([
            'product_number' => $request->pNo,
            'product_name' => $request->pName,
            'product_price' => $request->pPrice,
            'product_imagelink' => $destination.$request->pNo.$photo->getClientOriginalName(),
            'category' => $request->pCategory,
            'product_desc' => $request->pDesc,
            'quantity' => $request->pQuan,
            'gender' => $request->pGender
        ]);
        $request->file('pImage')->move(public_path($destination), $request->pNo.$photo->getClientOriginalName());
        return redirect()->back()->with('message',"New Product Added");
    }
     public function checkPNumber(Request $request)
    {
        $n = $request->n;
        $check = Products::where(['product_number' => $n])->get();
        if(count($check) > 0)
        {
            return 1;
        }
        return 2;
    }
    public function deleteProduct(Request $request)
    {
        $id = $request->id;
        $product = Products::find($id);
        if($product->delete())
        {
            return 1;
        }
        return 2;
    }
    public function userManagement()
    {
        $title = "User Management - Web Apparel";
        $users = Users::where("id","!=", Auth::user()->id)->paginate(10);
        return view('admin.pages.users',['users' => $users])->with('title', $title);
    }

    public function salesManagement()
    {
        $title = "Sales Management - Web Apparel";
        $checkouts = Checkout::orderBy('id','desc')->paginate(7);
        $carts = Cart::all();
        $products = Products::all();
        return view('admin.pages.sales', ['checkouts' => $checkouts, 'carts' => $carts, 'products' => $products])->with('title', $title);
    }
    public function shipItem(Request $request)
    {
        $request->validate([
            'courier' => 'required',
            'delivery' => 'required',
            'shipFee' => 'required',
        ]);
        $data = "<a href='/webapparel/public/tracking'>The item will be shipped to your address by <b>".$request->courier."</b>. on <b>".$request->delivery."</b></a>";
        Notifications::create([
            'user_id' => $request->userID,
            'data' => $data,
        ]);
        if($checkout = Checkout::find($request->checkoutID))
        {
            $checkout->courier = $request->courier;
            $checkout->delivery = $request->delivery;
            $checkout->shipping_fee = $request->shipFee;
            $checkout->status = "1";
            $checkout->save();
            return back()->with('shipSuccess', 'You successfully shipped the item');
        }
        return back()->with('shipError', 'Unexpected Error Occurred');
        
    }
    public function rejectItem(Request $request)
    {
        $request->validate([
            'reason' => 'required',
        ]); 
         $data = "<a href='/webapparel/public/tracking'>The item was cancelled by the admin. You can view reason on Tracking Information page.</b></a>";
        Notifications::create([
            'user_id' => $request->userID,
            'data' => $data,
        ]);
        $cartIDs = explode(",", $request->cartID);
        $a = "";
        for ($i=0; $i < count($cartIDs); $i++) { 
            # code...
           
            if($cart = Cart::find($cartIDs[$i]))
            {
                $products = Products::where(['product_number'=> $cart->product_number])->get();
                
                foreach ($products as $product) {
                    # code...
                    if($product)
                    $a = $product->quantity + $cart->quantity;
                    $product->quantity = $a;
                    $product->save();
                }
            }
            else
            {
                break;
            }
            
            
           
        }
       if($checkout = Checkout::find($request->RcheckoutID)){
            $checkout->status = "3";
            $checkout->reason = $request->reason;
            $checkout->save();
            return back()->with('rejectSuccess', "You successfully rejected the item");
       }
        return back()->with('rejectError', "Unexpected error occurred");

    }

    //Charts 

    public function getMonthly()
    {
         $monthlySales = Checkout::where(['status' => '2'])->where('created_at','<=', date('m'))->get(['created_at','grand_total']);
              
       $months= "";
       $label = '';
       $total = 0;
       foreach ($monthlySales as $monthlySale) {
           # code...
        $month = date('m', strtotime($monthlySale->created_at));
       $months = $month.',';
       }
       $months = trim($months, ',');
       $data = array('months' => $months, 'total' => $total);
       return $data;
    }

    public function setAdmin(Request $request)
    {
        if($users = Users::find($request->id))
        {
            $users->usercontrol = "1";
            $users->save();
            return 1;
        }
        return 2;
    }
    public function delUser(Request $request)
    {
        if($users = Users::find($request->id))
        {
            if($users->delete())
            {
                return 1;
            }
            else
            {
                return 2;
            }
        }
        return 2;
    }
}
