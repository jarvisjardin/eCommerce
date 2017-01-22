<a href="<?=site_url('admin/products');?>"> << Back to Products List </a>
<?php
	$this->load->helper('form');
?>
<div class="products">
	
<?php
	
	if($method != 'admin/delete_product'){

		if($method == 'admin/edit_product'){
			echo form_open('admin/edit_product/'.$product->id);
			echo form_hidden('id', $product->id);
	
		}else{
			echo form_open('admin/add_product');
		}
		
			echo form_label('Name: ', 'name');
			echo form_input('name', isset($product) ? $product->name : '' , 'required');
			echo '<br>';
			
			echo form_label('Price: ', 'price');
			echo form_input('price', isset($product) ? $product->price : '', 'required');
			echo '<br>';
		
			echo form_label('Qty: ', 'qty');
			echo form_input('qty', isset($product) ? $product->qty : '', 'required');
			echo '<br>';

			echo form_label('Cost: ', 'cost');
			echo form_input('cost', isset($product) ? $product->cost : '', 'required');
			echo '<br>';

			
			echo '<a href="'.site_url('admin/products').'">Cancel</a>';
			echo '&nbsp&nbsp&nbsp';
		
			echo form_submit('submit', isset($product) ? 'Save' : 'Add');
		
			echo form_close();
	}else{
		echo form_open('admin/delete_product/'.$product->id);
		echo 'Are you sure you want to delete "'.$product->name.'"?';
		echo '<br>';
		echo form_label('Please check "YES" to confirm: ', 'confirm');
		echo form_checkbox('confirm', 'YES', FALSE, 'required');
		echo '<br>';
		echo '<br>';
		echo '<br>';

		echo '<a href="'.site_url('admin/products').'">Cancel</a>';
		echo '&nbsp&nbsp&nbsp';
		echo form_submit('submit', 'DELETE');
	}	
	
	

?>
	
</div>
