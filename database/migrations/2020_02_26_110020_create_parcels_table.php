<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('description');
            $table->string('Receiver_name');
            $table->string('Receiver_num_Tel');
            $table->float('Distance');

            $table->string('date');
            $table->integer('status');
            $table->float('cost');
            $table->string('starting_adresse');
            $table->string('destination_adresse');

            $table->decimal('starting_longitude', 10, 7);
            $table->decimal('starting_latitude', 10, 7);
            $table->decimal('destination_longitude', 10, 7);
            $table->decimal('destination_latitude', 10, 7);
      
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('delivery_man_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('parcels');
    }
}
