<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Shop::truncate();
//1
        Shop::create([
            'name' => 'car Store',
            'city'=>'Damascus',
            'address'=>'main street',
            'category'=>'cars',
            'phone'=>'0948822123',
            'image'=>'images/shops/car_store.jpg'

        ]);
//2
        Shop::create([
            'name' => 'Zara',
            'city'=>'Damascus',
            'address'=>'main street',
            'category'=>'clothes',
            'phone'=>'0948822124',
            'image'=>'images/shops/clothes_store1.jpg'

        ]);
//3
        Shop::create([
            'name' => 'H&M',
            'city'=>'Allepo',
            'address'=>'main street',
            'category'=>'clothes',
            'phone'=>'0948822125',
            'image'=>'images/shops/clothes_store2.jpg'

        ]);
//4
        Shop::create([
            'name' => 'pizza alsham',
            'city'=>'Damascus',
            'address'=>'main street',
            'category'=>'food',
            'phone'=>'0948822135',
            'image'=>'images/shops/pizza_resturant.jpg'

        ]);

//5 
        Shop::create([
            'name' => 'alafandi',
            'city'=>'Damascus',
            'address'=>'main street',
            'category'=>'food',
            'phone'=>'0948822154',
            'image'=>'images/shops/resturant1.jpg'

        ]);
//6        
        Shop::create([
            'name' => 'Koko resturant',
            'city'=>'Homs',
            'address'=>'main street',
            'category'=>'cars',
            'phone'=>'0948822589',
            'image'=>'images/shops/resturant2.jpg'

        ]); 

        //7       
        Shop::create([
            'name' => 'Adidas',
            'city'=>'Hama',
            'address'=>'main street',
            'category'=>'sports',
            'phone'=>'0948844456',
            'image'=>'images/shops/adidas.jpg'

        ]); 
    
    }



    //     Schema::create('shops', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('name', 60);
    //         $table->string('city', 10);
    //         $table->string('address');
    //         $table->string('category', 40)->nullable();
    //         $table->string('phone')->nullable();
            
    //         // todo: don't forget to add default to image...
    //         $table->string('image', 300)->nullable();
    //         $table->timestamps();

    // }
}
