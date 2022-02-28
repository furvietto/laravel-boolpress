<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Model\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 50 ; $i++) { 
            $newPost = new Post();
            $newPost->title = $faker->sentence(3,true);
            $newPost->author = $faker->words(3,true);
            $newPost->content = $faker->paragraph(5,true);
            $newPost->slug = Str::slug($newPost->title."-" . $i ,"-");
            $newPost->save();
        }
    }
}
