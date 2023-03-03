<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Repositories\RecipeRepository;

class SearchController extends Controller
{
	protected $recipeRepo;

	public function __construct(RecipeRepository $recipeRepo)
  {
				$this->recipeRepo = $recipeRepo;
  }

	//Поиск
	public function search(Request $request)
	{
			$text = $request->input('query');
			$category = $request->input('category');
			$product = $request->input('product');
			$section = $request->input('section');

			$localInfo = [
				'title' =>__('messages.search_query').' '.$text,
				'product' => $product,
				'recipes' => $this->recipeRepo->get_recipe_search($text,$category,$section,$product)
			];

			return view('search', $localInfo);
	}

}
