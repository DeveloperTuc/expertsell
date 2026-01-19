<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->ean13,
            'nombre' => $this->faker->unique()->words(3, true),
            'descripcion' => $this->faker->sentence(),
            'imagen' => $this->faker->imageUrl(640, 480, 'productos', true),
            'stock' => $this->faker->numberBetween(10, 100),
            'stock_minimo' => $this->faker->numberBetween(5, 10),
            'stock_maximo' => $this->faker->numberBetween(50, 200),
            'precio_compra' => $this->faker->randomFloat(2, 10, 500),
            'precio_venta' => $this->faker->randomFloat(2, 20, 600),
            'fecha_ingreso' => $this->faker->date(),
            'categoria_id' => Categoria::inRandomOrder()->first()->id, //\App\Models\Categoria::factory()
            //con esto evito que se ejecute dos veces el seeder de Categoria
            'empresa_id' => 10,
        ];
    }
}
