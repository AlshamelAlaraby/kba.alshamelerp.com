<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->text('value')->nullable();
            $table->timestamps();
        });
        DB::table('settings')->insert([
            [ 'key' => 'name', 'name' =>'اسم المنشأة', 'value'=>'الإتحاد الكويتي لكرة السلة'],
            [ 'key' => 'address', 'name' =>'العنوان', 'value'=>'Kuwait Basketball Association'],
            [ 'key' => 'mobile', 'name' =>'ارقام التليفونات', 'value'=>'01061048481-01032845319'],
            [ 'key' => 'logo', 'name' =>'اللوجو', 'value'=>'']
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
