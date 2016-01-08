<?php
$data = $this->data;

echo 
$helper->tag('main',['id'=>'page-top']) .
$helper->tag('section',['id'=>'service','class'=>'home-section text-center']) .
    $helper->tag('div',['class'=>'container wow bounceInDown','data-wow-delay'=>'2s']) .
        $helper->tag('div',['class'=>'row']) . $helper->tag('h2') . $h($data['login_msg']['val']) . $helper->tag('/h2') . $helper->tag('/div') .
        $helper->tag('div',['class'=>'row']) . $helper->input($data['signup_btn']) . $helper->tag('/div') .
            $helper->tag('div',['class'=>'col-md-6 col-md-offset-3 panel panel-success panel-login']) .
                $helper->tag('div',['class'=>'row']) . $helper->label($data['email_label']['val'])->before($helper->input($data['email_input'])) . $helper->tag('/div') .
                $helper->tag('div',['class'=>'row']) . $helper->label($data['pwd_label']['val'])->before($helper->input($data['pwd_input'])) . $helper->tag('/div') .
                $helper->tag('div',['class'=>'row']) . $helper->input($data['login_btn']) . $helper->tag('/div') .
                $helper->tag('div',['class'=>'row']) . $helper->input($data['forgot_pwd_btn']) . $helper->tag('/div') .
        $helper->tag('/div') .
    $helper->tag('/div') . 
$helper->tag('/section') .
$helper->tag('/main') .
$helper->tag('div',['class'=>'modal fade','id'=>'signupModal','tableindex'=>'-1','role'=>'dialog','aria-labelledby'=>'signupModallabel','aria-hidden'=>'true']) .
	$helper->tag('div',['class'=>'modal-dialog']) . 
		$helper->tag('div',['class'=>'modal-content']) .
			$helper->tag('div',['class'=>'modal-header']) .
				$helper->tag('h2',['class' =>'modal-title','id'=>'signupModalLabel']) . $data['welcome']['val'] .	
					$helper->input(array('type'=>'button','name'=>'close','value'=>'X','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
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
				$helper->input(array('type'=>'button','name'=>'close', 'value'=>'x','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'forgotPasswordModalLabel']) . $data['reset_password']['val'] . $helper->tag('/h2') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-body']) .
				$helper->tag('table',['class'=>'frmTable']) .
					$helper->tag('tr',['class'=>'text-danger text-center hidden']) . $helper->tag(
'td',['colspan'=>'2','id'=>'errorText']) . $helper->tag('/td') . $helper->tag('/tr') .
					$helper->tag('tr') .
						$helper->tag('td') . $helper->label($data['registered_email']['val']) . $helper->tag('/td') .
						$helper->tag('td') . $helper->input(array('type'=>'text','name'=>'email','attribs'=>array('id'=>'email','class'=>'form-control'))) .$helper->tag('/td') .
						$helper->input(array('type'=>'hidden','value'=>'1','name'=>'forgotType','attribs'=>array('id'=>'forgotType'))) .
					$helper->tag('/tr') .
				$helper->tag('/table') .
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
				$helper->input(array('type'=>'button','name'=>'close','value'=>'X','attribs'=>array('class'=>'close','data-dismiss'=>'modal'))) .
				$helper->tag('h2',['class'=>'modal-title','id'=>'signupSuccessModalLabel']) . $data['pwd_success']['val'] . $helper->tag('/h2') .
			$helper->tag('/div') .
			$helper->tag('div',['class'=>'modal-footer']) .
				$helper->input($data['ok']) . 
			$helper->tag('/div') .
		$helper->tag('/div') .
	$helper->tag('/div') .
$helper->tag('/div') ;
