<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StoreController extends CI_Controller {

	
	public function index(){
		$this->display_products();
	}
	
	public function display_products(){
		
		$this->load->model('Store');

		$products = $this->Store->get_products();

		$data = array(
			'view'	=> 'store/index',
			'data'	=> array('products' => $products),
			'message' => '',
		);
		
		
		$this->load->view('layout/page', $data);
	}

	public function product_view($id){
		$this->load->model('Store');

		$product = $this->Store->get_product($id);

		$data = array(
			'view'	=> 'store/product',
			'data'	=> array('product' => $product[0]),
			'message' => '',
			
		);
		
		$this->load->view('layout/page', $data);
	}
	
	public function purchase_product($id){
		$this->load->model('Store');

		$product = $this->Store->get_product($id);
		
		$this->Store->purchase_product($product[0]);
		

		$data = array(
			'view'	=> 'store/product',
			'data'	=> array(
						'product' => $product[0],
						'message' => 'You have purchased:'.$product[0]->name,
					)
		);
		
		$this->load->view('layout/page', $data);
	}

}
