<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class OtherRepository extends BaseRepository
{
  /*
  public function get_slug($table,$slug)
  {
    $result = DB::table($table)->where('alias',$slug)->first();
    if(!empty($result->id)) return $result;
    else return false;
  }
  */
}
