<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupPlayersMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable()->after('club2_id');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->json('players1')->nullable()->after('club2_id');
            $table->json('players2')->nullable()->after('club2_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {Schema::table('matches', function (Blueprint $table) {
        $table->dropForeign('matches_group_id_foreign');
        $table->dropColumn(['group_id','players1','players2']);
    });
    }
}
