<?php

namespace App\Http\Controllers\API;

use App\Http\Helpers\Status;
use App\Http\Models\Card;
use App\Http\Models\User;
use const Grpc\STATUS_CANCELLED;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Card::query()->with('type')->get();
        return response(['models' => $models],Status::SUCCESS_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Card::query()->with('type')->first();
        if(!$model)
            return response(['errors' => __('messages.card.model_not_found')]);
        return response(compact('model'),Status::SUCCESS_OK);
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
        $model = Card::find($id);
        if(!$model)
            return response(['errors' => __('messages.card.model_not_found')]);
        if($model->delete()){
            return response(compact('model'),Status::SUCCESS_OK);
        }else{
            return response(['errors' => $model->errors()]);
        }


    }

    public function validateModel(){

    }
}
