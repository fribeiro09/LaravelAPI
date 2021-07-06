<?php

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenant::create([
            'name' => 'Empresa XPTO',
            'document_number' => '123456',
            'email' => 'empresa.xpto@gmail.com',
            'status' => 'A',
        ]);
    }
}
