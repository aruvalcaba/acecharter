<?php
$data = $this->data;

echo 
$helper->tag('main') .
	$helper->tag('section',['id'=>'service','class'=>'home-section text-center']) .
		$helper->tag('div',['class'=>'container']) .  
			$helper->tag('h2') . $data['activites'] . $helper->tag('/h2') .
			$helper->a('/activity/create', $data['upload_activity'] , array('class'=>'btn btn-large btn-danger')) ;

include (sprintf('%s/views/base/%s',app_path(),'alerts.php'));

echo
$helper->tag('div',['class'=>'table-responsive','style'=>'margin-top: 15px']) .
	$helper->tag('table',['class'=>'table table-striped table-bordered','style'=>'margin-top: 15px']) .
		$helper->tag('tr') .
			$helper->tag('td') . 'Title' . $helper->tag('/td'). 
			$helper->tag('td') . 'Avg. Rating' . $helper->tag('/td').
			$helper->tag('td') . '% Fun for Q1' . $helper->tag('/td').
			$helper->tag('td') . '% Appropriate for Q2' . $helper->tag('/td').
			$helper->tag('td') . '% Parents who finished this activity' . $helper->tag('/td').
			$helper->tag('td') . 'Actions' . $helper->tag('/td');
		$helper->tag('/tr') ;
if(count($this->activities) > 0 ) {
    foreach($this->activities as $activity) {
		$rating = $activity->avgRating();	
		$deleteString = "'".$activity->id."'".",'activity','".$activity->title."'";
        echo $helper->tag('tr',['id'=>$activity->title]) .
				$helper->tag('td') . $activity->title . $helper->tag('/td') .
				$helper->tag('td') . $rating . $helper->tag('/td') .	
        		$helper->tag('td') . $activity->q1Percent() . $helper->tag('/td') .
				$helper->tag('td') . $activity->q2Percent() . $helper->tag('/td') .
				$helper->tag('td') . $activity->finishedPercent() . $helper->tag('/td') .
				$helper->tag('td') . $helper->a(URL::route('activity.edit',[$activity->id]), 'Edit' , array('class'=>'btn btn-warning')) . $helper->a('#','Delete',array('data-token'=>csrf_token(),'class'=>'btn btn-danger','style'=>'margin-left: 15px', 'onclick'=>destroy('.$deleteString.'))) . $helper->tag('/td>') .
			$helper->tag('/tr') ;
    }
}
echo
	$helper->tag('/table') .
$helper->tag('/div') .
$helper->tag('/div') .
$helper->tag('/section') .
$helper->tag('/main') ;
