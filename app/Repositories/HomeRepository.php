<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class HomeRepository extends BaseRepository
{
  public function get_homepage()
  {
    return DB::table('cook_recipes')->limit(30)->orderby('id','DESC')->get();
  }

   public function get_info()
   {
     $info = [
 		'categories' => DB::table('cook_categories')->where('visible','1')->orderby('id')->get(),
 		'keywords' => DB::table('cook_keywords')->limit(30)->get(),
 		'products' => DB::table('cook_products')->limit(20)->get()];

     return $info;
   } 
}
