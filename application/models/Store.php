<?php 
class Store extends CI_Model {

	public function __construct(){
		parent::__construct();
		// Your own constructor code
	}	

	public function get_products(){
		$query = $this->db->get('products');

		return $query->result();
	}
	
	public function get_product($id){
		$query = $this->db->get_where('products', array('id' => $id));
		return $query->result();
	}
	public function update_product($id, $data){
		$this->db->where('id', $id);
		$this->db->update('products', $data);
		
		return true;
	}

	public function add_product($data)
	{
		$this->db->insert('products', $data);
	}	

	public function delete_product($id)
	{
		$this->db->delete('products', array('id' => $id)); 
	}	

	public function purchase_product($data)
	{
		$this->db->insert('sales', array('product_id' => $data->id, 'qty' => 1, 'amount' => $data->price));
	}	

	public function sales(){
		//SELECT product_id,COUNT(*) as count FROM sales GROUP BY product_id ORDER BY count;

		$query = $this->db->query('SELECT `sales`.`id` as sales_id, `products`.name, `sales`.amount, `sales`.qty as sales_qty FROM `sales` LEFT JOIN `products` ON `sales`.`product_id` = `products`.id');

		return $query->result();
	}

	public function product_sales(){

		$query = $this->db->query('SELECT 
										s.product_id,
									    p.name,
									    COUNT(*) as qty,
									    SUM(s.amount) as total
									FROM sales s
									JOIN products p
										ON s.product_id = p.id
									GROUP BY s.product_id
									;
								');

		return $query->result();
	}		
}
?>