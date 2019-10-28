<?php
namespace App\Services;
use Symfony\Component\DomCrawler\Crawler;

Class CinemaUpdateService{
	private $url;
	private $html;
	
	private function clearEmpty(array $mas)
	{
		$resDate = array();
		foreach ($mas as $key => $itemDate) 
		{
			if(is_array($itemDate)){
				foreach ($itemDate as $key => $value) {
					if($value)
						$resDate[] = $value;
				}
			}
		}
		return $resDate;
	}

	public function setUrl($url)
	{
		$this->url = $url;
	}

	public function getHtml()
	{
		$html = file_get_contents('https://cityopen.ru/afisha/kinoteatr-salavat');
    	$this->html = new Crawler($html);
	}

	public function getCinemaData()//получить данные из таблиц с расписанием
	{
		$data = $this->html->filter('.td-page-content table')->each(function (Crawler $node, $i) 
    	{
    		$arr = '';
		    if(count($node->filter('tr'))>1)
		    {
		    	$arr = $node->filter('tr')->each(function(Crawler $tr, $k)
		    	{
		    		$temp = [];
		    		for($z=0;$z<count($tr->filter('td'));$z++)
		    		{
		    			$temp[$z] = $tr->filter('td')->eq($z)->text();
		    			$array[$z] = $temp[$z];
		    		}
		    		return $array;
		    	});		    	
		    }
		    return $arr;
		});

		$res = array();
    	foreach ($data as $key => $itemHall) 
    	{    		
    		if(is_array($itemHall))
    		{
    			foreach($itemHall as $tey => $itemCinema)
    			{
    				$count = 0;
    				foreach ($itemCinema as $dey => $itemData) 
    				{
    					if(!empty($itemData))
    						$count+=1; 					
    				}
    				if($count==4)
    					$res[$key][$tey] = $itemCinema;
    			}
    		}
    	}
    	$res = array_values( $res );
		return $res;
	}

	public function getCinemaDate()//получить дни из расписания
	{
		$data = $this->html->filter('.td-page-content table')->each(function (Crawler $node, $i) 
    	{
    		$arr = '';
		    if(count($node->filter('tr'))==1)
		    {
		    	$arr = $node->filter('tr')->each(function(Crawler $tr, $k)
		    	{		    	
		    		$temp = [];
		    		if(count($tr->filter('td'))>1)
		    		{   
			    		for($z=0;$z<count($tr->filter('td'));$z++)
			    		{
			    			$temp[$z] = $tr->filter('td')->eq($z)->text();
			    			$array = $temp[$z];
			    		}
			    		return $array;
			    	}
		    	});		    	
		    }
		    return $arr;
		});	
		return $this->clearEmpty($data);	
	}
}