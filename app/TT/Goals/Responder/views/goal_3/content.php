<?php 
$data = $this->data;
echo 
$helper->tag('main') .
$helper->tag('section',['id'=>'service','class'=>'home-section text-center']) .
	$helper->tag('div',['class'=>'container']) .
	$helper->tag('div',['class'=>'heading-about']) .
	$helper->tag('div',['class'=>'row col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2']) .
	$helper->tag('h2') . $data['punctuality']['val'] . $helper->tag('/h2') .
	$helper->tag('i',['class'=>'fa fa-2x fa-angle-down']) . $helper->tag('/i') .
	$helper->tag('/div') .
	$helper->tag('/div') .
	$helper->tag('div',['class'=>'row col-lg-4 col-lg-offset-4 col-sm-8 col-sm-offset-2']).
	
	$helper->tag('div',['class'=>'intro-goal']) . $data['goal_3_intro'] . $helper->tag('/div') .
	$helper->tag('div') . '&nbsp;' .$helper->tag('/div') ; ?>
		<table class="table-responsive table">
		<tr><?php
		if($this->goal){?>
			<td><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button></td>
			<td><?php echo $data['goal_3_positive'] ; ?></td><?php
		}
		else{?>
			<td><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td>
			<td><?php echo $data['goal_3_negative']  ; ?></td><?php
		}	?>
		</tr>
		</table>
		<div id="perf_div"></div><?php
echo $this->lavaPunctuality->render('ColumnChart', 'Punctuality', 'perf_div');?>
		
		<?php
	
	
				
		echo
		
				
	$helper->tag('/div') .
	$helper->tag('/div') .	
	$helper->tag('/div') .
$helper->tag('/section') .
$helper->tag('/main') ;
