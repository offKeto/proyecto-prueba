<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            'title' => 'Tarea 1',
            'description' => 'Esta es la tarea 1.',
            'status' => 'pending',
            'created_at' => now(),
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 2',
            'description' => 'Esta es la tarea 2.',
            'status' => 'in_progress',
            'created_at' => now(),
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 3',
            'description' => 'Esta es la tarea 3.',
            'status' => 'completed',
            'created_at' => now(),
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 4',
            'description' => 'Esta es la tarea 3.',
            'status' => 'completed',
            'created_at' => now(),
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 5',
            'description' => 'Esta es la tarea 3.',
            'status' => 'completed',
            'created_at' => now(),
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 6',
            'description' => 'Esta es la tarea 3.',
            'status' => 'completed',
            'created_at' => now(),
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 7',
            'description' => 'Esta es la tarea 3.',
            'status' => 'completed',
            'created_at' => now(),
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 8',
            'description' => 'Esta es la tarea 3.',
            'status' => 'completed',
            'created_at' => now(),
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 9',
            'description' => 'Esta es la tarea 3.',
            'status' => 'completed',
            'created_at' => now(),
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 10',
            'description' => 'Esta es la tarea 3.',
            'status' => 'completed',
            'created_at' => now(),
        ]);
        DB::table('tasks')->insert([
            'title' => 'Tarea 11',
            'description' => 'Esta es la tarea 3.',
            'status' => 'completed',
            'created_at' => now(),
        ]);
    }
}
