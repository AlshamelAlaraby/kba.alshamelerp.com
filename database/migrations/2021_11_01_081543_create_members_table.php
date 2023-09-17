<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('nationality', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('playernum');
            $table->string('mobile1')->nullable();
            $table->string('mobile2')->nullable();
            $table->string('idnum')->nullable();
            $table->string('idnum_expirerd_date')->nullable();
            $table->string('passport')->nullable();
            $table->string('passport_expirerd_date')->nullable();
            $table->string('email')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('register_date')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('family_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('nationality_id');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('family_id')->references('id')->on('family')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('nationality_id')->references('id')->on('nationality')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('from_id');
            $table->unsignedBigInteger('to_id');
            $table->foreign('player_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('from_id')->references('id')->on('family')->onDelete('cascade');
            $table->foreign('to_id')->references('id')->on('family')->onDelete('cascade');
            $table->date('start');
            $table->date('end');
            $table->string('filenumber')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('escalation', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('from_id');
            $table->unsignedBigInteger('to_id');
            $table->foreign('player_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('from_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('to_id')->references('id')->on('groups')->onDelete('cascade');
            $table->text('note')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });


        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('refrees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('degree')->nullable();
            $table->string('idnum')->nullable();
            $table->string('account_number')->nullable();
            $table->string('iban')->nullable();
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
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
        Schema::dropIfExists('members');
        Schema::dropIfExists('status');
        Schema::dropIfExists('regions');
        Schema::dropIfExists('family');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('loans');
        Schema::dropIfExists('nationality');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('refrees');
        Schema::dropIfExists('banks');
    }
}
