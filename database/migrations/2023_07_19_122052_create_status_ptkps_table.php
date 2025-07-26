<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPtkpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_ptkps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('ptkp_2016', 15, 2)->default(0);
            $table->decimal('ptkp_2015', 15, 2)->default(0);
            $table->decimal('ptkp_2009_2012', 15, 2)->default(0);
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
        Schema::dropIfExists('status_ptkps');
    }
}
