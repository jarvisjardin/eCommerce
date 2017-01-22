<div id="container">
	<a href="<?=site_url('admin');?>"> << Back to Dashboard </a>
	<h2>Manage Products</h2>
	<a href="<?=site_url('admin/add_product');?>"> + Add Product </a>

	<?php
		foreach($products as $product){
	?>
			<div class="products">
				<h3>Name: <?=$product->name;?></h3>
				<p>ID: <?=$product->id;?></p>
				<p>Price: $<?=$product->price;?></p>
				<p>Qty: <?=$product->qty;?></p>
				<p>Cost: $<?=$product->cost;?></p>

				<a href="<?php echo site_url('product/'.$product->id)?>">view</a>
				|
				<a href="<?php echo site_url('admin/edit_product/'.$product->id)?>">edit</a>
				|
				<a href="<?php echo site_url('admin/delete_product/'.$product->id)?>">delete</a>

			</div>
	<?php	
		}
	?>
	</div>
</div>


