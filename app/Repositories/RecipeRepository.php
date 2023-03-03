<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class RecipeRepository extends BaseRepository
{
  private $paginate = 30;

  //базовая
  private function get_recipes()
  {
    return DB::table('cook_recipes')
    ->select('cook_recipes.*')
    ->orderby('id','DESC');
  }

  //рецепты по параметру
  public function get_recipes_params($limit)
  {
    return $this->get_recipes()
    ->limit($limit)
    ->get();
  }

  //рецепты по ключу
  public function get_recipes_key($keyword)
  {
    return $this->get_recipes()
    ->join('cook_bundle_keys', 'cook_bundle_keys.cook_recipe_id', '=', 'cook_recipes.id')
    ->where('cook_bundle_keys.cook_keyword_id',$keyword)
    ->paginate($this->paginate);
  }

  //рецепты по продукту
  public function get_recipes_product($product)
  {
    return 	$this->get_recipes()
    ->join('cook_bundle', 'cook_bundle.cook_recipe_id', '=', 'cook_recipes.id')
    ->where('cook_bundle.cook_product_id',$product)
    ->paginate($this->paginate);
  }

  //рецепты по категории
  public function get_recipes_category($slug)
  {
    return $this->get_recipes()
    ->join('cook_categories', 'cook_categories.id', '=', 'cook_recipes.id_categories')
    ->where('cook_categories.alias',$slug)
    ->limit(30)
    ->get();
  }

  //последние рецепты
  public function get_recipes_desc()
  {
    return $this->get_recipes()->paginate(30);
  }

  //рецепт
  public function get_recipe($slug)
  {
    return DB::table('cook_recipes')->where('cook_recipes.alias',$slug);
  }

  //добавляем остальные поля
  public function get_recipe_add($recipe)
  {
    return $recipe
    ->leftJoin('cook_categories', 'cook_recipes.id_categories', '=', 'cook_categories.id')
    ->leftJoin('cook_child_categories', 'cook_recipes.id_child_categories', '=', 'cook_child_categories.id')
    ->select('cook_recipes.*', 'cook_categories.title AS c_title', 'cook_categories.alias AS c_alias', 'cook_child_categories.title AS cc_title', 'cook_child_categories.alias AS cc_alias')
    ->first();
  }

  //ключевые слова для рецепта
  public function get_recipe_keys($id)
  {
    return DB::table('cook_bundle_keys')
    ->join('cook_keywords', 'cook_keywords.id', '=', 'cook_bundle_keys.cook_keyword_id')
    ->select('cook_keywords.*')
    ->where('cook_bundle_keys.cook_recipe_id',$id)
    ->orderby('id','ASC')
    ->get();
  }

  //продукты для рецепта
  public function get_recipe_products($id)
  {
    return DB::table('cook_bundle')
    ->join('cook_products', 'cook_products.id', '=', 'cook_bundle.cook_product_id')
    ->select('cook_products.*')
    ->where('cook_bundle.cook_recipe_id',$id)
    ->orderby('id','ASC')
    ->get();
  }

  //аналоги
  public function get_recipe_analogs($recipe)
  {
    return DB::table('cook_recipes')
    ->where('bundle_text',$recipe->first()->bundle_text)
    ->where('id','<>',$recipe->first()->id)
    ->limit(12)
    ->orderby('id','DESC')
    ->get();
  }

  //прочее
  public function get_recipe_other($recipe)
  {
    return DB::table('cook_recipes')
    ->where('bundle_text','<>',$recipe->first()->bundle_text)
    ->where('id_child_categories',$recipe->first()->id_child_categories)
    ->limit(12)
    ->orderby('id','DESC')
    ->get();
  }

  //поиск
  public function get_recipe_search($text='',$category='',$section='',$product='')
  {
    $recipes = $this->get_recipes();
    if(!empty($text)) $recipes = $recipes->where('title', 'like', "%$text%");
    if(!empty($category)) $recipes = $recipes->where('id_categories', $category);
    if(!empty($section)) $recipes = $recipes->where('id_child_categories', $section);
    if(!empty($product)) $recipes = $recipes->join('cook_bundle', 'cook_recipes.id', '=', 'cook_bundle.cook_recipe_id')->whereIn('cook_product_id', $product);

    return $recipes->paginate(30);
  }

}
