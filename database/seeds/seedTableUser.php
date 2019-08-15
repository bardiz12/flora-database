<?php

use App\User;
use Illuminate\Database\Seeder;

class seedTableUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email'=>'admin@gondang.id',
            'password'=>bcrypt('12345678'),
            'name'=>'Moch. Bardizba Z'
        ]);
    }
}
