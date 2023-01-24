<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Article;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
  
class ArticleFactory extends Factory
{ 
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
		
		$factory->define(Article::class, function (Faker $faker) {
			$tags = collect(['php', 'ruby', 'java', 'javascript', 'bash'])
				->random(2)
				->values()
				->all();
			return [
				'title' => $faker->sentence(),
				'body' => $faker->text(),
				'tags' => $tags,
			];
		}); 
    }
}
