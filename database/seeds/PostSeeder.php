<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Model\Category;
use App\Model\Post;
use App\User;

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
            $randomUser = User::inRandomOrder()->first();
            $newPost->title = $faker->sentence(3,true);
            $newPost->author = $randomUser->name;
            $newPost->content = $faker->paragraph(5,true);
            $newPost->slug = Str::slug($newPost->title."-" . $i ,"-");
            $newPost->image = $faker->imageUrl(640, 480, 'post', true);;
            $newPost->user_id = $randomUser->id;
            $newPost->category_id = Category::inRandomOrder()->first()->id;
            $newPost->save();
        }
    }
}
