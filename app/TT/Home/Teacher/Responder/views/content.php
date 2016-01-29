<main>
<section id="service" class="home-section text-center">


<?php

$data = $this->data;

	include (sprintf('%s/views/base/%s',app_path(),'alerts.php'));

echo $helper->tag('div') .
    $helper->tag('div',['class'=>'col-md-8']) .
        $helper->input($data['register_btn']) .   
        $helper->input($data['all_students_btn']) .   
    $helper->tag('/div') .
    $helper->tag('div',['class'=>'col-md-4']) .
        $helper->tag('button',['class'=>'btn btn-info','type'=>'button','data-toggle'=>'collapse','data-target'=>'#codes']) . $h($data['how_register_parents']) . $helper->tag('span',['class'=>'glyphicon glyphicon-info-sign','aria-hidden'=>'true']) . $helper->tag('/span') . $helper->tag('/button') .
    $helper->tag('/div') .
$helper->tag('/div');
?>
<!--
 <div class="col-lg-8 col-lg-offset-2 btn-group pull-left" role="group"  aria-label="...">
     <button type="button" class="btn btn-default active">
    Registration</button>

     <button type="button" class="btn btn-default">
          
    All Students</button>


    <div class="btn-group">
        <a class="btn-navbar btn btn-default" role="button" href="#" class="btn dropdown-toggle" data-toggle="dropdown">
       
    Groups <span class="caret"></span></a>

            <ul class="dropdown-menu" role="menu">
                <li><a href="" >Group Name One</a>
                </li>
                <li><a href="" >Group Name Two</a>
                </li>
                
            </ul>
        </div>
    </div>

<div class="row">
      <Br><br><br>
    </div>
    <div class="container">

 <div class="row col-lg-8 col-lg-offset-2" >
 <button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#codes">
  <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;
  How do I register parents?</button></div>
   -->          

<div class="row col-lg-6 col-lg-offset-3 bg-info collapse" id="codes">
                   
<p class="col-lg-8 col-lg-offset-2 bg-info"><br>
<b><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;</b>To register, parents will need a student code. 
You can automatically print a note home with student code using the button below.<br><br>

<button type="button" class="btn btn-info" data-toggle="modal" data-target="#StudentCodes">
    <span class="glyphicon glyphicon-print" aria-hidden="true"></span> &nbsp; Print Parent Notes</button></p>
   
  </div>
  
<div class="row">
      <Br><br><br>
    </div>
<div class="row">
       <h3>Active Students&nbsp;
        <span class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#parentsignup" 
        aria-hidden="true"></span></h3>
        
      </div>
<div class="row">

<div class="col-lg-8 col-lg-offset-2">
   
<div class="container-fluid" id="dispData">
     <table class="table table-bordered sttable table-striped">
        
        <col width="35%">
        <col width="35%">
        <col width="30%">
 
                <thead>
        <tr>
            <th style="vertical-align:bottom">Student Name [Code]</th>
            
            <th style="vertical-align:bottom">Registered Family Member</th>
            
            <th style="vertical-align:bottom" data-sortable="true">Last login</th>
        </tr></thead>
        <tbody >
                <?php foreach($this->students as $student) { ?>
                <tr>
                    <td style="text-align:left; vertical-align:middle"><?php echo $h($student->fullname) ?> <small><?php echo "[".$h($student->code)."]"?></small></td>
                    <td style="text-align:left; vertical-align:middle"> <br><small><?php echo $h($student->parentName)?></small></td>
                    <td style="text-align:left; vertical-align:middle"><?php echo $h($student->last_login)?></td>  
                <?php } ?>
        </tbody>
    </table>

    
</div>
    </div>
  </div>

  <div class="row">
       <h3>ACE Goals&nbsp;
        <span class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#goalsinfo" 
        aria-hidden="true"></span></h3>
        
      </div>
<div class="row">

<div class="col-lg-8 col-lg-offset-2">
   
<div class="container-fluid" id="dispData">
     <table class="table table-bordered sttable table-striped">
        
        <col width="35%">
        <col width="35%">
        <col width="30%">
 
                <thead>
        <tr>
            <th style="vertical-align:bottom">Student Name [Code]</th>
            
            <th style="vertical-align:bottom" data-sortable="true">Goal1</th>
            
            <th style="vertical-align:bottom" data-sortable="true">Goal2</th>
        </tr></thead>
        <tbody >
                <?php               
                    foreach( $this->students as $student ) { ?>
                <tr>
                     <td style="text-align:left; vertical-align:middle"> <?php echo $h($student->fullname) ?> <small><?php echo "[".$h($student->code)."]"?></small></td>
                    <td style="text-align:left; vertical-align:middle"> <?php echo sprintf('%d/1',$student->goal1)?> </td>
                    <td style="text-align:left; vertical-align:middle"> <?php echo sprintf('%d/1',$student->goal2)?> </td>  
                <?php } ?>
        </tbody>
    </table>
</div>
    </div>
  </div>
  

</section>



<div class="modal fade" id="StudentCodes" tabindex="-1" role="dialog" aria-labelledby="NotesModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" id="signupModalLabel">Student Codes
      <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h2></div>
      <div class="modal-body">
        <table class="table table-hover table-striped">
          <tr><td>
          <p>
            <?php 
                    echo 'How many students do you have?&nbsp;&nbsp;<input id="student_count" value="1" type="number" min="1" step"1">
                            <br>
                            <p>The note to parents will include information to register (website URL and special codes) 
                            with the following message to parents.
                            <div id="message">
                            <hr><div class="row"><br><br></div>
                            Dear Parent,<br><br>
                            ACE is starting a new service called Family Link. 
                            To register for the service, use your smartphone or computer and visit this website:</p>
                            <br><br>
                            <b>Website:</b> acecharter.org/family <br>
                            
                            </div>'; 
            ?>
          </p></td></tr></table>
      </div>
      <div class="modal-footer">
        <span type="button" class="btn btn-default" data-dismiss="modal">Cancel</span>
        <span id="print_codes" type="button" class="btn btn-success" >Print Codes</span>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="parentsignup" tabindex="-1" role="dialog" aria-labelledby="NotesModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

      </div>
      <div class="modal-body">
       <p class="booktext">When family members register, their information shows up in the active students list. If they do not register,
    please follow up with email, phone call or text to support them with the sign-up process.</p>
      </div>
      <div class="modal-footer">
        <span type="button" class="btn btn-default" data-dismiss="modal">Got It</span>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="goalsinfo" tabindex="-1" role="dialog" aria-labelledby="NotesModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

      </div>
      <div class="modal-body">
       <p class="booktext">The panel below is the summary of every student's progress toward goals. Parents have access to this data for their child.</p>
      </div>
      <div class="modal-footer">
        <span type="button" class="btn btn-default" data-dismiss="modal">Got It</span>
      </div>
    </div>
  </div>
</div>
</main>
