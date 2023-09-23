<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\MessageHelper;
use App\Models\Category;
use App\Models\Cake;
use App\Models\AddressBook;
use App\Models\Cart;
use App\Models\User;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['categories']=Category::all();
        $data['categories'] = Category::all();
        return view('user/index', $data);
    }

    public function myAccount(Request $request){
        $value = session('Uid');
        $data['user'] = User::where('id',$value)->first();
        if($data['user']){

        $data['address'] = AddressBook::where('user_id',$data['user']->id)->get();
        return view('user/myAccount',$data);
        }else{

        return view('user/myAccount');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function validateAddressRequest(Request $request)
    {
        return \Validator::make($request->all(), [
            'reciever_name' => 'required',
            'delivery_city' => 'required',
            'pinCode' => 'required',
            'delivery_address' => 'required',
            'shipping_number' => 'required',
            'addtype' => 'required',
        ])->errors();
    }

    public function saveAddress(Request $request, $id = '')
    {
        $message = new MessageHelper();
        $msg_data = array();
        $validationErrors = $this->validateAddressRequest($request);

        if (count($validationErrors)) {
            $message->errorMessage(implode("\n", $validationErrors->all()), $msg_data);
        }
        if (!empty($id)) {
            $address = AddressBook::find($id);

            if (empty($address)) {
                $message->errorMessage('Invalid Address Id', $msg_data);
            }
        } else {
            $address = new AddressBook;
        }
        $address ->reciever_name = $request->reciever_name;
        $address ->user_id = $request->user_id;
        $address ->delivery_city = $request->delivery_city;
        $address ->pinCode = $request->pinCode;
        $address ->delivery_address = $request->delivery_address;
        $address ->shipping_number = $request->shipping_number;
        $address ->addtype = $request->addtype;
        $address -> save();

        $message->successMessage('Address saved successfully', $msg_data);
        return url()->previous();
    }

    public function addressEdit($id){
        $value = session('email');
        $data['user'] = User::where('email',$value)->first();
        $data['address'] = AddressBook::all()->toArray();
        $data['edit'] = AddressBook::find($id)->toArray();

        return view('user/myAccount',$data);
    }

    public function addressDelete($id){

        $data = AddressBook::find($id);
        $data->delete();
        return response()->json(['success' => 'Address Deleted']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchCake( Request $request)
    {
       $data = $request->search;
       $cdata['cakes'] = Cake::where('cake_name','LIKE','%'.$data.'%')->get();
       $cdata['sData']=$data;
        return view('category/category_cakes',$cdata);
               // return $cakes;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}