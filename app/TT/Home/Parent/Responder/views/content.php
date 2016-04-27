<?php
$data = $this->data;
$activities = $this->acts;

echo
$helper->tag('section',['id'=>'service','class'=>'home-section text-center']) .
	$helper->tag('div',['class'=>'container']) .
		$helper->tag('div',['class'=>'heading-about']) ;
			include (sprintf('%s/views/base/%s',app_path(),'alerts.php'));
			if(Session::get('lang')== 'en' || Session::get('lang')== ''){
			echo
			$helper->tag('div',['class'=>'text-right','style'=>'padding-bottom:20px']) . 
			$helper->tag('div',['class'=>'btn btn-skin']) . $helper->a('/es','Español',array('style'=>'color: #fff')) . $helper->tag('/div') .
			$helper->tag('/div') ;
		}
		else { 
			echo
			$helper->tag('div',['class'=>'text-right','style'=>'padding-bottom:20px']) . 
			$helper->tag('div',['class'=>'btn btn-skin']). $helper->a('/en','English',array('style'=>'color: #FFF')) . $helper->tag('/div') .
			$helper->tag('/div');
		}
			echo
			$helper->tag('div',['class'=>'row col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2']) .
				$helper->tag('h2') . $data['welcome']['val'] .'&nbsp;' . '&nbsp;' . $h($this->user->first_name) . $helper->tag('/h2') .
				
				$helper->tag('i',['class'=>'fa fa-2x fa-angle-down']) . $helper->tag('/i') .
			$helper->tag('/div') .
      	$helper->tag('/div') ;
	 

	 


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
<?php
	echo $helper->tag('div',['class'=>'row col-lg-4 col-lg-offset-4 col-sm-8 col-sm-offset-2']) ;

	//students dropdown
	
	$studentcount = count($this->students);
	if(count($this->students)>1){
		$select = $helper->input(array('type'=>'select','name'=>'student','attribs'=>array('id'=>'student','class'=>'form-group'))) ;
		$select->option('','Select Student');
		foreach( $this->students as $student ) { 
			$select->option($student->id,$student->first_name);
		}
		echo $select;
		
	}
	//selected Student Id
	$selectedStudentId = isset($_REQUEST['studentid']) ? $_REQUEST['studentid'] : $this->students[0]->id;
	
	 foreach( $this->students as $student ) { 
		
	//dd($student);
		if($student->id == $selectedStudentId){
		echo 		
			$helper->tag('h4') . $h($student->first_name) . '\'s ' . $data['progress_report']['val'] . $helper->tag('/h4') .
			$helper->tag('hr',['class'=>'marginbot-30']) ; ?>
 
      <table style="text-align:left" class="table-responsive table table-striped">
         <col width="25%">
        <col width="75%">
        <?php 
		foreach($this->goals as $goal){
		$goalValue = isset($student->goals[$goal->id]) ? $student->goals[$goal->id] : 0;
		echo $helper->tag('tr') .
				$helper->tag('td') ; 
				$updated_at = $student->goals['updated_at'];
				if($goalValue){
				
					echo $helper->tag('a',['href'=>'/parent/goal/'.$goal->id.'?studentid='.$selectedStudentId]);?>
					<button type="button" class="btn btn-success" id="<?php echo $goal->name . '_' . $student->id ?>" >							
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					</button>
	
				<?php
				echo $helper->tag('/a');
				}else{
					echo $helper->tag('a',['href'=>'/parent/goal/'.$goal->id.'?studentid='.$selectedStudentId]);?>

					<button type="button" class="btn btn-danger" id="<?php echo $goal->name . '_' . $student->id; ?>">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
	
				<?php 
					echo $helper->tag('/a');
				}
              
			echo
			$helper->tag('/td') .
				$helper->tag('td') .
					$data[$goal->name]['val'] .
				$helper->tag('/td') .
        	$helper->tag('/tr') ;

		}
		}
	echo 
	$helper->tag('/table') ;	
	
	} 
	echo
	$helper->tag('div',['class'=>'row']) . $helper->input($data['addChild_btn']) . $helper->tag('/div') .	
	$helper->tag('div',['class'=>'row']) . '&nbsp;' . $helper->tag('/div') .
	$helper->tag('div',['class'=>'row']) . $data['data_updated']['val'] . date("jS F, Y", strtotime($updated_at)) . $helper->tag('/div') .	
$helper->tag('/div') .
$helper->tag('/div') .
$helper->tag('/div') .
$helper->tag('/section') .

//Add Child Model
$helper->tag('div',['class'=>'modal fade','id'=>'addChildModal','tabindex'=>'-1','role'=>'dialog','aria-labelledby'=>'addChildModalLabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) .
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'AddChildModalLabel']) . $data['add_child']['val'] . '&nbsp;'  . 
				$helper->input(array('type'=>'button','name'=>'close','value'=>'X','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) . 
				$helper->tag('/h2') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-body','style'=>'position: static']) .
				$helper->tag('div',['id'=>'addChild_alert','class'=>'alert alert-danger hidden','role'=>'alert']) .
					$helper->tag('ul',['id'=>'addChild_errors']) . $helper->tag('/ul') .
				$helper->tag('/div') .			
				$helper->form() .
				$helper->tag('div',['class'=>'form-group']) .
					$helper->label($data['student']['val']. ' ' . $data['code']['val']) .
					$helper->input($data['student_code_input']) .
				$helper->tag('/div') .				
				$helper->tag('div',['class'=>'modal-footer']) .
					$helper->input($data['cancel_btn']) .
					$helper->input($data['child_btn']) .			        	
    			$helper->tag('/div') .
				$helper->tag('/form') .
			$helper->tag('/div') .
		$helper->tag('/div') .
    $helper->tag('/div') .	
$helper->tag('/div') ;


?>


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



