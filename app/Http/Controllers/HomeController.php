<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\HomeRepository;

class HomeController extends Controller
{
	public $date;

    //Главная страница
	public function homepage(HomeRepository $homeRepo)
  {
		  return view('homepage', ['recipes' => $homeRepo->get_homepage()]);
  }
	
}
