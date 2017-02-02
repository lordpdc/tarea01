<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $N_TAGS=5;
        $N_SELLER=2;
        $N_PRODUCTS_FOR_SELLER=3;
        $N_ADDRESSES=$N_SELLER;
        $N_REVIEWS_FOR_PRODUCT=10;
        $tags = factory(\App\Tag::class, $N_TAGS)->create();
        factory(\App\Seller::class, $N_SELLER)->create()->each(
            function($seller) use ($tags){
            factory(\App\Product::class, 3)->create(['seller_id' => $seller->id])->each(
                function($product) use ($tags){
                factory(\App\Review::class, 10)->create(['product_id' => $product->id]);
                $tag_ids=array(1,2,3,4,0);
                $random=array_rand($tag_ids,2);
                $product->tags()->attach($tags[$tag_ids[$random[0]]]->id);
                $product->tags()->attach($tags[$tag_ids[$random[1]]]->id);
            });
        });
    }


}
