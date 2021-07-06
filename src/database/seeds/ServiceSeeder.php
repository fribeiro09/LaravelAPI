<?php

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->services()->create([
            'name' => 'Limpeza de Ar Condicionado',
            'price' => 100.98,
            'status' => 'A',
        ]);
    }
}
