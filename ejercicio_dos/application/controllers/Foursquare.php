<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foursquare extends CI_Controller {
	private $foursquare = null;

	public function __construct()
	{
		parent::__construct();
		$this->foursquare = new FoursquareApi(FOURSQUARE_CLIENT_ID, FOURSQUARE_CLIENT_SECRET);
	}

	public function index()
	{
		$cat_arr 	= array(); 
		$cat_arr['main_categories'][0] = "Todas las categorias"; 
		
		$endpoint 	= "venues/categories";		
		$params 	= array("near"=>"Montreal, Quebec");
		#$response = $foursquare->GetPublic($endpoint,$params);
		$response 	= $this->foursquare->GetPublic($endpoint);
		$cat 		= ( json_decode( $response ) );
		#print_r( $cat->response->categories);

		foreach ($cat->response->categories as $number => $subarray) {
			foreach ($subarray as $key => $value) {
				if($key == 'shortName'){
					$cat_arr['main_categories'][$subarray->id] = $value;
				}
			}
		}
		$data['title']   = 'BLOG';
		$data['content'] = 'foursquare/index'; 
		$data['info']	 =  $cat_arr;
		$this->load->view('frame/content_all', $data);
	}

	public function get_venues()
	{
		$resultset 		= array();
		$categorie_id 	= $this->input->post('categorie_id');
		$endpoint 		= "venues/search";	
		if($categorie_id!='0'){
			$params 	= array("near"=>"Mexico, City", /*"limit"=>15,*/ "categoryId" => $categorie_id);
		}else{
			$params 	= array("near"=>"Mexico, City", /*"limit"=>15*/);
		}
		$response 		= $this->foursquare->GetPublic($endpoint, $params);
		$venues 		= ( json_decode( $response ) );
		
		foreach( $venues->response->venues AS $key_l1 => $value_l1 ){
			$photo          = $this->foursquare->GetPublic("venues/{$value_l1->id}/photos", ["limit" => 1]);
			$res_photo 		= ( json_decode( $photo ) );
			$photo_prefix = isset($res_photo->response->photos->items[0]->prefix)?$res_photo->response->photos->items[0]->prefix:''; 
			$photo_suffix = isset($res_photo->response->photos->items[0]->suffix)?$res_photo->response->photos->items[0]->suffix:'';
			$resultset[$key_l1]['id'] 		 = $value_l1->id; 
			$resultset[$key_l1]['name'] 	 = $value_l1->name;
			$resultset[$key_l1]['categorie'] = $value_l1->categories[0]->shortName; 
			if($photo_prefix!='' && $photo_suffix!=''){
				$resultset[$key_l1]['photo'] = $photo_prefix."250x100".$photo_suffix;
			}else{
				$resultset[$key_l1]['photo'] = '';
			}	
		}
		$data['result'] = $resultset;
		$this->load->view('foursquare/show_results', $data);
	}

}
