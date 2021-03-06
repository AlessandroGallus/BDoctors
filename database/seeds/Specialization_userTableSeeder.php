<?php

use App\Specialization;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Specialization_userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
    
        $users = User::all();
        
        foreach ($users as $user) {
            DB::table('specialization_user')->insert([
                'user_id'=>$user['id'],
                'specialization_id'=>rand(1,50)
            ]);
        }
    }
}
