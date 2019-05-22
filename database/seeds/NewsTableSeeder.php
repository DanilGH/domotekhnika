<?php

use App\Domain\News\News;
use Illuminate\Database\Seeder;

use Faker\Factory;

class NewsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        //News::query()->truncate();

        foreach (range(1, 100) as $i) {
            $text = $faker->text;
            $news = News::create([
                'title' => $faker->title,
                'text' => $text,
                'short_text' => $text,
                'date_publish' => $faker->dateTime,
                'status' => $faker->randomElement([1, 0]),
                'image_file_name' => $faker->image()
            ]);
        }
    }
}
