<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository
{
   public $date;

   public function __construct()
   {
       $this->date = date('Y-m-d');
   }

   public function get_slug($table,$slug)
   {
     $result = DB::table($table)->where('alias',$slug)->first();
     if(!empty($result->id)) return $result;
     else return false;
   }
}
