<?php
	$this->load->view('layout/header'); 
	echo "<h1>ADMIN</h1>";
	$this->load->view($view, $data);
	$this->load->view('layout/footer');

?>