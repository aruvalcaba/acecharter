<?php
$data = $this->data;

echo 
$helper->tag('main') .
$helper->tag('section',['class'=>'home-section text-center']) .
    $helper->tag('div',['class'=>'container wow bounceInDown','data-wow-delay'=>'2s']) .
        $helper->tag('div',['class'=>'row']) . $helper->tag('h2') . $h('Login below or') . $helper->tag('/h2') . $helper->tag('/div') .
        $helper->tag('div',['class'=>'row']) . $helper->input($data['signup_btn']) . $helper->tag('/div') .
        $helper->tag('div',['class'=>'row']) .
            $helper->tag('div',['class'=>'col-xs-6 col-xs-offset-3 panel panel-success panel-login']) .
                $helper->tag('div',['class'=>'row']) . $helper->label($data['email_label']['val'])->before($helper->input($data['email_input'])) . $helper->tag('/div') .
                $helper->tag('div',['class'=>'row']) . $helper->label($data['pwd_label']['val'])->before($helper->input($data['pwd_input'])) . $helper->tag('/div') .
                $helper->tag('div',['class'=>'row']) . $helper->input($data['login_btn']) . $helper->tag('/div') .
                $helper->tag('div',['class'=>'row']) . $helper->input($data['forgot_pwd_btn']) . $helper->tag('/div') .
            $helper->tag('/div') .
        $helper->tag('/div') .
    $helper->tag('/div') . 
$helper->tag('/section') .
$helper->tag('/main') .
$helper->tag('div',['class'=>'modal fade','id'=>'signupModal','tableindex'=>'-1','role'=>'dialog','aria-labelledby'=>'signupModallabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) . 
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->tag('h2',['class' =>'modal-title','id'=>'signupModalLabel']) . $data['welcome']['val'] .	
					$helper->input(array('type'=>'button','name'=>'close','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
					$helper->label('',['aria-hidden'=>'true']) .					

				$helper->tag('/h2') .
			$helper->tag('/div') .	
			$helper->tag('div',['class'=>'modal-body']) .
				$helper->form() .
					$helper->tag('div',['class'=>'form-group']) .
						$helper->label($data['title']['val']) .
						$helper->input($data['titles_input']) .
					$helper->tag('/div') .
					$helper->tag('div',['class'=>'form-group']) .
						$helper->label($data['first_name']['val']) .
						$helper->input(array('type'=>'text','name'=>'first_name','attribs'=>array('id'=>'first_name','class'=>'form-control'))) . 
					$helper->tag('/div') .
					$helper->tag('div',['class'=>'form-group']) .
						$helper->label($data['last_name']['val']) .
						$helper->input(array('type'=>'text','name'=>'last_name','attribs'=>array('id'=>'last_name','class'=>'form-control'))) . 
					$helper->tag('/div') .
					$helper->tag('div',['class'=>'form-group']) .
						$helper->label($data['email_label']['val']) .
						$helper->input($data['email_input']) . 
					$helper->tag('/div') .
					$helper->tag('div',['class'=>'form-group']) .
						$helper->label($data['grade_teaching']['val']) .
						$helper->input($data['grades_input']). 
					$helper->tag('/div') .
					$helper->tag('div',['class'=>'form-group']) .
						$helper->label($data['zip_code']['val']) .
						$helper->input(array('type'=>'text','name'=>'zipcode','attribs'=>array('id'=>'zipcode','class'=>'form-control'))) .
					$helper->tag('/div') .
					$helper->tag('div',['class'=>'form-group']) .
						$helper->label($data['school_name']['val']) .
						$helper->input($data['schools_input']) . 
					$helper->tag('/div') .
				$helper->tag('/form') .
				$helper->tag('div',['class'=>'model-footer']) .
					$helper->input($data['cancel_btn']) .
					$helper->input($data['create_account_btn']) .
				$helper->tag('/div') .
			$helper->tag('/div') .
		$helper->tag('/div') .		
	$helper->tag('/div') .
$helper->tag('/div') .
//--modal--//
$helper->tag('div',['class'=>'modal fade','id'=>'signupSuccessModal','tabindex'=>'-1','role'=>'dialog','aria-labelledby'=>'signupSuccessModalLabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) .
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->input(array('type'=>'button','name'=>'close','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'signupSuccessModalLabel']) . $data['signup_success']['val'] .
				$helper->tag('/h2') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-footer']) .
				$helper->input($data['ok']) . 
			$helper->tag('/div') .
		$helper->tag('/div') .
	$helper->tag('/div') .
$helper->tag('/div') .
//---Modal----
$helper->tag('div',['class'=>'modal fade','id'=>'forgotPasswordModal','tabindex'=>'-1','role'=>'dialog','aria-labelledby'=>'forgotPasswordModalLabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) .
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->input(array('type'=>'button','name'=>'close','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'forgotPasswordModalLabel']) . $data['reset_password']['val'] . $helper->tag('/h2') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-body']) ;
?>
				
        <table class="frmTable">
            <tr class="text-danger text-center hidden"><td colspan="2" id="errorText"></td></tr>
            <tr>
                <td>Your registered E-mail address:</td>
                <td><input type="text" id="email" class="form-control"></td>
                 <input type="hidden" id="forgotType" value="1" />
            </tr>
        </table>
<?php echo
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-footer']) .
				$helper->input($data['cancel_btn']) .
				$helper->input($data['reset_pwd_btn']) .
			$helper->tag('/div') .
		$helper->tag('/div') .
	$helper->tag('/div').
$helper->tag('/div') .
//--modal---
$helper->tag('div',['class'=>'modal fade','id'=>'forgotPasswordSuccessModal','tabindex'=>'-1','role'=>'dialog','aria-labelledby'=>'signupSuccessModalLabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) .
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->input(array('type'=>'button','name'=>'close','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'signupSuccessModalLabel']) . $data['pwd_success']['val'] . $helper->tag('/h2') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-footer']) .
				$helper->input($data['ok']) . 
			$helper->tag('/div') .
		$helper->tag('/div') .
	$helper->tag('/div') .
$helper->tag('/div') ;
			
?>
<!--
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" id="signupModalLabel">Welcome Teacher
      <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></h2></div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label>Title</label>
                <?php echo $helper->input($data['titles_input']); ?>
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" id="first_name">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" id="last_name">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="signup_email">
            </div>
            <div class="form-group">
                <label>Grade You are Teaching</label>
                <?php echo $helper->input($data['grades_input']); ?>
            </div>
            <div class="form-group">
                <label>Zipcode</label>
                <input type="text" class="form-control" maxLength=5 id="zipcode">
            </div>
            <div class="form-group">
                <label>School name</label>
                <?php echo $helper->input($data['schools_input']); ?>
            </div>
        </form>
      <div class="modal-footer">
        <span type="button" class="btn btn-default" data-dismiss="modal">Cancel</span>
        <span id="teacher_signup" type="button" class="btn btn-success" >Create Account</span>
      </div>
    </div>
  </div>
</div>
</div>
-->
<!-- Modal -->
<!--
<div class="modal fade" id="signupSuccessModal" tabindex="-1" role="dialog" aria-labelledby="signupSuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="signupSuccessModalLabel">Signup successful. Login credentials were sent to your email address.
      </div>
      <div class="modal-footer">
        <span type="button" class="btn btn-success" data-dismiss="modal">OK</span>
      </div>
    </div>
  </div>
</div>
-->
    
<!-- Modal -->
<!--
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="forgotPasswordModalLabel">Reset Password</h2>
      </div>
      <div class="modal-body">
        <table class="frmTable">
            <tr class="text-danger text-center hidden"><td colspan="2" id="errorText"></td></tr>
            <tr>
                <td>Your registered E-mail address:</td>
                <td><input type="text" id="email" class="form-control"></td>
                 <input type="hidden" id="forgotType" value="1" />
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <span type="button" class="btn btn-default" data-dismiss="modal">Cancel</span>
        <span type="button" id="reset_password" class="btn btn-primary">Reset Password</span>
      </div>
    </div>
  </div>
</div>
-->
<!-- Modal -->
<!--
<div class="modal fade" id="forgotPasswordSuccessModal" tabindex="-1" role="dialog" aria-labelledby="signupSuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="signupSuccessModalLabel">A new password was sent to your email to login with.</h2>
      </div>
      <div class="modal-footer">
          <span type="button" class="btn btn-success" data-dismiss="modal">OK</span>
      </div>
    </div>
  </div>
</div>
-->
