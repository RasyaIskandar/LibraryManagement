<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class bookfactoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(3),
            'penulis' => $this->faker->name,
            'tahun_terbit' => $this->faker->date('Y-m-d', '-1 year'),
            'jumlah_stok' => $this->faker->numberBetween(0, 100),
            'kategori' => $this->faker->randomElement(['Fiction', 'Non-fiction', 'Science', 'History', 'Biography']),
            'deskripsi' => $this->faker->paragraph,
            'status' => $this->faker->boolean,
        ];
    }
}