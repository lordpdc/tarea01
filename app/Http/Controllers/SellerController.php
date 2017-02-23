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
            'name' => 'required',
            'last_name' => 'required',
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
            'name' => 'required',
            'last_name' => 'required',
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
        $seller->delete();
        Address::destroy($address_id);// le puse delete oncascade pero no funciona
        return Response::json([],200);
    }

    public function addAddress(Request $request,Seller $seller)
    {
        //aki iria los validate respectivos
        $attributes = $request->all();
        $address=Address::find($seller->address_id);
        $address->update($attributes);//Actualizar información pendiente refactor para que cree
        return $address;
    }
    public function updateAddress(Request $request,Seller $seller)
    {
        $attributes = $request->all();
        $address=Address::find($seller->address_id);
        $address->update($attributes);//Actualizar información
        return $address;
    }
}
