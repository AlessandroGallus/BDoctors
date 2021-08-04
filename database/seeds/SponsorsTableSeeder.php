<?php

use Illuminate\Database\Seeder;
use App\Sponsor;
class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['basic','silver', 'gold', 'platinum'];
        $levels = [1, 2, 3, 4];
        $duration = [0, 24, 72, 144];
        $price = [0, 2.99 , 5.99, 9.99];

        for($i=0;$i<4;$i++){
            $new_sponsor = new Sponsor();
            $new_sponsor->id = $i+1;
            $new_sponsor->sponsor_level = $levels[$i];
            $new_sponsor->price = $price[$i];
            $new_sponsor->name = $names[$i];
            $new_sponsor->duration = $duration[$i];
            $new_sponsor->save();
        }
    }
}
