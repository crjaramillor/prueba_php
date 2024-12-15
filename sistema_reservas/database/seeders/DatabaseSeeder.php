<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 4 usuarios tipo 'cliente'
        DB::table('users')->insert([
            [
                'name' => 'Cliente 1',
                'email' => 'cliente1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'cliente',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cliente 2',
                'email' => 'cliente2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'cliente',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cliente 3',
                'email' => 'cliente3@example.com',
                'password' => Hash::make('password123'),
                'role' => 'cliente',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cliente 4',
                'email' => 'cliente4@example.com',
                'password' => Hash::make('password123'),
                'role' => 'cliente',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        // Crear 2 usuarios tipo 'encargado'
        DB::table('users')->insert([
            [
                'name' => 'Encargado 1',
                'email' => 'encargado1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'encargado',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Encargado 2',
                'email' => 'encargado2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'encargado',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        // Crear 4 usuarios tipo 'propietario'
        DB::table('users')->insert([
            [
                'name' => 'Propietario 1',
                'email' => 'propietario1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'propietario',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Propietario 2',
                'email' => 'propietario2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'propietario',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Propietario 3',
                'email' => 'propietario3@example.com',
                'password' => Hash::make('password123'),
                'role' => 'propietario',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Propietario 4',
                'email' => 'propietario4@example.com',
                'password' => Hash::make('password123'),
                'role' => 'propietario',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        // Crear 4 propiedades, cada una asociada a un propietario
        DB::table('propiedades')->insert([
            [
                'name' => 'Apartamento 1',
                'address' => 'Calle 1, Ciudad 1',
                'city' => 'Ciudad 1',
                'state' => 'Estado 1',
                'price_per_night' => 100,
                'owner_id' => 1,
                'description' => 'Apartamento cómodo con vista al mar.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Apartamento 2',
                'address' => 'Calle 2, Ciudad 2',
                'city' => 'Ciudad 2',
                'state' => 'Estado 2',
                'price_per_night' => 120,
                'owner_id' => 2,
                'description' => 'Apartamento moderno cerca del centro.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Apartamento 3',
                'address' => 'Calle 3, Ciudad 3',
                'city' => 'Ciudad 3',
                'state' => 'Estado 3',
                'price_per_night' => 150,
                'owner_id' => 3,
                'description' => 'Apartamento espacioso con piscina.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Apartamento 4',
                'address' => 'Calle 4, Ciudad 4',
                'city' => 'Ciudad 4',
                'state' => 'Estado 4',
                'price_per_night' => 200,
                'owner_id' => 4,
                'description' => 'Apartamento con jacuzzi privado.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        // Crear algunas reservas
        DB::table('reservas')->insert([
            [
                'propiedad_id' => 1,
                'user_id' => 1,
                'fecha_inicio' => '2024-12-01',
                'fecha_fin' => '2024-12-10',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'propiedad_id' => 2,
                'user_id' => 2,
                'fecha_inicio' => '2024-12-05',
                'fecha_fin' => '2024-12-15',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'propiedad_id' => 3,
                'user_id' => 3,
                'fecha_inicio' => '2024-12-10',
                'fecha_fin' => '2024-12-20',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'propiedad_id' => 4,
                'user_id' => 4,
                'fecha_inicio' => '2024-12-15',
                'fecha_fin' => '2024-12-25',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'propiedad_id' => 1,
                'user_id' => 2,
                'fecha_inicio' => '2024-04-01',
                'fecha_fin' => '2024-10-01',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'propiedad_id' => 3,
                'user_id' => 3,
                'fecha_inicio' => '2024-04-01',
                'fecha_fin' => '2024-10-01',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        // Crear algunas incidencias
        DB::table('incidencias')->insert([
            [
                'propiedad_id' => 1,
                'user_id' => 1,
                'descripcion' => 'Problema con la TV',
                'estado' => 'Abierta',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'propiedad_id' => 2,
                'user_id' => 2,
                'descripcion' => 'No hay agua en el baño',
                'estado' => 'Pendiente',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'propiedad_id' => 3,
                'user_id' => 3,
                'descripcion' => 'Goteras en la ventana',
                'estado' => 'Cerrada',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],    [
                'propiedad_id' => 1,
                'user_id' => 1,
                'descripcion' => 'Problema con la TV',
                'estado' => 'Abierta',
                'created_at' => Carbon::create(2024, 10, 3, 12, 0, 0), 
                'updated_at' => Carbon::create(2024, 10, 3, 12, 0, 0), 
            ],
            [
                'propiedad_id' => 1,
                'user_id' => 1,
                'descripcion' => 'Fugas en la cocina',
                'estado' => 'Abierta',
                'created_at' => Carbon::create(2024, 06, 5, 9, 30, 0), 
                'updated_at' => Carbon::create(2024, 06, 5, 9, 30, 0), 
            ],
            [
                'propiedad_id' => 2,
                'user_id' => 2,
                'descripcion' => 'No hay agua en el baño',
                'estado' => 'Pendiente',
                'created_at' => Carbon::create(2024, 05, 7, 14, 0, 0), 
                'updated_at' => Carbon::create(2024, 05, 7, 14, 0, 0), 
            ],
            [
                'propiedad_id' => 3,
                'user_id' => 3,
                'descripcion' => 'Goteras en la ventana',
                'estado' => 'Cerrada',
                'created_at' => Carbon::create(2024, 04, 20, 10, 0, 0),
                'updated_at' => Carbon::create(2024, 04, 20, 10, 0, 0), 
            ]
            
        ]);

        // Crear algunas tareas asociadas a incidencias
        DB::table('tareas')->insert([
            [
                'incidencia_id' => 1,
                'descripcion' => 'Reparar televisor',
                'estado' => 'Asignada', 
                'quien_asume_costo' => 'Cliente',
                'costo' => 50,
                'comentario' => '',
                'encargado_id' => 6,  
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'incidencia_id' => 2,
                'descripcion' => 'Arreglar suministro de agua',
                'estado' => 'En Proceso',  
                'quien_asume_costo' => 'Propietario',
                'costo' => 100,
                'comentario' => '',
                'encargado_id' => 5,  // Asignando Encargado 2
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'incidencia_id' => 3,
                'descripcion' => 'Sellar goteras',
                'estado' => 'Solucionada',  
                'quien_asume_costo' => 'Homeselect',
                'costo' => 30,
                'comentario' => 'Se sellaron las goteras con material especializado.',
                'encargado_id' => 5,  // Asignando Encargado 1
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
        
    }
}
