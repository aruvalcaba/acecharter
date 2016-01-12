<?php
$data = $this->data;

echo 
$helper->tag('main') .
	$helper->tag('section',['id'=>'service','class'=>'home-section text-center']) .
		$helper->tag('div',['class'=>'container']) .  
			$helper->tag('h2') . $data['activites'] . $helper->tag('/h2') .
            $helper->tag('div',['class'=>'row p-b-15']) . $helper->a('/activity/create', $data['upload_activity'] , array('class'=>'btn btn-large btn-danger')) . $helper->tag('/div') .
            $helper->tag('div',['class'=>'row p-b-15']) . $helper->a('/roster/upload', $data['upload_roster'] , array('class'=>'btn btn-large btn-danger')) . $helper->tag('/div');


include (sprintf('%s/views/base/%s',app_path(),'alerts.php'));

echo
$helper->tag('div',['class'=>'table-responsive','style'=>'margin-top: 15px']) .
    $helper->tag('table',['class'=>'table table-striped table-bordered','style'=>'margin-top: 15px']) .
        $helper->tag('tr').
            $helper->tag('td') . 'Teacher' . $helper->tag('/td') .
            $helper->tag('td') . 'Number of students in classroom' . $helper->tag('/td') .
        $helper->tag('/tr');
/**
		$helper->tag('tr') .
			$helper->tag('td') . 'Title' . $helper->tag('/td'). 
			$helper->tag('td') . 'Avg. Rating' . $helper->tag('/td').
			$helper->tag('td') . '% Fun for Q1' . $helper->tag('/td').
			$helper->tag('td') . '% Appropriate for Q2' . $helper->tag('/td').
			$helper->tag('td') . '% Parents who finished this activity' . $helper->tag('/td').
			$helper->tag('td') . 'Actions' . $helper->tag('/td');
$helper->tag('/tr') ;
**/
if(count($this->teacherData) > 0 ) {
    foreach($this->teacherData as $row) {
        echo $helper->tag('tr') .
				$helper->tag('td') . $row['teacherLastName'] . $helper->tag('/td') .
				$helper->tag('td') . $row['studentCount'] . $helper->tag('/td') .	
			 $helper->tag('/tr') ;
    }
}
echo
	$helper->tag('/table') .
$helper->tag('/div') .
$helper->tag('/div') .
$helper->tag('/section') .
$helper->tag('/main') ;
