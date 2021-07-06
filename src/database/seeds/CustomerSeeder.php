<?php

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->customers()->create([
            'name' => 'Fernando Ribeiro de Oliveira',
            'document_number' => '12345678909',
            'zipcode' => '15015015',
            'address' => 'Av Central, 1000',
            'district' => 'Centro',
            'city' => 'São José do Rio Preto',
            'state' => 'SP',
            'cellular' => '1799998888',
            'email' => 'fernandoliveira6@hotmail.com',
            'status' => 'A',
        ]);
    }
}
