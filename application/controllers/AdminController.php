<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	
	public function index(){
		//needs login access
		$this->dashboard();
	}
	
	public function dashboard(){
		$data = array(
			'view'	=> 'admin/dashboard',
			'data'	=> ''
		);
		$this->load->view('admin/page', $data);

	}
	
	public function products(){
		$this->load->model('Store');

		$products = $this->Store->get_products();

		$data = array(
			'view'		=> 'admin/products',
			'data'		=> array('products' => $products)
		);
		
		
		$this->load->view('admin/page', $data);
	}
	
	public function edit_product($id){

		$this->load->model('Store');
		
		
		if(!empty($_POST)){
			$data = array(
				'name'	=> $_POST['name'],
				'price'	=> $_POST['price'],
				'qty'	=> $_POST['qty'],
				'cost'	=> $_POST['cost']
			);
			
			$this->Store->update_product($id, $data);
			
			$this->products();

		}else{
	
			$product = $this->Store->get_product($id);
	
			$data = array(
				'view'		=> 'admin/product',
				'data'		=> array(
							'product' => $product[0],
							'method'	=> 'admin/edit_product',
						)
			);
			
			$this->load->view('admin/page', $data);
		}
	}
	
	public function add_product(){

		$this->load->model('Store');
		
		if(!empty($_POST)){
			$data = array(
				'name'	=> $_POST['name'],
				'price'	=> $_POST['price'],
				'qty'	=> $_POST['qty'],
				'cost'	=> $_POST['cost']

			);
			
			$this->Store->add_product($data);
			
			$this->products();

		}else{
	
			$data = array(
				'view'	=> 'admin/product',
				'data'		=> array(
							'method'	=> 'admin/add_product',
						)
			);
			
			$this->load->view('admin/page', $data);
		}
	}

	public function delete_product($id){
		$this->load->model('Store');
		
		if(!empty($_POST)){

			$this->Store->delete_product($id);

			$this->products();

		}else{
			$product = $this->Store->get_product($id);

			$data = array(
				'view'	=> 'admin/product',
				'data'		=> array(
							'method'	=> 'admin/delete_product',
							'product' => $product[0],
						)
			);
			
			$this->load->view('admin/page', $data);
		}	
	}
	
	public function tools(){

		$data = array(
			'view'	=> 'admin/tools',
			'data'	=> ''
		);
		$this->load->view('admin/page', $data);

	}
	
	public function profit_calculator(){

		if(!empty($_POST)){
			if(is_numeric($_POST['cost']) && is_numeric($_POST['price'])){
				$calculator = $this->calculate_margin_markup_profit($_POST['cost'],$_POST['price']);
			}else{
				$calculator = "Numbers Only!";
			}
/*
			$data = array(
				'name'	=> $_POST['name'],
				'price'	=> $_POST['price'],
				'qty'	=> $_POST['qty'],
				'cost'	=> $_POST['cost']
			);
			
			$this->Store->update_product($id, $data);
			
			$this->products();
	
*/		}


		$this->load->model('Store');
		$products = $this->Store->get_products();

		foreach($products as $key => $p){
			$total_cost = $p->cost * $p->qty;
			$total_price = $p->price * $p->qty;

			$calculations = $this->calculate_margin_markup_profit($total_cost,$total_price);		
			
			$products[$key]->total_cost = number_format($total_cost, 2, '.', '');
			$products[$key]->total_price = number_format($total_price, 2, '.', '');
			$products[$key]->profit = number_format($calculations['profit'], 2, '.', '');
			$products[$key]->markup = number_format($calculations['markup'], 2, '.', '');
			$products[$key]->margin = number_format($calculations['margin'], 2, '.', '');
		}	
		
			
		
		$data = array(
			'view'	=> 'admin/profit_calculator',
			'data'	=> array(
						'products' => $products
					)
		);
		
		if(isset($calculator)){
			$data['data']['calculator'] = $calculator;
		}
		
		$this->load->view('admin/page', $data);

	}
	
	public function calculate_margin_markup_profit($cost,$price){
		$profit = $price - $cost;
		$markup = ($profit / $cost) * 100;
		$margin = ($profit / $price)* 100;	
		
		return array('margin' => $margin, 'markup' => $markup, 'profit' => $profit);
	}

	public function analytics(){
		$this->load->model('Store');

		$all_sales = $this->Store->sales();
		$product_sales = $this->Store->product_sales();
		
		$data = array(
			'view'	=> 'admin/analytics',
			'data'	=> array( 
					'all_sales'		=> $all_sales,
					'product_sales'	=> $product_sales
				)
		);
		$this->load->view('admin/page', $data);

	}
}
