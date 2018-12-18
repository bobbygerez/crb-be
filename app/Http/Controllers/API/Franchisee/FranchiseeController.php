<?php

namespace App\Http\Controllers\API\Franchisee;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Franchisee;

class FranchiseeController extends Controller
{
    public function __construct(){

        $this->authorizeResource(Franchisee::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        return response()->json([

            'franchisees' => $this->paginate(

                Franchisee::where('name', 'like', '%'. app()->make('request')->filter . '%')
                    ->relTable()
                    ->orderBy('created_at', 'desc')
                    ->get()

            )
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
    public function store(Request $request)
    {
        
        $franchisee = Franchisee::create($request->all());

        return response()->json([
            'success' => true,
            'request' => $request->all()
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Franchisee $franchisee, Request $request)
    {
       return response()->json([
           'franchisee' => Franchisee::where('id', $request->id)->relTable()->first()
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Franchisee $franchisee, Request $request)
    {
       return response()->json([
           'franchisee' =>Franchisee::where('id', $request->id)->relTable()->first()
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Franchisee $franchisee, Request $request)
    {
        $franchisee->update($request->all());

        return response()->json([
            'success' => true,
            'request' => $request->all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Franchisee $franchisee, Request $request)
    {
        Franchisee::find($request->id)->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function paginate($collection){

        $request =  app()->make('request');

        return new LengthAwarePaginator($collection->forPage($request->page, $request->perPage), $collection->count(), $request->perPage, $request->page);
    }
}