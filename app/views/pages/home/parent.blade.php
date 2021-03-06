<?php $student = $user->students()->first() ?>
<?php $teacher = $student->teachers()->first() ?>
<section id="service" class="home-section text-center">
    

    <div class="container">
    <div class="heading-about">
        
        <div class="row col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2">
        <h2>Welcome,&nbsp; <?php echo $user->first_name?> </h2>
        <i class="fa fa-2x fa-angle-down"></i>
      </div>
        <div class="row">
      <div class="col-lg-2 col-lg-offset-5">
       <br><br>
        
      </div>
    </div>

    <!-- start of activity box -->
  <div class="col-lg-6 col-lg-offset-3 alert" role="alert">
        <div class="activity alert row col-lg-10 col-md-8 col-sm-8 col-lg-offset-1 col-md-offset-2 col-sm-offset-2">
          
          <!-- description -->
          <div >
        <h4>Invitation</h4>
        
        <p> Teacher sent you an invitation for a parent teacher conference. 
          </p>
          <button type="button" class="btn btn-primary ">
  <span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#invitation"></span>&nbsp;View </button>
          <span style="color:red">Please read before Tuesday, Aug 28, 2015.</span>
          </div>

      </div>
           
    </div>
<!-- end of activity box -->
<!-- start of activity spacing -->
<div class="row">
      <div class="col-lg-2 col-lg-offset-5">
      </div>
</div>
<!-- end of activity spacing -->

 <!-- start of activity box -->
  <div class="col-lg-6 col-lg-offset-3 alert" role="alert">
        <div class="activity alert row col-lg-10 col-md-8 col-sm-8 col-lg-offset-1 col-md-offset-2 col-sm-offset-2">
          
          <!-- description -->
          <div >
        <h4>MESSAGE</h4>
        
        <p>IEP manager has an update for you. 
          </p>
          <button type="button" class="btn btn-primary ">
  <span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#message"></span>&nbsp;View </button>
          
          </div>

      </div>
           
    </div>
<!-- end of activity box -->
<!-- start of activity spacing -->
<div class="row">
      <div class="col-lg-2 col-lg-offset-5">
      </div>
</div>
<!-- end of activity spacing -->


 <!-- start of activity box -->
  <div class="col-lg-6 col-lg-offset-3 alert" role="alert">
        <div class="activity alert row col-lg-10 col-md-8 col-sm-8 col-lg-offset-1 col-md-offset-2 col-sm-offset-2">
          
          <!-- description -->
          <div >
        <h4>Invitation</h4>
        
        <p> Principal sent you an invitation for October BBQ. 
          </p>
          <button type="button" class="btn btn-primary ">
  <span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#invitation"></span>&nbsp;View </button>
          <span style="color:red">Please read before September 20, 2015.</span>
          </div>

      </div>
           
    </div>
<!-- end of activity box -->
<!-- start of activity spacing -->
<div class="row">
      <div class="col-lg-2 col-lg-offset-5">
      </div>
</div>
<!-- end of activity spacing -->



  <div class="row col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2">
<?php 
if( Session::has('warning') )
{
    echo '<div class="alert alert-warning" role="alert">'.Session::get('warning').'</div>';
}
else if( Session::has('info') )
{
   echo '<div class="alert alert-info" role="alert">'.Session::get('info').'</div>';
}
else if( Session::has('success') )
{
   echo '<div class="alert alert-success" role="alert">'.Session::get('success').'</div>';
}

if( count($activities) === 0 )
{
    echo '<div class="alert alert-info" role="alert">No messages at the moment.</div>';
}
?>   </div>

 <?php 
            foreach($activities as $activity)
            {
                $format = '%s%s';
                
                $path = sprintf($format,public_path(),$activity->description_url);
                include($path);
            }
     ?>

     
<!--
<div class="row center-block">
    <table class="table">
    <tr>
        <td><?php echo $student->first_name.'\'s'. ' activity time (in minutes)'?></td>
        <td><?php echo 'Average student activity time (in minutes)'?></td>
    </tr>
    <tr>
        <td><?php echo $student->traits()->first()->activity_total_time ?></td>
        <td><?php echo $avg ?></td>
    </tr>
    </table>    
</div>  
-->


  
     <div class="row">
      <div class="col-lg-2 col-lg-offset-5">
        <hr class="marginbot-50">
      </div>
    </div>
    
     <div class="row col-lg-4 col-lg-offset-4 col-sm-8 col-sm-offset-2">
      <h4><?php echo $user->first_name?>'s Progress Monitor</h4>

      <table style="text-align:left" class="table-responsive table table-striped">
         <col width="25%">
        <col width="75%">
        <tr>
          <td>
              <button type="button" class="btn btn-success" >
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
              </button>
          </td>
          <td>
            Daily Attendance
          </td>
        </tr>
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
             <button type="button" class="btn btn-success" >
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
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

 <button type="button" class="btn btn-info" >
                <span class="glyphicon glyphicon-time" aria-hidden="true">&nbsc;QUESTIONS? SET-UP A PHONE SESSION WITH ACE SUPPORT TEAM</span>
              </button>

  <br><br>

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
