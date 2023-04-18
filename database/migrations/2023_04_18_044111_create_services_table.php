<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('en_Service_Name');
            $table->string('fr_Service_Name');
            $table->string('start_data')->nullable();
            $table->string('end_data')->nullable();   $table->string('location')->nullable();
            $table->string('Service_image')->nullable();
            $table->string('en_Description')->nullable();
            $table->string('fr_Description')->nullable();
            $table->integer('Status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
