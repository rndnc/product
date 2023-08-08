<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name','img_path','price','stock','company_id','comment','created_at','updated_at',
    ];

   // public function ProductList(){
    //    $products = DB::table('companies')
    //        ->join('products','companies.id','=','products.company_id')
    //        ->get();

       //return $products;
    //}
    public function ProductSearch($keyword,$companyId){
    $products = DB::table('products')
            ->join('companies','products.company_id','=','companies.id')
            ->select('products.*','companies.company_name');
            if(!empty($keyword)) {
                $products->where('product_name', 'LIKE', "%{$keyword}%");

                //$search = $query->get();
                //$products = $search->ProductList();
            }
            if(!empty($companyId)) {
                $products->where('company_id', '=', $companyId);

                //$search = $query->get();
               // $products = $search->ProductList();
            }
            $products->get();

        return $products;
    }


    public function registProduct($data,$fileName){

        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'img_path' => $fileName,
            'price'=> $data->price,
            'stock' => $data->stock,
            'company_id' => $data->company_id,
            'comment'=> $data->comment,
            'created_at'=> now(),
            'updated_at' => now(),
        ]);
        

        
    }

    public function editProduct($id,$data,$fileName){

        Product::find($id)->update([
            'product_name' => $data->product_name,
            'img_path' => $fileName,
            'price'=> $data->price,
            'stock' => $data->stock,
            'company_id' => $data->company_id,
            'comment'=> $data->comment,
            'updated_at' => now(),
        ]);
    }
}