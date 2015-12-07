<?php

if( Session::has('alerts') ) {
    $alerts = Session::get('alerts');
    $alert_class = $alerts['class'];
    $alert_messages = $alerts['messages'] ;
    echo 
        $helper->tag('div',$alert_class) .
        $helper->tag('button',array('class'=>'close','data-dismiss'=>'alert','aria-lablel'=>'Close')) .
            $helper->tag('span',array('aria-hidden'=>'true')) . '&times;' .$helper->tag('/span') . 
        $helper->tag('/button') .
	    $helper->tag('ul',array('style'=>['text-align: left']));
	
        foreach($alert_messages as $message) {
		    echo $helper->tag('li') . $message . $helper->tag('/li') ;
        }

	    echo $helper->tag('/ul') . $helper->tag('/div') ;
}
