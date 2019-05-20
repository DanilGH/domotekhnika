<?php

use App\News;
use Faker\Factory;
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
        $faker = Factory::create();
        News::query()->truncate();

        foreach (range(1, 100) as $i) {
            $text = $faker->text;
            $news = News::create([
                'title' => $faker->realText(20),
                'text' => $text,
                'short_text' => $text,
                'date_publish' => $faker->dateTime,
                'status' => $faker->randomElement([1, 0]),
                'image_file_name' => $faker->image()
            ]);
        }
    }
}
