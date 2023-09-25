<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{

    use Sortable;
    public $sortable = ['id','product_name','price','stock','company_id'];

    use HasFactory;

    protected $fillable = [
        'product_name','img_path','price','stock','company_id','comment','created_at','updated_at',
    ];

   public function ProductList($id){

    $product = Product::find($id)
    ->join('companies','products.company_id','=','companies.id')
    ->select('products.*','companies.company_name')
    ->find($id);

    return $product;
    }


    public function ProductSearch($keyword,$companyId,$jougenPrice,$kagenPrice,$jougenStock,$kagenStock,$sortColumn,$sortDirection){
    $query = DB::table('products')
            ->join('companies','products.company_id','=','companies.id')
            ->select('products.*','companies.company_name');
        //     ->sortable();
        // $query = self::join('companies','products.company_id','=','companies.id')
        // ->select('products.*','companies.company_name')
        // ->sortable();
            if(!empty($keyword)) {
                $query->where('product_name', 'LIKE', "%{$keyword}%");

                //$search = $query->get();
                //$products = $search->ProductList();
            }
            if(!empty($companyId)) {
                $query->where('company_id', '=', $companyId);

                //$search = $query->get();
               // $products = $search->ProductList();
            }

            if(!empty($jougenPrice)) {
                $query->where('price', '<=', $jougenPrice);
            }
            if(!empty($kagenPrice)) {
                $query->where('price', '>=', $kagenPrice);
            }

            if(!empty($jougenStock)) {
                $query->where('stock', '<=', $jougenStock);
            }
            if(!empty($kagenStock)) {
                $query->where('stock', '>=', $kagenStock);
            }

            $products = $query->orderBy($sortColumn,$sortDirection)->paginate(10);

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