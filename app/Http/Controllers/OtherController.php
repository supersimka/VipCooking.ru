<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;
use App\Repositories\OtherRepository;
use App\Repositories\RecipeRepository;
use App\Repositories\CatalogRepository;

class OtherController extends Controller
{
	protected $otherRepo;
	protected $recipeRepo;

	public function __construct(OtherRepository $otherRepo, RecipeRepository $recipeRepo)
  {
        $this->otherRepo = $otherRepo;
				$this->recipeRepo = $recipeRepo;
  }

	//Ключевые слова
	public function keywords($slug)
	{
			$keyword = $this->otherRepo->get_slug('cook_keywords',$slug); //DB::table('cook_keywords')->where('alias',$slug)->first();

			if(empty($keyword))  return view('recipe');
			else
			 	return view('keywords', ['title' => $keyword->title, 'recipes' => $this->recipeRepo->get_recipes_key($keyword->id)]);
	}

	//Продукты
	public function products($slug)
	{
			$product = $this->otherRepo->get_slug('cook_products',$slug); //DB::table('cook_products')->where('alias',$slug)->first();

			if(empty($product))  return view('recipe');
			else
			 	return view('products', ['title' => $product->title,'recipes' => $this->recipeRepo->get_recipes_product($product->id)]);
	}

	//Ajax
	public function getSection(Request $request,CatalogRepository $catalogRepo)
	{
		$id = $request->input('id');

		return view('ajax.getSections',  ['array' => $catalogRepo->get_child_categories($id)]);
	}

}
