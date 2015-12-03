<?php
$alerts = $this->alerts;
$alert_class = $alerts['class'];
$alert_messages = $alerts['messages'] ;

echo 
$helper->tag('div',$alert_class) .
	$helper->a('#','&times', array('class'=>'close','data-dismiss'=>'alert')) .
	$helper->tag('ul') ;
		foreach($alert_messages as $message){
			echo $helper->tag('li') .
				$message .
			$helper->tag('/li') ;
		}		
	echo $helper->tag('/ul') .
$helepr->tag('/div') ;
