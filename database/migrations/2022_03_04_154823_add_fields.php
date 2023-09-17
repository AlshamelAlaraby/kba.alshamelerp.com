<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imglookups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::table('family', function (Blueprint $table) {
            $table->string('gender')->default('رجالى')->after('name');
        });
        Schema::table('matches', function (Blueprint $table) {
            $table->unsignedBigInteger('club1_id')->after('note');
            $table->unsignedBigInteger('club2_id')->after('note');
            $table->foreign('club1_id')->references('id')->on('family')->onDelete('cascade');
            $table->foreign('club2_id')->references('id')->on('family')->onDelete('cascade');
        });
        Schema::create('matches_players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matche_id');
            $table->unsignedBigInteger('player_id');
            $table->foreign('matche_id')->references('id')->on('matches')->onDelete('cascade');
            $table->foreign('player_id')->references('id')->on('members')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::table('members', function (Blueprint $table) {
            $table->string('gender')->default('ذكر')->nullable()->after('mobile2');
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->string('active_num')->nullable()->after('name');
            $table->string('esclation_num')->nullable()->after('name');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imglookups');
        Schema::dropIfExists('matches_players');

        Schema::table('matches', function (Blueprint $table) {
            $table->dropForeign('matches_club1_id_foreign');
            $table->dropForeign('matches_club2_id_foreign');
            $table->dropColumn(['club1_id','club2_id']);
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn(['active_num','esclation_num']);
        });
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
        Schema::table('family', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
    }
}
