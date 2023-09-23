<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Cake;
use App\Http\Helpers\MessageHelper;
use App\Models\Category;
use Illuminate\Http\Request;

class CakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customCakeView($seo_url)
    {
        $data['category'] = Category::where('category_url', $seo_url)->first();
        $data['cakes'] = Cake::where('category_id', $data['category']->id)->get();
        // $data1 = json_encode($data['cakes']);
        // echo '<pre>';
        // print_r(json_decode($data1));
        // echo '</pre>';
        return view('category/category_cakes', $data);
    }

    public function cakeBuy($seo_url)
    {
        $data['cakes'] = cake::where('cake_url', $seo_url)->first();
         // $data1 = json_encode($data['cakes']);
        // echo '<pre>';
        // print_r(json_decode($data1));
        // echo '</pre>';
        return view('category/cake_buy',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AddCake(Request $request)
    {
        $data['categories'] = Category::all();
        return view('cakes/cake_add', $data);
    }

    private function validateCakeRequest(Request $request)
    {
        return \Validator::make($request->all(), [
            'cake_name' => 'required|string|unique:cakes,cake_name,',
            'cake_price' => 'required',
            'category_id' => 'required',
            'img_name' => 'required',
        ])->errors();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveCake(Request $request)
    {
        $message = new MessageHelper();
        $msg_data = array();
        if (isset($_GET['id'])) {
            $validationErrors = $this->validateRequest($request);
        } else {
            $validationErrors = $this->validateCakeRequest($request);
        }
        if (count($validationErrors)) {
            $message->errorMessage(implode("\n", $validationErrors->all()), $msg_data);
        }
        
        $cake_url = str_replace(" ", "-", strtolower($request->cake_name . "-cakes"));
        
        $cake = new Cake;
        $cake->cake_name = $request->cake_name;
        $cake->cake_price = $request->cake_price;
        $cake->cake_description = $request->cake_description;
        $cake->category_id = $request->category_id;
        $cake->cake_url=$cake_url;
        $cake->cake_details=$request->cake_details;

        if($request->hasFile('img_name')){
            $names = [];

            foreach($request->file('img_name') as $image)
            {
                $destinationPath = 'public/images/';
                $filename = $image->getClientOriginalName();
                $image->move($destinationPath, $filename);
                array_push($names, $filename);
            }
            $cake->img_name = json_encode($names);
        }

        $cake->save();
        $message->successMessage('Cake saved successfully', $msg_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cake  $cake
     * @return \Illuminate\Http\Response
     */
    private function validateCategoryRequest(Request $request)
    {
        return \Validator::make($request->all(), [
            'category_name' => 'required|string|unique:categories,category_name,',
            'category_description' => 'required',
            'image_path' => 'required',
        ])->errors();
    }

    public function saveCategory(Request $request)
    {
        $message = new MessageHelper();
        $msg_data = array();
        if (isset($_GET['id'])) {
            $validationErrors = $this->validateRequest($request);
        } else {
            $validationErrors = $this->validateCategoryRequest($request);
        }
        if (count($validationErrors)) {
            $message->errorMessage(implode("\n", $validationErrors->all()), $msg_data);
        }

        $image= $request->file('image_path');
        $destinationPath = 'public/catImages/';
        $filename = $image->getClientOriginalName();
        $image ->move($destinationPath,$filename);

        $category_url = str_replace(" ", "-", strtolower($request->category_name."-cakes"));
        $category = new category();
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;
        $category->image_path = $filename;
     
        $category->category_url = $category_url;
        $category->save();
        $message->successMessage('Category saved successfully', $msg_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cake  $cake
     * @return \Illuminate\Http\Response
     */
    public function edit(cake $cake)
    {
        //
    }

    public function sortingCake(Request $request)
    {

      $option = $request->sortingBy;
      $catId = $request->catId;
    
      if($option == 'Popularity'){
        return "Popularity";
      }
      elseif ($option == 'priceAsc') {
        $data = DB::select('SELECT * FROM `cakes` WHERE `category_id`='.$catId.' ORDER by cast(cake_price as int )asc;');
        return $data;
      }elseif ($option == 'priceDesc') {
        $data = DB::select('SELECT * FROM `cakes` WHERE `category_id`='.$catId.' ORDER by cast(cake_price as int )desc;');
        return $data;
      }elseif ($option == 'new') {
        $data = DB::select('SELECT * FROM `cakes` WHERE `category_id`='.$catId.' ORDER by updated_at asc;');
        return $data;
          
      }
      // return view('category/category_cakes', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cake  $cake
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cake $cake)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cake  $cake
     * @return \Illuminate\Http\Response
     */
    public function destroy(cake $cake)
    {
        //
    }
}