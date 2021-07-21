<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(SpecializationsTableSeeder::class);
         $this->call(Specialization_userTableSeeder::class);
         $this->call(MessagesTableSeeder::class);
         $this->call(ReviewsTableSeeder::class);
         $this->call(SponsorsTableSeeder::class);
         $this->call(User_SponsorTableSeeder::class);
    }
}
