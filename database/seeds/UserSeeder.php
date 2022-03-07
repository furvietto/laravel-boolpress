<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $newUser = new User();
        $newUser->name = 'Admin';
        $newUser->email = 'fulvio-94@hotmail.it';
        //creo una stringa da usare per accedere come passeword
        $string = '12345678';
        //la cripto per salvarla in db
        $newUser->password = Hash::make($string);
        $newUser->save();
        for ($i = 0; $i < 5; $i++) {
            $newUser = new User();
            $newUser->name = $faker->name();
            $newUser->email = $faker->email();
            
            //creo una stringa da usare per accedere come passeword
            $string = '12345678';
            //la cripto per salvarla in db
            $newUser->password = Hash::make($string);
            $newUser->save();
        }
    }
}
