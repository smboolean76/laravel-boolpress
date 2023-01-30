<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // cancello tutti i dati della tabella Posts
        Post::truncate();

        for( $i = 0; $i < 10; $i++ ) {
            $category = Category::inRandomOrder()->first();

            $new_post = new Post();
            $new_post->title = $faker->sentence();
            $new_post->content = $faker->text(1000);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->category_id = $category->id;
            $new_post->save();
        }
    }
}
