<?php
$data = $this->data;

echo 
$helper->tag('main',['id'=>'page-top']) .
//<!-- Section: main -->
$helper->tag('section',['id'=>'service','class'=>'home-section text-center']) .
	$helper->tag('div',['class'=>'container wow bounceInDown','data-wow-delay'=>'2s']) ;
		if(Session::get('lang')== 'en' || Session::get('lang')== ''){
			echo
			$helper->tag('div',['class'=>'btn btn-skin']) . $helper->a('/es','Español',array('style'=>'color: #fff')) . $helper->tag('/div');
		}
		else { 
			echo
			$helper->tag('div',['class'=>'btn btn-skin']). $helper->a('/en','English',array('style'=>'color: #FFF')) . $helper->tag('/div');
		}
		echo
		$helper->tag('div',['class'=>'row']) . 
			$helper->tag('h2') . $h($data['login_msg']['val']) . $helper->tag('/h2') . 
		$helper->tag('/div') .
		$helper->tag('div',['class'=>'row']) . $helper->input($data['register_btn']) . $helper->tag('/div') .	
		
	$helper->tag('div',['class'=>'col-md-6 col-md-offset-3 panel panel-success panel-login']) .
		//<!-- to calculate that do (12-6)/2. The 12 is total number of md columns, subtract by the number  and then divide by 2 --> 							
		$helper->tag('div',['class'=>'row']) .						
			$helper->label($data['email_label']['val'])->before($helper->input($data['email_input'])) .	
		$helper->tag('/div') .
		$helper->tag('div',['class'=>'row']) . 						
			$helper->label($data['pwd_label']['val'])->before($helper->input($data['pwd_input'])) .
		$helper->tag('/div') .					
		$helper->tag('div',['class'=>'row']) . $helper->input($data['login_btn']) . $helper->tag('/div') .      
                         //<span id="login" class="btn btn-success fleft col-lg-6 col-lg-offset-3 col-sm-10 col-sm-offset-1" >Login &nbsp;&nbsp;<small>INICIAR SESIÓN</small></span>       <div class="row">             <br><hr><br></div>				
		$helper->tag('div',['class'=>'row']) . $helper->input($data['forgot_pwd_btn']) . $helper->tag('/div') . 	
	$helper->tag('/div') .	
	$helper->tag('/div') .
//<!-- /panel-group -->
$helper->tag('/section') .
$helper->tag('/main') .
$helper->tag('div',['class'=>'modal fade','id'=>'signupModal','tabindex'=>'-1','role'=>'dialog','aria-labelledby'=>'signupModalLabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) .
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'signupModalLabel']) . $data['welcome']['val'] . '&nbsp;' .$data['parent']['val'] . 
				$helper->input(array('type'=>'button','name'=>'close','value'=>'X','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) . 
				$helper->tag('/h2') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-body','style'=>'position: static']) .
				$helper->tag('div',['id'=>'signup_alert','class'=>'alert alert-danger hidden','role'=>'alert']) .
					$helper->tag('ul',['id'=>'signup_errors']) . $helper->tag('/ul') .
				$helper->tag('/div') .			
				$helper->form() .
				$helper->tag('div',['class'=>'form-group']) .
					$helper->label($data['parent']['val']. ' ' . $data['full_name']['val']) .
					$helper->input($data['parent_fullname_input']) .
				$helper->tag('/div') .
				$helper->tag('div',['class'=>'form-group']) .
					$helper->label($data['parent']['val']. ' ' . $data['email_label']['val']) .
					$helper->input($data['email_input']) .
				$helper->tag('/div') .				
				$helper->tag('div',['class'=>'form-group']) .
					$helper->label($data['student']['val']. ' ' . $data['code']['val']) .
					$helper->input($data['student_code_input']) .
				$helper->tag('/div') .
				$helper->tag('div',['class'=>'form-group']) .
					$helper->label($data['parent']['val']. ' ' . $data['relationship_student']['val']) .
					  Form::select('relationship',FormList::relationships(),null,array('id'=>'relationship','class'=>'form-control')) .
				$helper->tag('/div') .
				$helper->tag('div',['class'=>'modal-footer']) .
					$helper->input($data['cancel_btn']) .
					$helper->input($data['signup_btn']) .			        	
    			$helper->tag('/div') .
				$helper->tag('/form') .
			$helper->tag('/div') .
		$helper->tag('/div') .
    $helper->tag('/div') .	
$helper->tag('/div') .
//<!-- Modal -->
$helper->tag('div',['class'=>'modal fade','id'=>'signupSuccessModal','tabindex'=>'-1','role'=>'dialog','aria-labelledby'=>'signupSuccessModalLabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) .
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->input(array('type'=>'button','name'=>'close','value'=>'X','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'signupSuccessModalLabel']) . $data['registration']['val'] . $helper->tag('/h2') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-body']) .
				$helper->tag('p',['class'=>'booktext']) . $data['signup_success']['val'] . $helper->tag('/p') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-footer']) .
				$helper->input($data['ok']) .
			$helper->tag('/div') .
		$helper->tag('/div') .
	$helper->tag('/div') .
$helper->tag('/div') .
//<!-- Modal -->
$helper->tag('div',['class'=>'modal fade','id'=>'forgotPasswordModal','tabindex'=>'-1','role'=>'dialog','aria-labelledby'=>'forgotPasswordModalLabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) .
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->input(array('type'=>'button','name'=>'close','value'=>'X','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'forgotPasswordModalLabel']) . $data['reset_pwd']['val'] . $helper->tag('/h2') .
			$helper->tag('/div') .
     		$helper->tag('div',['class'=>'modal-body']) .
				$helper->tag('table',['class'=>'frmTable']) .
					$helper->tag('tr',['class'=>'text-danger text-center hidden']) . $helper->tag(
'td',['colspan'=>'2','id'=>'errorText']) . $helper->tag('/td') . $helper->tag('/tr') .
					$helper->tag('tr') .
						$helper->tag('td') . $helper->label($data['registered_email']['val']) . $helper->tag('/td') .
						$helper->tag('td') . $helper->input(array('type'=>'text','name'=>'email','attribs'=>array('id'=>'email','class'=>'form-control'))) .$helper->tag('/td') .						
					$helper->tag('/tr') .
				$helper->tag('/table') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-footer']) .
				$helper->input($data['cancel_btn']) .
				$helper->input($data['reset_pwd_btn']) .      
			$helper->tag('/div') .
		$helper->tag('/div') .
	$helper->tag('/div') .
$helper->tag('/div') .
//<!-- Modal -->
$helper->tag('div',['class'=>'modal fade','id'=>'forgotPasswordSuccessModal','tabindex'=>'-1','role'=>'dialog','aria-labelledby'=>'signupSuccessModalLabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) .
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->input(array('type'=>'button','name'=>'close','value'=>'X' ,'attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'signupSuccessModalLabel']) . $data['pwd_success']['val'] . $helper->tag('/h2') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-footer']) .
				$helper->input($data['ok']) . 
			$helper->tag('/div') .
		$helper->tag('/div') .
	$helper->tag('/div') .
$helper->tag('/div') ;

