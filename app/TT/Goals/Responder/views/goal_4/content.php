<?php 
$data = $this->data;
echo 
$helper->tag('main') .
$helper->tag('section',['id'=>'service','class'=>'home-section text-center']) .
	$helper->tag('div',['class'=>'container']) .
	$helper->tag('div',['class'=>'heading-about']) .
	$helper->tag('div',['class'=>'row col-lg-6 col-lg-offset-3 col-sm-12']) .
	$helper->tag('h2') . $data['positive_behavior']['val'] . $helper->tag('/h2') .
	$helper->tag('i',['class'=>'fa fa-2x fa-angle-down']) . $helper->tag('/i') .
	$helper->tag('/div') .
	$helper->tag('/div') .
	$helper->tag('div',['class'=>'row col-lg-6 col-lg-offset-3 col-sm-12']).
	
	$helper->tag('div',['class'=>'intro-goal']) . $data['goal_4_intro'] . $helper->tag('/div') .
	
	$helper->tag('div') . '&nbsp;' .$helper->tag('/div') ; ?>
		<table class="table-responsive table">
		<tr><?php
		if($this->goal){?>
			<td><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button></td>
			<td><?php echo $data['goal_4_positive'] ; ?></td><?php
		}
		else{?>
			<td><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td>
			<td><?php echo $data['goal_4_negative']  ; ?></td><?php
		}	?>
		</tr>
		</table>
		<div id="perf_div"></div><?php
echo $this->lavaInfraction->render('ColumnChart', 'Infraction', 'perf_div');
	
	
				
		echo
		//$helper->tag('/div') .

		//show table 
			
		$helper->tag('div',['id'=>'dispData','class'=>'container-fluid']) ; 

		if(count($this->infractions)>1){?>
		
		<table class="table table-bordered sttable table-condensed">
			<thead>
				<tr><?php
					echo '<th style="vertical-align:bottom">' . $data['date_of_infraction']['val'] . '</th>';
					echo '<th style="vertical-align:bottom">' . $data['type_of_infraction']['val'] . '</th>';
					echo '<th style="vertical-align:bottom">' . $data['staff_name']['val'] . '</th>';
					echo '<th style="vertical-align:bottom">' . $data['comments']['val'] . '</th>';
					
					
					?>				       
        		</tr>
			</thead>
			<tbody >
                <?php               
                    foreach( $this->infractions as $infraction ) { 
                        echo '<tr>';
                       
                            echo '<td style="text-align:left; vertical-align:middle">'. $infraction->date_of_infraction .'</td>';
                       		echo '<td style="text-align:left; vertical-align:middle">'.$infraction->type_of_infraction .'</td>';
							echo '<td style="text-align:left; vertical-align:middle">'. $infraction->staff_name .'</td>';
                       		echo '<td style="text-align:left; vertical-align:middle">'. $infraction->comments .'</td>';
						echo '<tr>';
                    }?>
        	</tbody>
    	</table> <?php 
	}
	echo			
	$helper->tag('/div') .

	$helper->tag('/div') .
$helper->tag('/section') .
$helper->tag('/main') ;
