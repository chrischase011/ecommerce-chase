<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Products;
use App\Models\Ratings;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Notifications;
use Illuminate\Support\Facades\DB;
use Auth;
use Hash;
class Pages extends Controller
{
    //Pages Controller

    public function roots()
    {
    	$title = "Welcome to Web Apparel";
        $features = Products::where(['featured' => '1'])->get();
        $relatedProducts = Products::all()->random(15); 
        $notifications = "";
        if(Auth::check()){

             $notifications = Notifications::where(['user_id' => Auth::user()->id, 'read_at' => 0])->get();
        }
    	return view('pages.index', ['features' => $features,'relatedProducts' => $relatedProducts, 'notifications' => $notifications])->with("title", $title);
    }
    //Sign in Sign up
    public function signinSignup()
    {
    	$title = "Sign in/Sign up - Web Apparel";
    	return view('pages.login')->with("title", $title);
    }
    public function signIn(Request $request)
    {
    	$request->validate([
    		'username' => 'required|string',
    		'password' => 'required|string|min:8',
    	]);
    	$credentials = $request->only('username', 'password');
    	$users = new Users();
    	if(Auth::attempt($credentials))
    	{
    		if(Auth::user()->usercontrol == 2)
    		{
    			return redirect()->intended('/');
    		}
    		else if(Auth::user()->usercontrol == 1)
    		{
    			return redirect()->intended('/admin/dashboard');
    		}
    	}
    	return redirect('/signin-signup')->with('error', 'Incorrect Username/Password');
    }
    public function signUp(Request $request)
    {
    	$request->validate([
    		'username' => 'required|unique:users',
    		'regPassword' => 'required|min:8',
    		'email' => 'required|unique:users',
    		'regFname' => 'required',
    		'regLname' => 'required',
    		'regMI' => 'nullable',
    		'regAddress' => 'required',
    		'regGender' => 'required',
    		'regBday' => 'required',
    		'regPhoto' => 'required|max:80',
    	]);
    	$photo = $request->file('regPhoto');
        $data = file_get_contents($photo);
        $base64 = base64_encode($data);
        Users::create([
        	'username' => $request->username,
        	'password' => Hash::make($request->regPassword),
        	'email' => $request->email,
        	'fname' => $request->regFname,
        	'lname' => $request->regLname,
        	'mi' => $request->regMI,
        	'address' => $request->regAddress,
        	'pic_location' => $base64,
        	'gender' => $request->regGender,
        	'bday' => $request->regBday,
        ]);
        return back()->with('message', 'Success! You can now sign in <b>'.$request->regFname.'.</b>');
    }
    //logout
    public function logout()
    {
    	Auth::logout();

    	return redirect('/');
    }
    //View products
    public function viewProduct($no)
    {

        $products = Products::where(["product_number" => $no])->get();
        $ratings = Ratings::where(['product_number' => $no])->orderBy('id','desc')->get();
        $users = Users::all();
        $starAvg = Ratings::where(['product_number' => $no])->avg('rating');
        $relatedProducts = Products::where('product_number', '!=', $no)->get()->random(10); 
         $notifications = "";
        if(Auth::check()){

             $notifications = Notifications::where(['user_id' => Auth::user()->id, 'read_at' => 0])->get();
        }
        $title = "";
        if(count($products) < 1)
        {
            return redirect('/');
        }
        foreach ($products as $product ) {
            # code...
            $title = $product->product_name." - Web Apparel";
        }
        return view("pages.view",['products' => $products, 'ratings' => $ratings, 'users' => $users,'starAvg' => $starAvg,'relatedProducts' => $relatedProducts, 'notifications' => $notifications])->with('title', $title);
    }
    public function ratings(Request $request)
    {
        $request->validate([
            'rateStar' => 'required',
        ]);
        Ratings::create([
            'user_id' => $request->userID,
            'product_number' => $request->pNumber,
            'rating' => $request->rateStar,
            'review' => $request->reviewS,
        ]);
        return back();
    }
    //Cart
    public function cart()
    {
        $users = Users::where(['id' => Auth::user()->id])->get();
        $products = Products::all();
        $carts = Cart::where(['user_id' => Auth::user()->id])->orderBy('id','desc')->paginate(10);
        $title = Auth::user()->fname." ".Auth::user()->lname."'s Cart - Web Apparel";
        $notifications = Notifications::where(['id' => Auth::user()->id, 'read_at' => 0])->get();
        return view("pages.cart",['users' => $users, 'products' => $products, 'carts' => $carts, 'notifications' => $notifications])->with('title', $title);
    }
    public function addToCart(Request $request)
    {
        if(!is_numeric($request->quan))
        {
            return back()->with('errorCart1', "A non-numberic value occurred");
        }
        if($request->quan == 0 || $request->quan == "")
        {
            return back()->with('errorCart2', 'Error on add to cart: Make sure you input proper value.');
        }
        Cart::create([
            'product_number' => $request->pNo,
            'user_id' => Auth::user()->id,
            'quantity' => $request->quan,
            'orig_price' => $request->origPrice,
            'subtotal' => $request->subtotal,
        ]);

        return back()->with('addCart', 'Successfully added to cart');
    }
    public function removeItem(Request $request)
    {
        $cart = Cart::find($request->id);
        if($cart->delete())
        {
            return 1;
        }
        return 2;
    }
    //Checkout
    public function proceedCheckout(Request $request)
    {
      
        if($request->cartID == "")
        {
            return back()->with('checkoutError', "Please add some items to the cart");
        }
        if($request->pm == "cc")
        {
            $request->validate([
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required',
                'address' => 'required',
                'city' => 'required',
                'country' => 'required',
                'contact' => 'required|max:11|min:11',
                'cardNoc' => 'required',
                'cardNumber' => 'required',
                'cardAddress' => 'required',
                'cardNumber' => 'required',
                'cardExpiry' => 'required',
                'cardCVC' => 'required',
            ]);
            $a = explode(",", $request->cartID);
            $q = 0;
                for($i = 0; $i < count($a); $i++)
            {
                if($cart = Cart::find($a[$i])){

                     $cart->isCheckout = "1";
                    $cart->save();
                    $products = Products::where(['product_number' => $cart->product_number])->get();
                    foreach ($products as $product) {
                        # code...
                        $q = $product->quantity;
                        $b = $q - $cart->quantity;
                        $product->quantity = $b;
                        $product->save();
                    }
                    
                }
                else{
                    break;
                }
               
            } 
            Checkout::create([
                'tracking_number' => $request->tracking,
                'user_id' => Auth::user()->id,
                'name' => $request->fname." ".$request->lname,
                'cart_id' => $request->cartID,
                'contact' => $request->contact,
                'tax' => $request->tax,
                'subtotal' => $request->subtotal,
                'grand_total' => $request->grandTotal,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'payment_method' => $request->pm,
                'noc' => $request->cardNoc,
                'ccaddress' => $request->cardAddress,
                'ccnumber' => $request->cardNumber,
                'expiry' => $request->cardExpiry,
                'cvc' => $request->cardCVC,
            ]);

            return back()->with('checkoutSuccess', 'Checkout success');
        }
        else if($request->pm == 'cod')
        {
             $request->validate([
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required',
                'address' => 'required',
                'city' => 'required',
                'country' => 'required',
                'contact' => 'required|max:11|min:11',
                
            ]);
             $a = explode(",", $request->cartID);

            for($i = 0; $i < count($a); $i++)
            {
                
                if($cart = Cart::find($a[$i])){

                     $cart->isCheckout = "1";
                    $cart->save();
                     $products = Products::where(['product_number' => $cart->product_number])->get();
                   foreach ($products as $product) {
                        # code...
                        $q = $product->quantity;
                        $b = $q - $cart->quantity;
                        $product->quantity = $b;
                        $product->save();
                    }
                }
                else{
                    break;
                }
               
            }            
             Checkout::create([
                'tracking_number' => $request->tracking,
                'user_id' => Auth::user()->id,
                'name' => $request->fname." ".$request->lname,
                'cart_id' => $request->cartID,
                'contact' => $request->contact,
                'tax' => $request->tax,
                'subtotal' => $request->subtotal,
                'grand_total' => $request->grandTotal,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'payment_method' => $request->pm,
             ]);

            return back()->with('checkoutSuccess', 'Checkout success');
        }
        return back()->with('checkoutError', "Unexpected error occurred");
    }
    public function checkout()
    {
        $title = "Checkout - Web Apparel";
        $carts = Cart::where(['user_id' => Auth::user()->id])->orderBy('id','desc')->get();
        $products = Products::all();
        $notifications = Notifications::where(['id' => Auth::user()->id, 'read_at' => 0])->get();
        return view('pages.checkout', ['carts' => $carts, 'products' => $products, 'notifications' => $notifications])->with('title', $title);
    }

    //Tracking

    public function tracking($tracking = null)
    {   
        $title = "Tracking Information - Web Apparel";
        
        if($tracking == null){
            $carts = Cart::where(['user_id' => Auth::user()->id])->get();
            $checkouts = Checkout::where(['user_id' => Auth::user()->id])->orderBy('id','desc')->paginate(10);
            $products = Products::all();
        $notifications = Notifications::where(['user_id' => Auth::user()->id, 'read_at' => 0])->get();
            return view('pages.tracking', ['carts' => $carts, 'checkouts' => $checkouts, 'products' => $products, 'notifications' => $notifications])->with('title', $title);
        }
    }

    public function cancelItem(Request $request)
    {
        $request->validate([
            'reason' => 'required',
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
       if($checkout = Checkout::find($request->checkoutID)){
            $checkout->status = "4";
            $checkout->reason = $request->reason;
            $checkout->save();
            return back()->with('cancelSuccess', "You successfully cancelled the item(s)");
       }

    }
    public function shop()
    {
        $title = 'Shop - Web Apparel';
        $products = Products::inRandomOrder()->get();
        $menProducts = Products::where('gender','=','M')->inRandomOrder()->get();
        $womenProducts = Products::where('gender','=','F')->inRandomOrder()->get();
        $otherProducts = Products::where('gender','=','N')->inRandomOrder()->get();
        $notifications = "";
        if(Auth::check()){

             $notifications = Notifications::where(['user_id' => Auth::user()->id, 'read_at' => 0])->get();
        }
         return view('pages.shop', ['products' => $products, 'menProducts' => $menProducts, 'womenProducts' => $womenProducts, 'otherProducts' => $otherProducts, 'notifications' => $notifications])->with('title', $title);
    }
    public function delivered(Request $request)
    {
        if($checkout = Checkout::find($request->id))
        {
            $checkout->status = "2";
            $checkout->save();
            
            return 1;
        }
        return 2;

    }

    //Notif
    public function notification()
    {
        $title = "Notification - Web Apparel";
        $notifications = Notifications::where(['user_id' => Auth::user()->id, 'read_at' => 0])->get();
        $notifs = Notifications::where(['user_id' => Auth::user()->id])->orderBy('id','desc')->paginate(10);
        $markRead = Notifications::where(['user_id' => Auth::user()->id])->update(['read_at' => 1]);

        return view('pages.notification', ['notifications' => $notifications,'notifs' => $notifs])->with('title', $title);
    }
    public function profile()
    {
        $title = Auth::user()->fname." ".Auth::user()->lname."'s Profile - Web Apparel";
        $notifications = Notifications::where(['user_id' => Auth::user()->id, 'read_at' => 0])->get();
           $carts = Cart::where(['user_id' => Auth::user()->id])->get();
            $checkouts = Checkout::where(['user_id' => Auth::user()->id])->orderBy('id','desc')->take(2)->get();
            $products = Products::all();
        return view('pages.profile',['carts' => $carts, 'checkouts' => $checkouts, 'products' => $products,'notifications' => $notifications])->with('title',$title);
    }

    // CHange pass

    public function changePass(Request $request)
    {
        if(Hash::check($request->currentPass,Auth::user()->password))
        {
            Auth::user()->password = Hash::make($request->newPass);
            Auth::user()->save();
            return back()->with('changePassSuccess', 'Password changed successfully');
        }
        else
        {

            return back()->with('changePassError', 'Incorrect Password');
        }
    }
    public function changeInfo(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'regFname' => 'required',
            'regLname' => 'required',
            'regMI' => 'nullable',
            'regAddress' => 'required',
            'regBday' => 'required',
            'regPhoto' => 'max:80',
       ]);

        if(Hash::check($request->confirmPassword,Auth::user()->password))
        {
            
            if($request->hasFile('regPhoto'))
            {
                Auth::user()->username = $request->username;
                Auth::user()->email = $request->email;
                Auth::user()->fname = $request->regFname;
                Auth::user()->lname = $request->regLname;
                Auth::user()->mi = $request->regMI;
                Auth::user()->address = $request->regAddress;
                Auth::user()->bday = $request->regBday;
                $photo = $request->file('regPhoto');
                $data = file_get_contents($photo);
                $base64 = base64_encode($data);
                Auth::user()->pic_location = $base64;
                Auth::user()->save();
                return back()->with('changeInfoSuccess', 'Account updated successfully');
            }
            else
            {
                Auth::user()->username = $request->username;
                Auth::user()->email = $request->email;
                Auth::user()->fname = $request->regFname;
                Auth::user()->lname = $request->regLname;
                Auth::user()->mi = $request->regMI;
                Auth::user()->address = $request->regAddress;
                Auth::user()->bday = $request->regBday;
                Auth::user()->save();
                return back()->with('changeInfoSuccess', 'Account updated successfully');
            }
        }
        else
        {

            return back()->with('changePassError', 'Incorrect Password');
        }
    } 

    public function link($name)
    {
        $notifications = "";
        if(Auth::check()){

             $notifications = Notifications::where(['user_id' => Auth::user()->id, 'read_at' => 0])->get();
        }
        if($name == "Men")
        {
            $title = "Mens Products - Web Apparel";
            $products = Products::where('gender','=','M')->inRandomOrder()->get();
             return view('pages.nav', ['products' => $products, 'notifications' => $notifications])->with(['title' => $title, 'name' => $name]);
        }
        else if($name == "Women")
        {
            $title = "Women Products - Web Apparel";
            $products = Products::where('gender','=','F')->inRandomOrder()->get();
             return view('pages.nav', ['products' => $products, 'notifications' => $notifications])->with(['title' => $title, 'name' => $name]);
        }
        else if($name == "Other")
        {
            $title = "Other Products - Web Apparel";
            $products = Products::where('gender','=','N')->inRandomOrder()->get();
             return view('pages.nav', ['products' => $products, 'notifications' => $notifications])->with(['title' => $title, 'name' => $name]);
        }
        else
        {
            return redirect('/');
        }
       
    }
}
