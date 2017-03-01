<?php

namespace App\Http\Controllers;

use App\Product;
use App\Seller;
use App\Tag;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products=Product::all();
        foreach($products as $product){
            $seller=Seller::find($product->seller_id);
            $product["name_seller"]=$seller->name;
            $n=1;
            foreach ($product->tags  as $tag){
                $product[$n." tag id"]=$tag->pivot->tag_id;
                $product[$n." tag name"]=$tag->name;
                $n=$n+1;
            }
        }
        return Response::json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        Product::saved();
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
        $this->validate($request, [
            'name' => 'required|string',
            'price' => 'required|min:0.01|numeric',
            'description'=>'required|string',
            'seller_id'=>'required|exists:sellers,id',
            'tags'=>'array',
        ]);
        $attributes = $request->all(); //Obtener atributos
        $product = Product::create($attributes); //Crear
        foreach ($request->tags as $tagName){
            $tag_quantity=Tag::where('name',$tagName)->count();
            if( $tag_quantity>=1){
                $tag=Tag::where('name',$tagName)->first();
            }
            else{
                $attributeTag['name']=$tagName;
                $tag=Tag::create($attributeTag);
            }
            $product->tags()->attach($tag->id);
        }

        return Response::json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        $seller=Seller::find($product->seller_id);
        $product["name_seller"]=$seller->name;
        $n=1;
        foreach ($product->tags  as $tag){
            $product[$n." tag id"]=$tag->pivot->tag_id;
            $product[$n." tag name"]=$tag->name;
            $n=$n+1;
        }

        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'price' => 'required|min:0.1|numeric',
            'description'=>'required|string',
            'seller_id'=>'required|exists:sellers,id',
        ]);
        $attributes = $request->all(); //Obtener atributos
        $product->update($attributes); //Crear

        return $product;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //$product->tags()->detach();
        $product_id=$product->id;
       // foreach (Review::where('product_id',$product_id) as $review ){
     //       $review->delete();
       // }


        Product::destroy($product_id);
        return Response::json([],200);
    }

    public function addReview(Request $request, Product $product)
    {
        $this->validate($request, [
            'critic_name' => 'required|string',
            'title' => 'required|string',
            'content'=>'required|string',
            'date'=>'required|date',
        ]);
        $attributes = $request->all(); //Obtener atributos
        $attributes['product_id']=$product->id;
        $review=Review::create($attributes);

        return $review;
    }

    public function indexReview(Product $product)
    {
        $product_id=$product->id;
        $reviews=Review::where('product_id',$product_id)->get();
        return Response::json($reviews);
    }
    public function destroyReview(Review $review)
    {
        Review::destroy($review->id);
        return Response::json([],200);


    }

}
