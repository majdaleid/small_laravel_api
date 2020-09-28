<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //localhost/itemapi/public/api/items/
    public function index()
    {

        $items=Item::get();
        return response()->json($items);
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

     //http://localhost/itemapi/public/api/items?text=item3&body=body3
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
           'text' => 'required',
           'body' => 'required',
       ]);

       if ($validator->fails()) {
           return ['response'=>$validator->messages(),'success'=>false];
       }
       $item=new Item();
       $item->text=$request->input('text');
       $item->body=$request->input('body');

       $item->save();

    return response()->json($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ //localhost/itemapi/public/api/items/2
    public function show($id)
    {
        $item=Item::find($id);

        return response()->json($item);
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

     //call it from postman php artisan route:list
     //post _method=PUT
     //post http://localhost/itemapi/public/api/items/2?_method=PUT&text=item2 changed&body=body2 changed
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
           'text' => 'required',
           'body' => 'required',
       ]);

       if ($validator->fails()) {
           return ['response'=>$validator->messages(),'success'=>false];
       }
       $item=Item::find($id);
       $item->text=$request->input('text');
       $item->body=$request->input('body');

       $item->save();

    return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //_method=DELETE
    public function destroy($id)
    {
        $item=Item::find($id);

        $item->delete();

        return ['response'=>'item deleted','success'=>true];
    }
}
