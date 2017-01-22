	<h2>Analytics</h2>
	<a href="<?=site_url('admin/tools');?>"> << Back to Tools </a>

<div>
	<h3>All Sales</h3>

<?php
	$this->load->library('table');
	$this->table->set_heading('Sale ID', 'Product Name', 'Amount','Quantity' );


	foreach($all_sales as $s){

		$this->table->add_row($s->sales_id, $s->name, $s->amount, $s->sales_qty);

	}
	echo $this->table->generate();

?>

	<h3>Product Sales</h3>
<?php
	$this->load->library('table');
	$this->table->set_heading('Product ID', 'Product Name', 'Quantity Sold','Total Amount');


	foreach($product_sales as $p){

		$this->table->add_row($p->product_id, $p->name, $p->qty, $p->total);

	}
	echo $this->table->generate();

?>	
</div>