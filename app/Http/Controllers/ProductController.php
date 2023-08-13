<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Company;
use DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function __construct(){
        $this->middleware('auth');
      }

    //public function index(Request $request)
    //{

    //$model = new Product();
    //$products = $model->ProductList();

    //return view('layouts.index', compact('products'));

   // }
    
    public function search(Request $request)
    {
    $companies = Company::all();
    $model = new Product();

    $keyword = $request->input('keyword');
    $companyId = $request->input('companyId');
    $products = $model->ProductSearch($keyword,$companyId);

   


    return view('layouts.index', compact('products', 'keyword','companies','companyId'));

    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('layouts.create')
            ->with('companies',$companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function regist(Request $request)
    {
        $request->validate([
        'product_name' => 'required',
        'company_id' => 'required|integer',
        'price' => 'required|integer|alpha_num',
        'stock' => 'required|integer|alpha_num',
        'comment'=> 'max:150',
        'img_path' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

       
        DB::beginTransaction();
        try {
            $model = new Product();
            $img_path = $request->file('img_path'); 
            if($img_path){
                $destinationPath = 'storage/app/public/images/';
                $fileName = $img_path->getClientOriginalName();
                $img_path->move($destinationPath,$fileName);
            }

            //dd($input);
            $model->registProduct($request,$fileName);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        return redirect()->route('products.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = new Product();
        $product = $model->ProductList($id);

        return view('layouts.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $product = Product::find($id);
        return view('layouts.edit',compact('product','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        

        $request->validate([
            'product_name' => 'required',
            'company_id' => 'required|integer',
            'price' => 'required|integer|alpha_num',
            'stock' => 'required|integer|alpha_num',
            'comment'=> 'max:150',
            'img_path' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);


            DB::beginTransaction();
            try {
                $model = Product::find($id);
                $img_path = $request->file('img_path'); 
                if($img_path){
                    $destinationPath = 'storage/app/public/images/';
                    $fileName = $img_path->getClientOriginalName();
                    $img_path->move($destinationPath,$fileName);
                }else{
                    unset($img_path);
                }

                $model->editProduct($id,$request,$fileName);


                DB::commit();
            } catch (\Exception $e) {


                DB::rollback();
                return back();
            }
            $product = Product::find($id);

            $companies = Company::all();
        return view('layouts.edit',compact('product','companies'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.search');
    }
    
}
