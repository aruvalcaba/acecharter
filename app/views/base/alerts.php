<?php
$alerts = $this->alerts;
$alert_class = $alerts['class'];
$alert_messages = $alerts['messages'] ;

echo 
$helper->tag('div',['class'=> $alert_class]) .
>>>>>>> b36600a... alert file
	$helper->a('#','&times', array('class'=>'close','data-dismiss'=>'alert')) .
	$helper->tag('ul') ;
		foreach($alert_messages as $message){
			echo $helper->tag('li') .
				$message .
			$helper->tag('/li') ;
		}		
	echo $helper->tag('/ul') .
$helepr->tag('/div') ;
