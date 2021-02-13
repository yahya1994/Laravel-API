<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('delivery_man_id');
            $table->unsignedBigInteger('parcel_id');
            $table->foreign('delivery_man_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('parcel_id')
                ->references('id')->on('parcels')
                ->onDelete('cascade');
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
        Schema::dropIfExists('locations');
    }
}
