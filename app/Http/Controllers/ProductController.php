<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Company;

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

    public function index(Request $request)
    {
        //$products = Product::latest()->paginate(5);
        $companies = Company::all();
        $keyword = $request->input('keyword');
        $companyId = $request->input('companyId');

        $query = Product::query();

        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }
        if(!empty($companyId)) {
            $query->where('company_id', 'LIKE', $companyId);
        }

        $products = $query->get();

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

        $input = $request->all();

        if($img_path = $request->file('img_path')) {
            $destinationPath = 'storage/app/public/images/';
            $productImage =date('YmdHis').".". $img_path->getClientOriginalExtension();
            $img_path->move($destinationPath,$productImage);
            $input['img_path'] = "$productImage";
        }

        Product::create($input);

        return redirect()->route('products.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $companies = Company::all();
        return view('layouts.show',compact('product','companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $products = Product::all();
        $companies = Company::all();
        return view('layouts.edit',compact('product'))
            ->with('companies',$companies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {        
        $data = Product::find($product->id);
        $request->validate([
            'product_name' => 'required',
            'company_id' => 'required|integer',
            'price' => 'required|integer|alpha_num',
            'stock' => 'required|integer|alpha_num',
            'comment'=> 'max:150',
            'img_path' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

        $input = $request->all();
        
        if($img_path = $request->file('img_path')) {
            $destinationPath = 'storage/app/public/images/';
            $productImage =date('YmdHis').".". $img_path->getClientOriginalExtension();
            $img_path->move($destinationPath,$productImage);
            $input['img_path'] = "$productImage";
        }else{
            unset($input['img_path']);
        }

        $data->update($input);

        $companies = Company::all();
        return redirect()->route('products.edit',compact('product'))
            ->with('companies',$companies);
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
        return redirect()->route('products.index');
    }
}
