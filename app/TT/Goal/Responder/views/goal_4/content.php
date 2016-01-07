<?php 
$data = $this->data;
echo 
$helper->tag('main') .
$helper->tag('section',['id'=>'service','class'=>'home-section text-center']) .
	$helper->tag('div',['class'=>'container']) .
	$helper->tag('div',['class'=>'heading-about']) .
	$helper->tag('div',['class'=>'row col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2']) .
	$helper->tag('h2') . $data['academic_success']['val'] . $helper->tag('/h2') .
	$helper->tag('i',['class'=>'fa fa-2x fa-angle-down']) . $helper->tag('/i') .
	
				$helper->tag('div',['class'=>'intro-goal']) . $data['goal_4_detail'] . $helper->tag('/div') .
				$helper->tag('div',['class'=>'intro-goal']) . $data['goal_4_detail_2'] . $helper->tag('/div') .
				
			$helper->tag('/div') .
	$helper->tag('/div') .	
	$helper->tag('/div') .
$helper->tag('/section') .
$helper->tag('/main') ;
