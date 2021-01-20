<?php

use Illuminate\Database\Seeder;
use App\Ceg;
class DayTimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (Ceg::find(1) == null){
           DB::table('cegs')->insert([
                'id' => 1,
                'user_id' => 1,
                'cegnev' => 'base ceg',
                'note' => 'Ehhez tartoznak az alapértékek amiket minden cég használ pl.: daytype, timetype'
            ]);

            $daytipes = [
                ['Munkanap', 'alapértelmezés',true],
                ['Szabadnap', 'Szombat'],
                ['Pihenőnap', 'vasárnap'],
                ['Szabadság', ''],
                ['Betegállomány', ''],
                ['Ledolgozás', '',true],
                ['Ledolgozott nap', ''],   
                ['Igazolt távollét', ''],
                ['Kiküldetés', '',true]
            ];
            foreach ($daytipes as $daytipe) {
                $workday=$daytipe[2] ?? false;
                DB::table('daytypes')->insert([
                    'ceg_id' => 1,
                    'name' => $daytipe[0],
                    'workday' => $workday,
                    'note' => $daytipe[1]
                ]);
            };

    $timetypes = [
                ['Normál', 'alapértelmezés'],
                ['délután', 'Szombat'],
                ['éjszaka', 'vasárnap'],
                ['délelőtt', ''],
                ['délutáni túlóra', ''],
                ['éjszakai túlóra', ''],
                ['túlóra', ''],
                ['Ledolgozás', ''],
                ['Ledolgozott nap', ''],   
                ['Igazolt távollét', ''],
                ['Kiküldetés', '']
            ];
            foreach ($timetypes as $timetype) {
                DB::table('timetypes')->insert([
                'ceg_id' => 1,
                    'name' => $timetype[0],
                    'note' => $timetype[1],
                ]);
            };
      }else{return true;}
   
    }
    
}
