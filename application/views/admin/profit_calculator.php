<h2>Calculator</h2>
<a href="<?=site_url('admin/tools');?>"> << Back to Tools </a>
<div>
	<h3>Product Profits</h3>

<?php
	$this->load->library('table');
	$this->table->set_heading(
		'Product ID', 
		'Product Name', 
		'Cost Per Product', 
		'Price Per Product',
		'Quantity', 
		'Total Cost',
		'Total Price',
		'Gross Margin',
		'Markup',
		'Gross Profit');


	foreach($products as $p){

		$this->table->add_row(
					$p->id, 
					$p->name, 
					"$".$p->cost, 
					"$".$p->price, 
					$p->qty, 
					"$".$p->total_cost,
					"$".$p->total_price,
					"%".$p->margin,
					"%".$p->markup,
					"$".$p->profit);

	}
	echo $this->table->generate();

?>
</div>

<div>
	<h3>Margin Calculator</h3>
	<p>Calculate the gross margin percentage, mark up percentage and gross profit of a sale from the cost and revenue, or selling price, of an item.</p>
<?php
	if(isset($calculator)){
		if(is_string($calculator)){
			echo '<p><strong>'.$calculator.'</strong></p>';
		}else{
				$this->load->library('table');
				$this->table->set_heading('Gross Margin', 'Markup', 'Gross Profit');
				$this->table->add_row(
					"% ".number_format($calculator['margin'], 2, '.', ''),
					"% ".number_format($calculator['markup'], 2, '.', ''),
					"$ ".number_format($calculator['profit'], 2, '.', ''));
				echo $this->table->generate();
		}
	}
	
	$this->load->helper('form');
	
	echo form_open('admin/profit_calculator');

	echo form_label('Cost: $ ', 'cost');
	echo form_input(array(
			'name' => 'cost',
			'class' => 'form-control',
			'type' => 'numeric',
			'required' => 'required'
		));
		
	echo '</br>';

	echo form_label('Price: $ ', 'price');
	echo form_input(array(
			'name' => 'price',
			'class' => 'form-control',
			'type' => 'numeric',
			'required' => 'required'
		));

	echo '</br>';

	echo form_submit('submit', 'Calculate');

	echo form_close();

?>
</div>