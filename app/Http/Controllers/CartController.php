<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\MessageHelper;
use App\Models\Cart;
use App\Models\Cake;
use App\Models\AddressBook;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['cart_items'] = Cart::all();
        $data['count'] = Cart::sum('cake_quentity');
        $data['cartP'] = Cart::sum('cake_price');

        return view('cart/index_cart',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function validateCartRequest(Request $request)
    {
        return \Validator::make($request->all(), [
            'cake_massage' => 'required',
            'location' => 'required',
        ])->errors();
    }
    public function addToCart(Request $request)
    {
        $message = new MessageHelper();
        $msg_data = array();

        if (isset($_GET['id'])) {
            $validationErrors = $this->validateRequest($request);
        } else {
            $validationErrors = $this->validateCartRequest($request);
        }
        if (count($validationErrors)) {
            $message->errorMessage(implode("\n", $validationErrors->all()), $msg_data);
        }
        $cart = Cart::sum('cake_quentity');
        $check = Cart::where('cake_name',$request->cake_name)->where('cake_weight',$request->cake_weight)->first();

        if (!empty($check)) {
            $data = Cart::find($check->id);
            $data->increment('cake_quentity');
            $data->increment('cake_price',$request->cake_price);
        } else {
            $data = new Cart;
            $data->cake_quentity = $request->cake_quentity;
            $data->cake_price = $request->cake_price;
        }
        $data->cake_name = $request->cake_name;
        $data->cake_massage = $request->cake_massage;
        $data->cake_weight = $request->cake_weight;
        $data->img_name = $request->img_name;
        $data->location = $request->location;
        $data->cake_url = $request->cake_url;
        $data->save();

        $request->session()->put('cart',$cart);
        $message->successMessage('Added To Cart', $msg_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {

        $data['cart_items'] = Cart::all();
        $data['cartP'] = Cart::sum('cake_price');

        $value = session('Uid');
        $data['user'] = User::where('id',$value)->first();
        if($data['user']){
            $data['address'] = AddressBook::where('user_id',$data['user']->id)->get();
            return view('cart.checkout',$data);
        }else{
            return view('cart.checkout');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function updateCart( $id,$val,$price)
    {
        $msg_data = array();
        $message = new MessageHelper();

        \Log::info("heu");
        $cart=Cart::find($id);
        $cart->cake_price=$price;
        $cart->cake_quentity=$val;
        $cart->save();
        $message->successMessage('quantity updated', $msg_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function deleteCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return response()->json(['success' => 'cart deleted']);
    }
}
