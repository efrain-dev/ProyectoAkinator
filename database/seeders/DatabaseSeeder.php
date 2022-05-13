<?php

namespace Database\Seeders;

use App\Models\Arbol;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Arbol::create(
            ['texto' => 'Cristiano Ronaldo', 'pregunta' => false]
        );

        // \App\Models\User::factory(10)->create();
    }
}
