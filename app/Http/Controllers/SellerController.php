<?php

namespace App\Http\Controllers;

use App\Seller;
use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::json(Seller::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Seller::saved();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'last_name' => 'required|string',
        ]);
        $address=Address::create();
        $attributes = $request->all(); //Obtener atributos
        $attributes['address_id']= $address->id;
        $seller = Seller::create($attributes); //Crear
        return Response::json($seller);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        return $seller;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        //
        $this->validate($request, [
            'name' => 'required|string',
            'last_name' => 'required|string',
        ]);
        $attributes = $request->all();
        $seller->update($attributes);//Actualizar información
        return $seller;
    }
    public function partialUpdate(Request $request, Seller $seller)
    {
        //
        $this->validate($request, [
            'name' => 'string',
            'last_name' => 'string',
        ]);
        $attributes = $request->all();
        $seller->update($attributes);//Actualizar información
        return $seller;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */

    public function destroy(Seller $seller)
    {
        $address_id=$seller->address_id;
        //$seller->delete();// le puse delete oncascade pero no funciona
        Address::destroy($address_id);

        return Response::json([],200);
    }

    public function addAddress(Request $request,Seller $seller)
    {
        //aunque no los pidio agrege validate
        $this->validate($request, [
            'city' => 'required|string',
            'state'=> 'required|string',
            'country'=> 'required|string',
            'address'=> 'required|string',
            'zip_code'=> 'required|numeric',
        ]);
        $attributes = $request->all();
        $address=Address::find($seller->address_id);
        $address->update($attributes);// refactor pendiente para que cree y no actualize
        return $address;
    }
    public function updateAddress(Request $request,Seller $seller, Address $address)
    {
        $this->validate($request, [
            'city' => 'required|string',
            'state'=> 'required|string',
            'country'=> 'required|string',
            'address'=> 'required|string',
            'zip_code'=> 'required|numeric',
        ]);
        $attributes = $request->all();

        if($address->id == $seller->address_id) {
            $address->update($attributes);
        }
        return $address;
    }
}
