<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sale;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiSales(Request $request)
    {
        $id = $request->id;
        $stock = $request->stock;

        $model = Product::find($id);

        DB::beginTransaction();
            try {
                if($stock > $model->stock){
                    return log::debug('在庫切れ');
                } else {
                    $apistock =$model->stock-$stock;
                    $model->decrement($apistock);
                    log::debug('更新完了');
                }
                DB::commit();
            } catch (\Exception $e) {


                DB::rollback();
                return back();
            }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
