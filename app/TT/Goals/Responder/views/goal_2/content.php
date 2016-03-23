<?php 
$data = $this->data;
echo 
$helper->tag('main') .
$helper->tag('section',['id'=>'service','class'=>'home-section text-center']) .
	$helper->tag('div',['class'=>'container']) .
	$helper->tag('div',['class'=>'heading-about']) .
	$helper->tag('div',['class'=>'row col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2']) .
	$helper->tag('h2') . $data['daily_attendance']['val'] . $helper->tag('/h2') .
	$helper->tag('i',['class'=>'fa fa-2x fa-angle-down']) . $helper->tag('/i') .

	
	$helper->tag('div',['class'=>'intro-goal']) . $data['goal_2_intro'] . $helper->tag('/div') .

	$helper->tag('div') . '&nbsp;' .$helper->tag('/div') .
	

		$helper->tag('div',['class'=>'row']) ;
		if($this->goal){?>
			<button type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button> <?php
			echo $data['goal_2_positive'] ;
		}
		else{?>
			<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button> <?php
			
			echo $data['goal_2_negative']  ;
		}		
	
				
		echo
		$helper->tag('/div') .

				
	$helper->tag('/div') .
	$helper->tag('/div') .	
	$helper->tag('/div') .
$helper->tag('/section') .
$helper->tag('/main') ;
