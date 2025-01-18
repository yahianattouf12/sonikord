<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // cars 
        //1
        Product::create(
            [
                'shop_id'  =>'1',
                'name'     => 'Bentley',
                'price'     => '5000',
                'quantity'  => '3',
                'description' =>'A luxurious car with sleek design, premium leather interior
                , advanced technology,
                 powerful engine, smooth performance, and unparalleled comfort.',
                'image'    =>'images/cars/bently.jpg' ,
            ]
            );

        //2
        Product::create(
            [
                'shop_id'  =>'1',
                'name'     => 'BMW',
                'price'     => '3000',
                'quantity'  => '2',
                'description' =>'A luxurious car with sleek design, premium leather interior
                , advanced technology,
                 powerful engine, smooth performance, and unparalleled comfort.',
                'image'    =>'images/cars/bmw.jpg' ,
            ]
            );
       //3
       Product::create(
        [
            'shop_id'  =>'1',
            'name'     => 'Bugatti',
            'price'     => '7000',
            'quantity'  => '6',
            'description' =>'A luxurious car with sleek design, premium leather interior
            , advanced technology,
             powerful engine, smooth performance, and unparalleled comfort.',
            'image'    =>'images/cars/bugatti.jpg' ,
        ]
        );
       //4
        Product::create(
            [
                'shop_id'  =>'1',
                'name'     => 'Toyota',
                'price'     => '3000',
                'quantity'  => '5',
                'description' =>'A luxurious car with sleek design, premium leather interior
                , advanced technology,
                 powerful engine, smooth performance, and unparalleled comfort.',
                'image'    =>'images/cars/toyota.jpg' ,
            ]
            );
       //5
            Product::create(
                [
                    'shop_id'  =>'1',
                    'name'     => 'Mercedes',
                    'price'     => '5500',
                    'quantity'  => '6',
                    'description' =>'A luxurious car with sleek design, premium leather interior
                    , advanced technology,
                     powerful engine, smooth performance, and unparalleled comfort.',
                    'image'    =>'images/cars/mercedes.jpg' ,
                ]
                );
        //6
                Product::create(
                    [
                        'shop_id'  =>'1',
                        'name'     => 'Ford',
                        'price'     => '2000',
                        'quantity'  => '3',
                        'description' =>'A luxurious car with sleek design, premium leather interior
                        , advanced technology,
                         powerful engine, smooth performance, and unparalleled comfort.',
                        'image'    =>'images/cars/ford.jpg' ,
                    ]
                    );
        //7
                    Product::create(
                        [
                            'shop_id'  =>'1',
                            'name'     => 'BMW x6',
                            'price'     => '5000',
                            'quantity'  => '12',
                            'description' =>'A luxurious car with sleek design, premium leather interior
                            , advanced technology,
                             powerful engine, smooth performance, and unparalleled comfort.',
                            'image'    =>'images/cars/bwm2.jpg' ,
                        ]
                        );
                        
                        














                        
                        
          //pizza resturant  
          //1
          Product::create(
            [
                'shop_id'  =>'4',
                'name'     => 'super pizza',
                'price'     => '50',
                'quantity'  => '12',
                'description' =>'Pizza: A delicious pizza with a crispy crust,
                 rich tomato sauce, melted cheese, fresh toppings, aromatic herbs,
                  and a perfect flavour balance.',
                'image'    =>'images/pizza_resturant/pizza1.jpg' ,
            ]
            );
          //2
        Product::create(
            [
                'shop_id'  => '4',
                'name'     => 'Italian pizza',
                'price'     => '80',
                'quantity'  => '13',
                'description' => 'Pizza: A delicious pizza with a crispy crust,
                     rich tomato sauce, melted cheese, fresh toppings, aromatic herbs,
                      and a perfect flavour balance.',
                'image'    => 'images/pizza_resturant/pizza2.jpg',
            ]
        );
          //3
        Product::create(
            [
                'shop_id'  => '4',
                'name'     => 'american pizza',
                'price'     => '70',
                'quantity'  => '14',
                'description' => 'Pizza: A delicious pizza with a crispy crust,
                         rich tomato sauce, melted cheese, fresh toppings, aromatic herbs,
                          and a perfect flavour balance.',
                'image'    => 'images/pizza_resturant/pizza3.jpg',
            ]
        );
         //4
        Product::create(
            [
                'shop_id'  => '4',
                'name'     => 'syrian pizza',
                'price'     => '20',
                'quantity'  => '18',
                'description' => 'Pizza: A delicious pizza with a crispy crust,
                             rich tomato sauce, melted cheese, fresh toppings, aromatic herbs,
                              and a perfect flavour balance.',
                'image'    => 'images/pizza_resturant/pizza4.jpg',
            ]
        );
        //5
        Product::create(
            [
                'shop_id'  => '4',
                'name'     => 'special pizza',
                'price'     => '68',
                'quantity'  => '15',
                'description' => 'Pizza: A delicious pizza with a crispy crust,
                                 rich tomato sauce, melted cheese, fresh toppings, aromatic herbs,
                                  and a perfect flavour balance.',
                'image'    => 'images/pizza_resturant/pizza5.jpg',
            ]
        ); 
        //6
        Product::create(
            [
                'shop_id'  =>'4',
                'name'     => 'messi pizza',
                'price'     => '100',
                'quantity'  => '10',
                'description' =>'Pizza: A delicious pizza with a crispy crust,
                 rich tomato sauce, melted cheese, fresh toppings, aromatic herbs,
                  and a perfect flavour balance.',
                'image'    =>'images/pizza_resturant/pizza6.jpg' ,
            ]
            );

        //resturant1(alafandi)
        //1
        Product::create(
            [
                'shop_id'  => '5',
                'name'     => 'savings_meal',
                'price'     => '50',
                'quantity'  => '10',
                'description' => 'Fried Chicken: Crispy fried chicken with golden-brown coating,
                 juicy meat, savoury spices, rich flavour,
                  tender texture, and an irresistible crunch.',
                'image'    => 'images/alafandi/savings_meal.jpg',
            ]
        );
        //2
        Product::create(
            [
                'shop_id'  => '5',
                'name'     => 'buffalo_chicken',
                'price'     => '65',
                'quantity'  => '13',
                'description' => 'Fried Chicken: Crispy fried chicken with golden-brown coating,
                     juicy meat, savoury spices, rich flavour,
                      tender texture, and an irresistible crunch.',
                'image'    => 'images/alafandi/buffalo_chicken.jpg',
            ]
        );
        //3
        Product::create(
            [
                'shop_id'  => '5',
                'name'     => 'cheese_burger',
                'price'     => '40',
                'quantity'  => '12',
                'description' => 'Fried Chicken: Crispy fried chicken with golden-brown coating,
                         juicy meat, savoury spices, rich flavour,
                          tender texture, and an irresistible crunch.',
                'image'    => 'images/alafandi/cheese_burger.jpg',
            ]
        );
        //4
        Product::create(
            [
                'shop_id'  => '5',
                'name'     => 'fries',
                'price'     => '5',
                'quantity'  => '100',
                'description' => 'Fried Chicken: Crispy fried chicken with golden-brown coating,
                             juicy meat, savoury spices, rich flavour,
                              tender texture, and an irresistible crunch.',
                'image'    => 'images/alafandi/fries.jpg',
            ]
        );
        //5
        Product::create(
            [
                'shop_id'  => '5',
                'name'     => 'fried_chicken',
                'price'     => '99',
                'quantity'  => '100',
                'description' => 'Fried Chicken: Crispy fried chicken with golden-brown coating,
                                 juicy meat, savoury spices, rich flavour,
                                  tender texture, and an irresistible crunch.',
                'image'    => 'images/alafandi/fried_chicken.jpg',
            ]
        );
        //6
        Product::create(
            [
                'shop_id'  => '5',
                'name'     => 'rice_and_chicken',
                'price'     => '90',
                'quantity'  => '10',
                'description' => 'Fried Chicken: Crispy fried chicken with golden-brown coating,
                                     juicy meat, savoury spices, rich flavour,
                                      tender texture, and an irresistible crunch.',
                'image'    => 'images/alafandi/rice_and_chicken.jpg',
            ]
        );

        //koko resturant
        //1
           //koko resturant
    //1
    Product::create(
        [
            'shop_id'  => '6',
            'name'     => 'special_juice',
            'price'     => '90',
            'quantity'  => '12',
            'description' => 'Fried Chicken: Crispy fried chicken with golden-brown coating,
                                 juicy meat, savoury spices, rich flavour,
                                  tender texture, and an irresistible crunch.',
            'image'    => 'images/koko/special_juice.jpg',
        ]  
    );
    //2
    Product::create(
        [
            'shop_id'  => '6',
            'name'     => 'super_breakfast',
            'price'     => '200',
            'quantity'  => '10',
            'description' => 'Fried Chicken: Crispy fried chicken with golden-brown coating,
                                 juicy meat, savoury spices, rich flavour,
                                  tender texture, and an irresistible crunch.',
            'image'    => 'images/koko/super_breakfast.jpg',
        ]  
    );
    //3
    Product::create(
        [
            'shop_id'  => '6',
            'name'     => 'american_breakfast',
            'price'     => '23',
            'quantity'  => '20',
            'description' => 'Fried Chicken: Crispy fried chicken with golden-brown coating,
                                 juicy meat, savoury spices, rich flavour,
                                  tender texture, and an irresistible crunch.',
            'image'    => 'images/koko/american_breakfast.jpg',
        ]  
    );
    Product::create(
        [
            'shop_id'  => '6',
            'name'     => 'burger',
            'price'     => '67',
            'quantity'  => '10',
            'description' => 'Fried Chicken: Crispy fried chicken with golden-brown coating,
                                 juicy meat, savoury spices, rich flavour,
                                  tender texture, and an irresistible crunch.',
            'image'    => 'images/koko/burger.jpg',
        ]  
    );
    Product::create(
        [
            'shop_id'  => '6',
            'name'     => 'fries',
            'price'     => '3',
            'quantity'  => '10',
            'description' => 'Fried Chicken: Crispy fried chicken with golden-brown coating,
                                 juicy meat, savoury spices, rich flavour,
                                  tender texture, and an irresistible crunch.',
            'image'    => 'images/koko/fries.jpg',
        ]  
    );
    Product::create(
        [
            'shop_id'  => '6',
            'name'     => 'olive_salad',
            'price'     => '23',
            'quantity'  => '12',
            'description' => 'Fried Chicken: Crispy fried chicken with golden-brown coating,
                                 juicy meat, savoury spices, rich flavour,
                                  tender texture, and an irresistible crunch.',
            'image'    => 'images/koko/olive_salad.jpg',
        ]  
    );



    
            
            

    }
}
