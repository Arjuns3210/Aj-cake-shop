<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Cart;
use Auth;
use App\Http\Helpers\MessageHelper;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        return view("/user/login");
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function rules($data){
    $messages = [
        'email.required'        => 'Please enter email ',
        'email.exists'          => 'Email not registered',
        'email.email'           => 'Please enter valid email ',
        'password.required' => 'Enter your password.',
    ]; 

    $validator = Validator::make($data, [
        'email' =>'required|email|exists:users',
        'type' => 'login',
        'password'      =>'required'
    ], $messages);

    return $validator;
    }

    public function Login(Request $request)
    {
        $cart=cart::sum('cake_quentity');

        $user= user::where('email',$request->email)->get();
        $validator = $this->rules($request->all());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);   
        }
        else{
            if($user[0]->password==md5($request->email.$request->password)){
                $request->session()->put('Uid',$user[0]->id);
                $request->session()->put('user',$user[0]->user_name);
                $request->session()->put('email',$user[0]->email);
                $request->session()->put('cart',$cart);
                return redirect('/');
            }
            else{
                return \Redirect::back()->withErrors([
                    'password' => 'Incorrect password!'
                ]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function validateSignUpRequest(Request $request)
    {
        return \Validator::make($request->all(), [
            'user_name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile_no' => 'required|unique:users',
            'password' => 'required',
            'address' => 'required',
        ])->errors();
    }
    private function validateRequest(Request $request)
    {
        return \Validator::make($request->all(), [
            'user_name' => 'required',
            'gender' => 'required',
            'bday' => 'required',
            'mobile_no' => 'required',
        ])->errors();
    }

    public function saveUser(Request $request)
    {
        $message = new MessageHelper();
        $msg_data = array();

        if (isset($_GET['id'])) {
            $validationErrors = $this->validateRequest($request);
        } else {
            $validationErrors = $this->validateSignUpRequest($request);
        }

        if (count($validationErrors)) {
            $message->errorMessage(implode("\n", $validationErrors->all()), $msg_data);
        }

        $cart=cart::sum('cake_quentity');
        $email = $request->email;

        if (isset($_GET['id'])) {
            $check = User::where([['email',$email],['id','<>',$_GET['id']]])->get()->toArray();
            if(isset($check[0])){
                $message->errorMessage('Email Already exists',$msg_data);
            }
            $check = User::where([['mobile_no', $request->mobile_no], ['id', '<>', $_GET['id']]])->get()->toArray();
            if (isset($check[0])) {
                $message->errorMessage('Phone Number Already Exist', $msg_data);
            }
            $user = User::find($_GET['id']);     
        } else {
            $user = new User();
            $user->password = md5($request->email . $request->password);
        }
        $name =$request->user_name;

        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->bday = $request->bday;
        $user->gender = $request->gender;
        $user->mobile_no = $request->mobile_no;
        $user->address = $request->address;
        $user->save();
        $request->session()->put('user',$request->user_name);

        if(isset($_GET['id'])){

        $message->successMessage('Profile Updated', $msg_data);
        }else{

        $message->successMessage($name.' added', $msg_data);
        }

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