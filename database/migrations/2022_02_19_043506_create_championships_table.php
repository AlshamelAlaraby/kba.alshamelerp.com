<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChampionshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('championships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->unsignedBigInteger('championship_id');
            $table->string('level')->nullable();
            $table->string('type')->nullable();
            $table->string('score_sheet_num')->nullable();
            $table->string('registrar_name')->nullable();
            $table->string('registrar_assistant')->nullable();
            $table->string('timer')->nullable();
            $table->string('timer24')->nullable();
            $table->unsignedBigInteger('referee1_id')->nullable();
            $table->unsignedBigInteger('referee2_id')->nullable();
            $table->unsignedBigInteger('referee3_id')->nullable();
            $table->unsignedBigInteger('referee4_id')->nullable();
            $table->text('note')->nullable();
            $table->foreign('championship_id')->references('id')->on('championships')->onDelete('cascade');
            $table->foreign('referee1_id')->references('id')->on('refrees')->onDelete('cascade');
            $table->foreign('referee2_id')->references('id')->on('refrees')->onDelete('cascade');
            $table->foreign('referee3_id')->references('id')->on('refrees')->onDelete('cascade');
            $table->foreign('referee4_id')->references('id')->on('refrees')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('level')->nullable();
            $table->string('type')->nullable();
            $table->string('value')->nullable();
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
        Schema::dropIfExists('salaries');
        Schema::dropIfExists('matches');
        Schema::dropIfExists('championships');
    }
}
