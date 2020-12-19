<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Home',
			'menu' => 'home',
			'breadcumb' => [
				'<i class="fas fa-home"></i> Home'
			]
		];
		return view('home/index', $data);
	}

	//--------------------------------------------------------------------

}
