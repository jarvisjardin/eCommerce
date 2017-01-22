<div id="container">
	<h1>Welcome to The Store!</h1>

	<div id="body">
	<p> Check out our products below! </p>
	<h2>Products</h2>
	<?php
		foreach($products as $product){
	?>
			<div class="products">
				<h4><?=$product->name;?>:  <span>$<?=$product->price;?></span></h4>
				<a href="<?php echo site_url('product/'.$product->id)?>">view product</a>

			</div>
	<?php	
		}
	?>
	</div>
</div>


