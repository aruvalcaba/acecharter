<?php
$data = $this->data;

echo 
$helper->tag('main') .
	$helper->tag('section',['class'=>'home-section text-center']) .
	$helper->tag('div',['class'=>'container wow bounceInDown','data-wow-delay'=>'2s']) .
		$helper->tag('div',['class'=>'row']) . $helper->tag('h2') . $h('Create Activity') . $helper->tag('/h2') . $helper->tag('/div') .
		$helper->tag('div',['class'=>'col-xs-6 col-xs-offset-3 panel panel-admin']) .
			$helper->tag('div',['class'=>'row']) . $helper->label($data['title_label']['val'])->before($helper->input($data['title_input'])) . $helper->tag('/div') .
			$helper->tag('div',['class'=>'row']) . $helper->label($data['activity_label']['val'])->before($helper->input($data['activity_input'])) . $helper->tag('/div') .	
			$helper->tag('div',['class'=>'row']) . $helper->label($data['description_label']['val'])->before($helper->input($data['description_input'])) . $helper->tag('/div') .		
			$helper->tag('div',['class'=>'row']) . $helper->label($data['time_label']['val'])->before($helper->input($data['time_input'])) . $helper->tag('/div') .
			$helper->tag('div',['class'=>'row']) . $helper->input($data['create_btn']) . $helper->tag('/div') .
		$helper->tag('/div') .			
	$helper->tag('/div') .
	$helper->tag('/section') .
$helper->tag('/main') ;
