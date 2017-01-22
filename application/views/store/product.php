<a href="<?=site_url();?>"> << Back to Products </a>
<p><?=$message;?> </p>
<div class="products">
	<h1><?=$product->name;?></h1>
	<h2>Price: $<?=$product->price;?></h2>
	
	
	<a href="<?php echo site_url('purchase/'.$product->id)?>">Buy Now</a>
</div>
