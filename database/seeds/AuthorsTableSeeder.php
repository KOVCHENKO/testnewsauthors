<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('authors')->insert([
            'name' => "ХантерТомпсон",
            'rating' => 4.0
        ]);
		DB::table('authors')->insert([
			'name' => "ВенедиктЕрофеев",
			'rating' => 5.0
		]);
		DB::table('authors')->insert([
			'name' => "ВильямБерроуз",
			'rating' => 2.0
		]);
		DB::table('authors')->insert([
			'name' => "ВикторПелевин",
			'rating' => 5.0
		]);
		DB::table('authors')->insert([
			'name' => "ВладимирСорокин",
			'rating' => 5.0
		]);
    }
}
