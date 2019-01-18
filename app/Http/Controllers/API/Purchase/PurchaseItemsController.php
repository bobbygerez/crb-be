<?php

namespace App\Http\Controllers\API\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Purchase;
use App\Repo\Purchase\PurchaseInterface;

class PurchaseItemsController extends Controller
{


    protected $purchase;

    public  function __construct(PurchaseInterface $purchase){

        $this->purchase = $purchase;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $request = app()->make('request');

        return response()->json([
            'purchaseItems' => $this->purchase->paginate(
                $this->purchase->purchase_items($request)
            ),
            'purchase' => $this->purchase->where('id', $request->id)->relTable()->first()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Purchase $purchase, Request $request)
    {
        

        return response()->json([
            'success' => $this->purchase->store($request)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase, Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase, Request $request)
    {
        
        return response()->json([
            'purchase_item' => $this->purchase->purchase_item( $request )
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Purchase $purchase, Request $request)
    {
        
        $this->purchase->update($request);
        
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase, Request $request)
    {
       $this->purchase->find($request->id)
            ->items()
            ->newPivotStatement()
            ->where('id', '=', $request->pivotId)
            ->delete();
        
        return response()->json([
            'success' => true
        ]);

    }
}