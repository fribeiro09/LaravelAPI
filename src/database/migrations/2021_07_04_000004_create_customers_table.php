<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('tenant_id');
            $table->string('name', 100);
            $table->string('document_number', 11)->unique();
            $table->string('zipcode', 8);
            $table->string('address', 100);
            $table->string('complement')->nullable();
            $table->string('district', 100);
            $table->string('city', 100);
            $table->string('state', 2);
            $table->string('cellular', 11);
            $table->string('email', 100);
            $table->enum('status', ['A', 'I'])->default('A');
            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
