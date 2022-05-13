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
        Arbol::create(
            ['texto' => 'Roberto Gomez Bolaños', 'pregunta' => false]
        );
        Arbol::create(
            ['texto' => 'Pedro Sanchez', 'pregunta' => false]
        );
        Arbol::create(
            ['texto'=>'Maria Antonieta','pregunta'=>false]
        );
        Arbol::create(
            ['texto'=>'Leonel Messi','pregunta'=>false]
        );
        Arbol::create(
            ['texto'=>'Dios','pregunta'=>false]
        );
        Arbol::create(
            ['texto'=>'Goku','pregunta'=>false]
        );
        Arbol::create(
            ['texto'=>'Mario Bross','pregunta'=>false]
        );
        // \App\Models\User::factory(10)->create();
    }
}
