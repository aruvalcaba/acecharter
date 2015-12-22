<?php
$data = $this->data;
$activities = $this->acts;
echo
$helper->tag('section',['id'=>'service','class'=>'home-section text-center']) .
	$helper->tag('div',['class'=>'container']) .
		$helper->tag('div',['class'=>'heading-about']) .
			$helper->tag('div',['class'=>'row col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2']) .
				$helper->tag('h2') . $data['welcome']['val'] .'&nbsp;' . '&nbsp;' . $h($this->user->first_name) . $helper->tag('/h2') .
				$helper->tag('i',['class'=>'fa fa-2x fa-angle-down']) . $helper->tag('/i') .
			$helper->tag('/div') .
      	$helper->tag('/div') .
	$helper->tag('/div') ;

	 include (sprintf('%s/views/base/%s',app_path(),'alerts.php'));

	//<!-- start of activity box -->

	if(count($activities) > 0 ) {
		foreach($activities as $activity){			
		    $format = '%s%s';
		    $path = sprintf($format,public_path(),$activity->description_url);
					
			echo
			$helper->tag('div',['class'=>'col-lg-6 col-lg-offset-3 alert','role'=>'alert']) .
			$helper->tag('div',['class'=>'activity alert row col-lg-10 col-md-8 col-sm-8 col-lg-offset-1 col-md-offset-2 col-sm-offset-2']) .
		    $helper->tag('div') .
			//<!-- description -->
				$helper->tag('h4') . $data['invitation']['val'] . $helper->tag('/h4') .
				$helper->tag('p') . $data['invitation_conference']['val'] . $helper->tag('/p') ; ?>
				<a href = "<?php echo $path;?>" >
		      	<button type="button" class="btn btn-primary ">	
								
		      		<span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#invitation"></span><?php echo $data['view']['val']; ?> </button></a>
		      		<span style="color:red"><?php echo $activity->title?>
					</span>
		      </button><?php echo

		  	$helper->tag('/div') .
			$helper->tag('/div') .
		       
		$helper->tag('/div') ;
				
		}
	}
?>
<!-- end of activity box -->

  <!--<div class="col-lg-6 col-lg-offset-3 alert" role="alert">
        <div class="activity alert row col-lg-10 col-md-8 col-sm-8 col-lg-offset-1 col-md-offset-2 col-sm-offset-2">
          
          <!-- description -->
   <!--       <div >
        <h4>Invitation</h4>
        
        <p><?php echo $h('Teacher sent you an invitation for a parent teacher conference.'); ?><p>
          <button type="button" class="btn btn-primary ">
          <span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#invitation"></span>&nbsp;View</button>
          <span style="color:red"><?php echo $h('Please read before Tuesday, Aug 28, 2015.'); ?></span>
          </div>

      </div>
           
    </div>-->
<!-- end of activity box -->
<!-- start of activity spacing -->
<div class="row">
      <div class="col-lg-2 col-lg-offset-5">
      </div>
</div>
<!-- end of activity spacing -->

 <!-- start of activity box -->
  <!--<div class="col-lg-6 col-lg-offset-3 alert" role="alert">
        <div class="activity alert row col-lg-10 col-md-8 col-sm-8 col-lg-offset-1 col-md-offset-2 col-sm-offset-2">
          
          <!-- description -->
          <!--<div >
        <h4>MESSAGE</h4>
        
        <p>IEP manager has an update for you.</p>
          <button type="button" class="btn btn-primary ">
  <span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#message"></span>&nbsp;View </button>
          
          </div>

      </div>
           
    </div> -->
<!-- end of activity box -->
<!-- start of activity spacing -->
<div class="row">
      <div class="col-lg-2 col-lg-offset-5">
      </div>
</div>
<!-- end of activity spacing -->

 <!-- start of activity spacing -->
<div class="row">
      <div class="col-lg-2 col-lg-offset-5">
      </div>
</div>
<!-- end of activity spacing -->

 

    <div class="row col-lg-4 col-lg-offset-4 col-sm-8 col-sm-offset-2">     
      <div class="col-lg-2 col-lg-offset-5">
        <hr class="marginbot-30">
      </div>
   
      <h4><?php echo $h($this->user->first_name) . '\'s ' . $data['progress_report']['val'] ; ?> </h4>

      <table style="text-align:left" class="table-responsive table table-striped">
         <col width="25%">
        <col width="75%">
        <?php 
		echo $helper->tag('tr') .
				$helper->tag('td') ; 
					//$helper->input(array('type'=>'button','name'=>'status','attribs'=>array('class'=>'btn btn-success'))) .
					//$helper->tag('span',['class'=> 'glyphicon glyphicon-ok','aria-hidden'=>'true']) . $helper->tag('/span') . ?>
					<button type="button" class="btn btn-success" id="daily_attendance" data-toggle="modal" data-target="#dailyAttendanceModal">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
              </button>			
<?php echo
              
			$helper->tag('/td') .
				$helper->tag('td') .
					$data['daily_attendance']['val'] .
				$helper->tag('/td') .
        	$helper->tag('/tr') ;
?>
         <tr>
          <td>
            <button type="button" class="btn btn-danger" >
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
              </button>
          </td>
          <td>
            Daily Homework
          </td>
        </tr>
         <tr>
          <td>
             <button type="button" class="btn btn-danger" id="behavior" data-toggle="modal" data-target="#behaviorModal">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
              </button>
          </td>
          <td>
            Positive Behavior
          </td>
        </tr>
         <tr>
          <td>
             <button type="button" class="btn btn-success" >
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
              </button>
          </td>
          <td>
            Growth Mindset
          </td>
        </tr>
         <tr>
          <td>
              <button type="button" class="btn btn-danger" >
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
              </button>
          </td>
          <td>
            Academic Achievement ELA
          </td>
        </tr>
         <tr>
          <td>
              <button type="button" class="btn btn-success" >
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
              </button>
          </td>
          <td>
            Academic Achievement Math
          </td>
        </tr>
         <tr>
          <td>
             <button type="button" class="btn btn-success" >
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
              </button>
          </td>
          <td>
            ELA Proficiency
          </td>
        </tr>
         <tr>
          <td>
              <button type="button" class="btn btn-danger" >
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
              </button>
          </td>
          <td>
            Math Proficiency
          </td>
        </tr>
      </table>

     </div>
   
</div>
  
</div>

<div class="alert alert-info">

 <button type="button" class="btn btn-info" ><span class="glyphicon glyphicon-time" aria-hidden="true">&nbsc;QUESTIONS? SET-UP A PHONE SESSION WITH ACE SUPPORT TEAM</span></button>

Do you like ACE Family Link? How can we improve? Submit feedback here.

</div>

</section>


<div class="modal fade" id="invitation" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" >Invitation
      <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h2></div>
      <div class="modal-body"><center>
        <img style="text-align:center;" src="/img/letter.png"></center>
      </div>
   
    </div>
  </div>
</div>

<div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" >Message
      <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h2></div>
      <div class="modal-body"><center>
        <img style="text-align:center;" src="/img/sounds.png"></center>
      </div>
   
    </div>
  </div>
</div>
<!-- Modal -->
<?php echo
$helper->tag('div',['class'=>'modal fade','id'=>'dailyHomeworkModal','tabindex'=>'-1','role'=>'dialog','aria-labelledby'=>'dailyHomeworkModalLabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) .
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->input(array('type'=>'button','name'=>'close','value'=>'X','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'dailyHomeworkModalLabel']) . $data['daily_homework']['val'] . $helper->tag('/h2') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-body']) .
				$helper->tag('p',['class'=>'booktext']) . $data['goal_1_detail'] . $helper->tag('/p') .
				$helper->tag('p',['class'=>'booktext']) . $data['goal_1_detail_2'] . $helper->tag('/p') .
				$helper->a('/parent/goal/1','more') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-footer']) .
				$helper->input($data['ok']) .
			$helper->tag('/div') .
		$helper->tag('/div') .
	$helper->tag('/div') .
$helper->tag('/div') .
//<!--modal-->
$helper->tag('div',['class'=>'modal fade','id'=>'dailyAttendnceModal','tabindex'=>'-1','role'=>'dialog','aria-labelledby'=>'dailyAttendanceModalLabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) .
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->input(array('type'=>'button','name'=>'close','value'=>'X','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'dailyAttendanceModalLabel']) . $data['daily_attendance']['val'] . $helper->tag('/h2') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-body']) .
				$helper->tag('p',['class'=>'booktext']) . $data['goal_2_detail'] . $helper->tag('/p') .
				$helper->tag('p',['class'=>'booktext']) . $data['goal_2_detail_2'] . $helper->tag('/p') .
				$helper->a('/parent/goal/2','more') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-footer']) .
				$helper->input($data['ok']) .
			$helper->tag('/div') .
		$helper->tag('/div') .
	$helper->tag('/div') .
$helper->tag('/div') .
//<!-- Modal -->
$helper->tag('div',['class'=>'modal fade','id'=>'behaviorModal','tabindex'=>'-1','role'=>'dialog','aria-labelledby'=>'behaviorModalLabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) .
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->input(array('type'=>'button','name'=>'close','value'=>'X','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'behaviorModalLabel']) . $data['positive_behavior']['val'] . $helper->tag('/h2') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-body']) .
				$helper->tag('p',['class'=>'booktext']) . $data['goal_3_detail'] .  $helper->tag('/p') .
				$helper->tag('p',['class'=>'booktext']) . $data['goal_3_detail_2'] . $helper->tag('/p') .
				$helper->a('/parent/goal/3','more') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-footer']) .
				$helper->input($data['ok']) .
			$helper->tag('/div') .
		$helper->tag('/div') .
	$helper->tag('/div') .
$helper->tag('/div') .
//<!-- Modal -->
$helper->tag('div',['class'=>'modal fade','id'=>'academicSuccessModal','tabindex'=>'-1','role'=>'dialog','aria-labelledby'=>'academicSuccessLabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) .
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->input(array('type'=>'button','name'=>'close','value'=>'X','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'academicSuccessLabel']) . $data['academic_success']['val'] . $helper->tag('/h2') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-body']) .
				$helper->tag('p',['class'=>'booktext']) . $data['goal_4_detail'] .  $helper->tag('/p') .
				$helper->tag('p',['class'=>'booktext']) . $data['goal_4_detail_2'] . $helper->tag('/p') .
				$helper->a('/parent/goal/4','more') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-footer']) .
				$helper->input($data['ok']) .
			$helper->tag('/div') .
		$helper->tag('/div') .
	$helper->tag('/div') .
$helper->tag('/div') ;

?>

<!--
<div class="modal fade" id="invitation" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" >Invitation
      <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h2></div>
      <div class="modal-body"><center>
      </center>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="grit" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" >Grit
      <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h2></div>
      <div class="modal-body">
        <p><b>
           <span class="glyphicon glyphicon-question " aria-hidden="true"></span>&nbsp;What is grit?&nbsp;</b>
           Grit is perseverance and passion for long-term goals. Being gritty means:<Br>
            <ul><li>Finishing what you begin</li><li>Staying committed to your goals</li><li>
Working hard even after experiencing failure or when you feel like quitting</li><li>
Sticking with a project or activity for more than a few weeks</li></ul>
</p><p>
        <b>
        <span class="glyphicon glyphicon-info " aria-hidden="true"></span>&nbsp;Why teach grit?</b>&nbsp;Research shows
        that grit is predictive of achievement, e.g. gritty students are more likely to excel at school.<br>


      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal"  data-target="grit2">
        Start activity</button><a href="/parents/activity" style="color:black">Start</a>
        <span type="button" class="btn btn-info" data-dismiss="modal">Save for later</span>
      </div>
   
    </div>
  </div>
</div>


<div class="modal fade" id="numbersense" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" >Number Sense
      <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h2></div>
      <div class="modal-body"><center>
        open
      </center>
      </div>
   <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal"  data-target="">Start activity</button>
        <span type="button" class="btn btn-info" data-dismiss="modal">Save for later</span>
      </div>
    </div>
  </div>
</div>

-->
