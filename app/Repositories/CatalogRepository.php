<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class CatalogRepository extends BaseRepository
{
  public function get_child_categories($id)
  {
    return 	DB::table('cook_child_categories')->where('id_parent',$id)->orderby('id','ASC')->get();
  }

  public function get_child_categories_slug($slug)
  {
    return 	DB::table('cook_child_categories')->where('cook_child_categories.alias',$slug);
  }

  public function get_category($catalogChild)
  {
    return 	$catalogChild->join('cook_categories', 'cook_categories.id', '=', 'cook_child_categories.id_parent')
    ->select('cook_categories.*')
    ->first();
  }

  public function get_category_recipe($catalogChild)
  {
    return 	$catalogChild->join('cook_recipes', 'cook_child_categories.id', '=', 'cook_recipes.id_child_categories')
    ->select('cook_recipes.*')
    ->orderby('id','DESC')
    ->paginate(30);
  }
}
