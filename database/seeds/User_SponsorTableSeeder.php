<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Sponsor;
class User_SponsorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $sponsors = Sponsor::all();

        foreach ($users as $user) {
            DB::table('user_sponsor')->insert([
                'user_id'=>$user['id'],
                'sponsor_id'=>rand(1,4),
                'expiring_date'=>date('Y-m-d H:i:s')
            ]);
    }
}
}