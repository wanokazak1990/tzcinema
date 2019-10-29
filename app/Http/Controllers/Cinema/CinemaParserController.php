<?php

namespace App\Http\Controllers\Cinema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;
//models
use App\Cinema;
use App\Services\CinemaUpdateService;

class CinemaParserController extends Controller
{
	public $service;
	public function __construct(CinemaUpdateService $service)
	{
		$this->service = $service;
	}

    public function update()
    {
    	$todayCinemas = Cinema::truncate();

    	$this->service->setUrl('https://cityopen.ru/afisha/kinoteatr-salavat');
    	$this->service->getHtml();
    	$data = $this->service->getCinemaData();
    	$date = $this->service->getCinemaDate();

    	foreach ($data as $hall => $value) {
    		$hallNumber = ($hall%2)+1;
    		$seansDate = $date[0];
    		if($hall>=2)
    		{
    			$seansDate = $date[1];
    		}
    		foreach ($value as $key => $data) 
    		{
    			$cinema = new Cinema([
	    			'seans_time' => $data[0],
	    			'name' => $data[1],
	    			'years' => $data[2],
	    			'price' => $data[3],
	    			'room' => $hallNumber,
	    			'seans_date' => $seansDate
	    		]);
	    		$cinema->save();
    		}
    	}
    }
}

