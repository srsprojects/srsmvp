<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecyclablePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('recyclable_prices', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ["depositor","agent","rider","collection-hub"]);
            $table->foreignId('recyclable_type_id')->constrained();
            $table->float('price_per_kg', 13, 2)->default('0.00');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recyclable_prices');
    }
}
