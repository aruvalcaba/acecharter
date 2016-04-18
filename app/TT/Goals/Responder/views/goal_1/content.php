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
		$helper->tag('/div') .
		$helper->tag('/div') .
	
	$helper->tag('div',['class'=>'row col-lg-4 col-lg-offset-4 col-sm-8 col-sm-offset-2']).
		

	$helper->tag('div',['class'=>'intro-goal']) . $data['goal_1_intro'] . $helper->tag('/div') .

	$helper->tag('div',['class'=>'row']) . '&nbsp;' .$helper->tag('/div') ;
	

		 ?>
		<table class="table-responsive table">
		<tr> <?php
		if($this->goal){?>
			<td><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button></td>
			<td><?php echo $data['goal_1_positive'] ; ?> </td> <?php
		}
		else{?>
			<td><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td>
			<td><?php echo $data['goal_1_negative']  ; ?> </td> <?php
		}		
	
				
		?>
		</tr>
		</table><?php echo
		
		$helper->tag('div',['class'=>'row']) . '&nbsp;' .$helper->tag('/div') .
		//show table 
		$helper->tag('div',['class'=>'row']) .		
		$helper->tag('div',['id'=>'dispData','class'=>'container-fluid']) ; 

		if(count($this->academicGoals)>0){?>
		
		<table class="table table-bordered sttable table-condensed">
			<thead>
				<tr><?php
					echo '<th style="vertical-align:bottom">' . $data['course']['val'] . '</th>';
					echo '<th style="vertical-align:bottom">' . $data['grade']['val'] . '</th>';
					echo '<th style="vertical-align:bottom">' . $data['percentage']['val'] . '</th>';
					echo '<th style="vertical-align:bottom">' . $data['teacher']['val'] . '</th>';
					echo '<th style="vertical-align:bottom">' . $data['last_update']['val'] . '</th>';
					
					?>				       
        		</tr>
			</thead>
			<tbody >
                <?php               
                    foreach( $this->academicGoals as $academicGoal ) { 
                        echo '<tr>';
                       
                            echo '<td style="text-align:left; vertical-align:middle">'. $academicGoal->course .'</td>';
                       		echo '<td style="text-align:left; vertical-align:middle">'.$academicGoal->grade .'</td>';
							echo '<td style="text-align:left; vertical-align:middle">'. $academicGoal->percentage .'</td>';
                       		echo '<td style="text-align:left; vertical-align:middle">'. $academicGoal->teacher_name .'</td>';
							echo '<td style="text-align:left; vertical-align:middle">'. $academicGoal->last_update .'</td>';
							
                        echo '<tr>';
                    }?>
        	</tbody>
    	</table> <?php 
	}
	echo

	
	$helper->tag('/div') . 

	$helper->tag('/div') .
	$helper->tag('/div') .	
	$helper->tag('/div') .
$helper->tag('/section') .
$helper->tag('/main') ;
