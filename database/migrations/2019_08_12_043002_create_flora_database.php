<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFloraDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flora', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('family_id');
            $table->string('locale_name');
            $table->longtext('images')->nullable();
            $table->string('scientific_name')->nullable();
            $table->integer('kategori_id')->nullable();
            $table->string('endemik')->nullable();
            $table->boolean('status_uu_id')->default(false)->nullable();
            $table->integer('status_iucn_id')->nullable();
            $table->integer('status_cites_id')->nullable();
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
        Schema::dropIfExists('flora_database');
    }
}
