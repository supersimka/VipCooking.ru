<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
	public $date;
	public $general;

	public function __construct()
    {
		//Общая информация о сайте
		$this->general = [
		'categories' => DB::table('cook_categories')->where('visible','1')->orderby('id')->get(),
		'keywords' => DB::table('cook_keywords')->limit(30)->get(),
		'products' => DB::table('cook_products')->limit(20)->get()];
    }

    //Главная страница
	public function homepage()
    {
		    $localInfo = ['recipes' => DB::table('cook_recipes')->limit(30)->orderby('id','DESC')->get()];
		    return view('homepage', array_merge($this->general, $localInfo));
    }

	//Каталог рецептов
	public function catalogtParent()
    {
		    $localInfo = ['recipes' => DB::table('cook_recipes')->limit(30)->orderby('id','DESC')->get()];
		    return view('catalog', array_merge($this->general, $localInfo));
    }

    //Разделы рецептов
  	public function catalog($slug)
      {
        $catalog = DB::table('cook_categories')->where('alias',$slug)->first();
        if(empty($catalog))  return view('recipe', $this->general);
        else
        {
    		    $localInfo = [
              'title' => $catalog->title,
              'recipes' =>
                DB::table('cook_recipes')
                ->join('cook_categories', 'cook_categories.id', '=', 'cook_recipes.id_categories')
                ->select('cook_recipes.*')
                ->where('cook_categories.alias',$slug)
                ->limit(30)
                ->orderby('id','DESC')
                ->get(),
              'child_categories' =>
                 DB::table('cook_child_categories')
                 ->join('cook_categories', 'cook_categories.id', '=', 'cook_child_categories.id_parent')
                 ->select('cook_child_categories.*')
                 ->where('cook_categories.alias',$slug)
                 ->limit(30)
                 ->get(),
               ];

  		      return view('catalog', array_merge($this->general, $localInfo));
        }
      }

  //Дочерняя категория
  public function catalogClild($slug)
    {
      $catalogChild = DB::table('cook_child_categories')->where('cook_child_categories.alias',$slug);
      if(empty($catalogChild->first()))  return view('recipe', $this->general);
      else
      {
      $localInfo = [
      'title' => $catalogChild->first()->title,
      'category' =>
        $catalogChild->join('cook_categories', 'cook_categories.id', '=', 'cook_child_categories.id_parent')
        ->select('cook_categories.*')
        ->first(),
      'recipes' =>
        $catalogChild
        ->join('cook_recipes', 'cook_child_categories.id', '=', 'cook_recipes.id_child_categories')
        ->select('cook_recipes.*')
        ->orderby('id','DESC')
        ->paginate(30)
      ];

      return view('catalogChild', array_merge($this->general, $localInfo));
      }
    }

    //Ключевые слова
    public function keywords($slug)
      {
        $keyword = DB::table('cook_keywords')->where('alias',$slug)->first();

        if(empty($keyword))  return view('recipe', $this->general);
        else
        {
          $localInfo = [
          'title' => $keyword->title,
          'recipes' =>
            DB::table('cook_recipes')
            ->join('cook_bundle_keys', 'cook_bundle_keys.cook_recipe_id', '=', 'cook_recipes.id')
            ->select('cook_recipes.*')
            ->where('cook_bundle_keys.cook_keyword_id',$keyword->id)
            ->orderby('id','DESC')
            ->paginate(30)
          ];

          return view('keywords', array_merge($this->general, $localInfo));
        }
      }

      //Продукты
      public function products($slug)
        {
          $product = DB::table('cook_products')->where('alias',$slug)->first();

          if(empty($product))  return view('recipe', $this->general);
          else
          {

            $localInfo = [
            'title' => $product->title,
            'recipes' =>
              DB::table('cook_recipes')
              ->join('cook_bundle', 'cook_bundle.cook_recipe_id', '=', 'cook_recipes.id')
              ->select('cook_recipes.*')
              ->where('cook_bundle.cook_product_id',$product->id)
              ->orderby('id','DESC')
              ->paginate(30)
            ];

            return view('products', array_merge($this->general, $localInfo));
          }
        }

	//Рецепт
	public function recept($alias)
    {
		    $recipe = DB::table('cook_recipes')->where('cook_recipes.alias',$alias);

        if(empty($recipe->first()))  return view('recipe', $this->general);
        else
        {
		      $localInfo = [
          'title' => $recipe->first()->title,
      		'recipe' => $recipe
      		->leftJoin('cook_categories', 'cook_recipes.id_categories', '=', 'cook_categories.id')
      		->leftJoin('cook_child_categories', 'cook_recipes.id_child_categories', '=', 'cook_child_categories.id')
      		->select('cook_recipes.*', 'cook_categories.title AS c_title', 'cook_categories.alias AS c_alias', 'cook_child_categories.title AS cc_title', 'cook_child_categories.alias AS cc_alias')
      		->first(),
          'keywords' => DB::table('cook_bundle_keys')
          ->join('cook_keywords', 'cook_keywords.id', '=', 'cook_bundle_keys.cook_keyword_id')
          ->select('cook_keywords.*')
          ->where('cook_bundle_keys.cook_recipe_id',$recipe->first()->id)
          ->orderby('id','ASC')
          ->get(),
          'r_products' => DB::table('cook_bundle')
          ->join('cook_products', 'cook_products.id', '=', 'cook_bundle.cook_product_id')
          ->select('cook_products.*')
          ->where('cook_bundle.cook_recipe_id',$recipe->first()->id)
          ->orderby('id','ASC')
          ->get(),
          'analogs' => DB::table('cook_recipes')
          ->where('bundle_text',$recipe->first()->bundle_text)
          ->where('id','<>',$recipe->first()->id)
          ->limit(12)
          ->orderby('id','DESC')
          ->get(),
          'other' => DB::table('cook_recipes')
          ->where('bundle_text','<>',$recipe->first()->bundle_text)
          ->where('id_child_categories',$recipe->first()->id_child_categories)
          ->limit(12)
          ->orderby('id','DESC')
          ->get()
      		];

		      return view('recipe', array_merge($this->general, $localInfo));
        }
    }

    //Ajax
    public function getSection(Request $request)
    {
      $id = $request->input('id');

      return view('ajax.getSections',  ['array' => DB::table('cook_child_categories')->where('id_parent',$id)->orderby('id','ASC')->get()]);
    }

    //Поиск
  	public function search(Request $request)
      {
        $text = $request->input('query');
        $category = $request->input('category');
        $product = $request->input('product');
        $section = $request->input('section');

        $recipes = DB::table('cook_recipes');
        if(!empty($text)) $recipes = $recipes->where('title', 'like', "%$text%");
        if(!empty($category)) $recipes = $recipes->where('id_categories', $category);
        if(!empty($section)) $recipes = $recipes->where('id_child_categories', $section);
        if(!empty($product)) $recipes = $recipes->join('cook_bundle', 'cook_recipes.id', '=', 'cook_bundle.cook_recipe_id')->whereIn('cook_product_id', $product);

        $localInfo = [
          'title' =>__('messages.search_query').' '.$text,
          'product' => $product,
          'recipes' => $recipes->paginate(30)
        ];

        return view('search', array_merge($this->general, $localInfo));
      }

      //Разделы верхнего уровня
      public function receptParent()
        {
          $recipe = DB::table('cook_recipes')->orderby('id','DESC')->paginate(30);

          if(empty($recipe))  return view('recipe', $this->general);
          else
          {
  		      $localInfo = [
            'title' => __('messages.recipes'),
            'recipes' => $recipe
        		];
  		      return view('recipes', array_merge($this->general, $localInfo));
          }
        }

}
