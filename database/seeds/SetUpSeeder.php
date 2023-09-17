<?php

use App\Models\Bank;
use App\Models\Championship;
use App\Models\Family;
use App\Models\Group;
use App\Models\Member;
use App\Models\Nationality;
use App\Models\Refree;
use App\Models\Region;
use App\Models\Salary;
use App\Models\Session;
use App\Models\Status;
use App\Modules\Category\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SetUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->faker = Faker::create();

        $records = [];
        $list = ['لاعب','مشرف','أخصائى','مدرب 13','مدرب 15','مدرب 17','مدرب 20',
        'مدرب أول','مساعد مدرب','إدارى','محترف','مدلك','مصور','مدرب','مدرب الفريق الاول'
        ];
        Category::query()->truncate();
        foreach ($list as $item){
            $records[]=['name'=>$item];
        }
        Category::query()->insert($records);


        $records = [];
        $list = ['كويتي','مصرى','سعودي','قطري'];
        Nationality::query()->truncate();
        foreach ($list as $item){
            $records[]=['name'=>$item];
        }
        Nationality::query()->insert($records);


        $records = [];
        Salary::query()->truncate();
        $levelList = ['دولي','أولي','ثانية','ثالثة'];
        $typeList = ['مراقبة','أرضي','طاولة'];
        $salaryList = ['12000','15000','20000','25000','35000'];
        for($i=1;$i<13;$i++){
            foreach($levelList as $level){
                foreach($typeList as $type){
                    $records[] = [
                        'date'=>date('Y')."-".$i,
                        'level'=>$level,
                        'type'=>$type,
                        'value'=>$salaryList[rand(0,4)]
                    ];
                }
            }
        }
        Salary::query()->insert($records);




        $records = [];
        $list = ['الدورى','كاس الاتحاد','كاس السوبر','البطولة الخليجية للاندية',
        'البطولة الخليجية للمنتخبات','البطولة العربية للاندية',
        'البطولة العربية للمنتخبات',' 3x3 ','درع الاتحاد','درع الوزارات','كاس الوزارات',
        'كاس 13','كاس 15','كاس 17','كاس 19'
        ];
        Championship::query()->truncate();
        foreach ($list as $item){
            $records[]=['name'=>$item];
        }
        Championship::query()->insert($records);

        $records = [];
        $list = ['معار','غير نشط','موقوف','نشط'];
        Status::query()->truncate();
        foreach ($list as $item){
            $records[]=['name'=>$item];
        }
        Status::query()->insert($records);

        $records = [];
        $list = [
            'العربى الرياضي','التضامن الرياضى','الجهراء الرياضى'
            ,'الساحل الرياضى','الشباب الرياضى',
            'الصليبخات الرياضي','القادسية الرياضي','الكويت الرياضي',
            'النصر الرياضي','اليرموك الرياضي','النصر الرياضي',
            'نادي القرين','نادى برقان'
        ];
        Family::query()->truncate();
        foreach ($list as $item){
            $records[]=['name'=>$item];
        }
        Family::query()->insert($records);

        $records = [];
        $list = [
            'تحت 13','تحت 15','تحت 17','تحت 19','الدرجه الأولى'
        ];
        Group::query()->truncate();
        foreach ($list as $item){
            $records[]=['name'=>$item];
        }
        Group::query()->insert($records);

        $records = [];
        $list = [
            '2022-2023','2021-2022','2020-2021'
        ];
        Session::query()->truncate();
        foreach ($list as $item){
            $records[]=['name'=>$item];
        }
        Session::query()->insert($records);

        $records = [];
        $list = [
            'الاهلى','الكويت الوطنى','الكويت الدولى'
        ];
        Bank::query()->truncate();
        foreach ($list as $item){
            $records[]=['name'=>$item];
        }
        Bank::query()->insert($records);

        $records = [];
        Refree::query()->truncate();
        for ($i=0;$i<10;$i++){
            $records[]=[
                'name'=>$this->faker->name,
                'degree'=>$this->faker->text('10'),
                'iban'=>$this->faker->iban,
                'idnum'=>$this->faker->regexify('09[0-9]{12}'),
                'account_number'=>$this->faker->bankAccountNumber,
                'bank_id'=>Bank::inRandomOrder()->take(1)->first()->id,
            ];
        }
        Refree::query()->insert($records);

        $records = [];
        $list = [
            'مهاجم','وسط','مدافع'
        ];
        Region::query()->truncate();
        foreach ($list as $item){
            $records[]=['name'=>$item];
        }
        Region::query()->insert($records);

        $records = [];
        Member::query()->truncate();
        for ($i=0;$i<50;$i++){
            $records[]=[
                'name'=>$this->faker->name,
                'playernum'=>$this->faker->numberBetween(1, 100),
                'category_id'=>Category::inRandomOrder()->take(1)->first()->id,
                'family_id'=>Family::inRandomOrder()->take(1)->first()->id,
                'status_id'=>Status::inRandomOrder()->take(1)->first()->id,
                'region_id'=>Region::inRandomOrder()->take(1)->first()->id,
                'session_id'=>Session::inRandomOrder()->take(1)->first()->id,
                'group_id'=>Group::inRandomOrder()->take(1)->first()->id,
                'nationality_id'=>Nationality::inRandomOrder()->take(1)->first()->id,
                'mobile1'=>$this->faker->phoneNumber,
                'mobile2'=>'',
                'idnum'=>$this->faker->regexify('09[0-9]{12}'),
                'note'=>'',
                'idnum_expirerd_date'=>'',
                'passport'=>'',
                'passport_expirerd_date'=>'',
                'birth_date'=>$this->faker->date,
                'register_date'=>$this->faker->date,

            ];
        }
        Member::query()->insert($records);

        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
