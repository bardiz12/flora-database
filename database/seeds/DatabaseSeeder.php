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
        $this->call([
            seedTableFamily::class,
            seedTableKategori::class,
            seedTableStatus::class,
            seedTableFlora::class,
            seedTableUser::class
            ]);
    }
}
