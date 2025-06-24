<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Limpiar la tabla antes de insertar nuevos datos
        DB::table('products')->truncate();

        // Insertar 20 productos de prueba
        $products = [
            ['name' => 'Pantalon Verde', 'price' => 799.99],
            ['name' => 'Camisa Roja', 'price' => 1299.99],
            ['name' => 'Zapatos Azules', 'price' => 499.99],
            ['name' => 'Gorra Negra', 'price' => 89.99],
            ['name' => 'Pantalon Azul', 'price' => 99.99],
            ['name' => 'Camisa Negra', 'price' => 349.99],
            ['name' => 'Zapatos Blancos', 'price' => 599.99],
            ['name' => 'Faldas Largas', 'price' => 199.99],
            ['name' => 'Mini Vestido', 'price' => 499.99],
            ['name' => 'Camiseta Negra', 'price' => 79.99],
            ['name' => 'Camiseta Blanca', 'price' => 649.99],
            ['name' => 'Mini falda', 'price' => 399.99],
            ['name' => 'Mini vestido', 'price' => 159.99],
            ['name' => 'Pantalones Cortos', 'price' => 1099.99],
            ['name' => 'Vikinys', 'price' => 49.99],
            ['name' => 'Boxers', 'price' => 129.99],
            ['name' => 'Camiseta Beige', 'price' => 599.99],
            ['name' => 'Camiseta Marron', 'price' => 149.99],
            ['name' => 'Jeen Verde', 'price' => 79.99],
            ['name' => 'Legi Negro', 'price' => 339.99],
        ];

        // Insertar productos en la base de datos
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
