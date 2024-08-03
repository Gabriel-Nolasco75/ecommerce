<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingcartTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('shoppingcart', function (Blueprint $table) {
            $table->string('identifier', 191);
            $table->string('instance', 191);
            $table->longText('content');
            $table->nullableTimestamps();
            
            $table->primary(['identifier', 'instance']);
            
            $table->engine = 'InnoDB'; // Asegúrate de usar un motor que soporte índices grandes
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop(config('cart.database.table'));
    }
}
