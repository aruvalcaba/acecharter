<?php
$data = $this->data;

echo 
$helper->tag('main') .
$helper->tag('section',['id'=>'service','class'=>'home-section text-center']) .
	$helper->tag('div',['class'=>'container wow bounceInDown','data-wow-delay'=>'2s']) .
		$helper->tag('div',['class'=>'row']) . $helper->tag('h2') . $data['changed_pwd'] . $helper->tag('/h2') . $helper->tag('/div') .
	$helper->tag('div',['class'=>'col-xs-6 col-xs-offset-3 panel panel-home']) .
	
		$helper->tag('div',['class'=>'form-group']) .
			$helper->label($data['current_pwd_label']['val']) .
			$helper->input($data['old_pwd_input']) .
		$helper->tag('/div') .
		$helper->tag('div',['class'=>'form-group']) .
			$helper->label($data['new_pwd_label']['val']) .
			$helper->input($data['new_pwd_input']) .
		$helper->tag('/div') .
		$helper->tag('div',['class'=>'form-group']) .
			$helper->label($data['confirm_pwd_label']['val']) .
			$helper->input($data['confirm_pwd_input']) .
		$helper->tag('/div') .
		$helper->tag('div',['class'=>'row']) . 
			$helper->input($data['change_pwd_btn']) . $helper->input($data['cancel_btn']) .
		$helper->tag('/div') .
	$helper->tag('/div') .
	$helper->tag('/div') .
$helper->tag('/section') .
$helper->tag('/main') ;
