<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Book;

class booksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 0; $i <= 10; $i++){
            Book::insert([
                'title' => $faker->sentence,
                'writer' => $faker->name, 
                'summary' => $faker->text,
                'price' => $faker->randomNumber(3),
                'photo' => $faker->imageUrl(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        $this->command->info('add books!');
    }
}
