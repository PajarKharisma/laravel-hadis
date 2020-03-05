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
        ini_set('memory_limit','2048M');
        // $this->call(UsersTableSeeder::class);
        $this->call(AhmadTableSeeder::class);
        $this->call(AnnasaiTableSeeder::class);
        $this->call(BukhariTableSeeder::class);
        $this->call(IbnumajahTableSeeder::class);
        $this->call(MalikTableSeeder::class);
        $this->call(MuslimTableSeeder::class);
        $this->call(TirmidziTableSeeder::class);
    }
}
