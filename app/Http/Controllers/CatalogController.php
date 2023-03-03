<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\CatalogRepository;
use App\Repositories\RecipeRepository;

class CatalogController extends Controller
{
	private $catalogRepo;
	private $recipeRepo;

	public function __construct(CatalogRepository $catalogRepo,RecipeRepository $recipeRepo)
  {
		$this->catalogRepo = $catalogRepo;
		$this->recipeRepo = $recipeRepo;
  }

	//Каталог рецептов
	public function catalogtParent()
  {
		 return view('catalog', ['recipes' => $this->recipeRepo->get_recipes_params(30)]);
  }

  //Разделы рецептов
  public function catalog($slug)
  {
      $catalog = $this->catalogRepo->get_slug('cook_categories',$slug);
      if(empty($catalog))  return view('recipe');
      else
      {
    		  $info = [
            'title' => $catalog->title,
            'recipes' => $this->recipeRepo->get_recipes_category($slug),
            'child_categories' => $this->catalogRepo->get_child_categories($catalog->id)
          ];

  		    return view('catalog', $info);
      }
  }

  //Дочерняя категория
  public function catalogClild($slug)
  {
      $catalogChild = $this->catalogRepo->get_child_categories_slug($slug);
      if(empty($catalogChild->first()))  return view('recipe');
      else
      {
		      $localInfo = [
		      'title' => $catalogChild->first()->title,
		      'category' => $this->catalogRepo->get_category($catalogChild),
		      'recipes' => $this->catalogRepo->get_category_recipe($catalogChild)
		      ];

      	return view('catalogChild', $localInfo);
      }
  }

  //Разделы верхнего уровня
  public function receptParent()
  {
      $recipe = $this->recipeRepo->get_recipes_desc();

      if(empty($recipe))  return view('recipe');
      else return view('recipes', ['title' => __('messages.recipes'),'recipes' => $recipe]);
   }

	 //Рецепт
	 public function recept($alias)
   {
 		   $recipe = $this->recipeRepo->get_recipe($alias);

       if(empty($recipe->first()))  return view('recipe');
       else
       {
 		      $localInfo = [
          'title' => $recipe->first()->title,
       		'recipe' => $this->recipeRepo->get_recipe_add($recipe),
           'keywords' => $this->recipeRepo->get_recipe_keys($recipe->first()->id),
           'r_products' => $this->recipeRepo->get_recipe_products($recipe->first()->id),
           'analogs' => $this->recipeRepo->get_recipe_analogs($recipe),
           'other' => $this->recipeRepo->get_recipe_other($recipe)
       		];

 		      return view('recipe', $localInfo);
       }
   }
}
