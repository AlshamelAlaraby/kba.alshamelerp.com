<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('settings')->truncate();
        DB::table('settings')->insert([

            [ 'key' => 'name', 'name' =>'اسم المنشأة', 'value'=>'اتحاد السلة الكويتي'],
            [ 'key' => 'address', 'name' =>'العنوان', 'value'=>'مركز البدرشين - محافظة الجيزة'],
            [ 'key' => 'mobile', 'name' =>'ارقام التليفونات', 'value'=>'01061048481-01032845319'],
            [ 'key' => 'max_allowed_users', 'name' =>'اقصى عدد مستخدمين', 'value'=>'5'],
            [ 'key' => 'logo', 'name' =>'اللوجو', 'value'=>''],
            [ 'key' => 'MAIL_FROM_NAME', 'name' =>'MAIL FROM NAME', 'value'=>'CRM'],
            [ 'key' => 'MAIL_FROM_ADDRESS', 'name' =>'MAIL FROM ADDRESS', 'value'=>'no-reply@crm.com'],
            [ 'key' => 'MAIL_MAILER', 'name' =>'MAIL MAILER', 'value'=>'smtp'],
            [ 'key' => 'MAIL_ENCRYPTION', 'name' =>'MAIL ENCRYPTION', 'value'=>'tls'],
            [ 'key' => 'MAIL_HOST', 'name' =>'MAIL HOST', 'value'=>'email-smtp.eu-west-1.amazonaws.com'],
            [ 'key' => 'MAIL_USERNAME', 'name' =>'MAIL USERNAME', 'value'=>'Ashraf'],
            [ 'key' => 'MAIL_PASSWORD', 'name' =>'MAIL PASSWORD', 'value'=>'BEm6FiG0YfhAl9Y'],
            [ 'key' => 'MAIL_PORT', 'name' =>'MAIL PORT', 'value'=>'123'],
            ]);
    }
}
