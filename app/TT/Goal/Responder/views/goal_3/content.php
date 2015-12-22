<?php 
$data = $this->data;
echo 
$helper->tag('main') .
$helper->tag('section',['id'=>'service','class'=>'home-section']) .
	$helper->tag('div',['class'=>'container']) .


$helper->tag('div',['class'=>'']) .
				$helper->tag('p',['class'=>'booktext']) . $data['goal_3_detail'] . $helper->tag('/p') .
				$helper->tag('p',['class'=>'booktext']) . $data['goal_3_detail_2'] . $helper->tag('/p') .
				
			$helper->tag('/div') .
	$helper->tag('/div') .
$helper->tag('/section') .
$helper->tag('/main') ;
