<?php
$data = $this->data;

echo 
$helper->tag('main') .
	$helper->tag('section',['class'=>'home-section text-center']) .
	$helper->tag('div',['class'=>'container wow bounceInDown','data-wow-delay'=>'2s']) .
		$helper->tag('div',['class'=>'row']) . $helper->tag('h2') . $h('Upload Academic goals') . $helper->tag('/h2') . $helper->tag('/div') .
		$helper->tag('div',['class'=>'col-xs-6 col-xs-offset-3 panel panel-admin']) .
        $helper->form(array('method'=>'post','action'=>'/academic/upload','accept-charset'=>'UTF-8','enctype'=>'multipart/form-data'));

            include (sprintf('%s/views/base/%s',app_path(),'alerts.php'));
            echo $helper->tag('div',['class'=>'form-group']) .
                    $helper->label($data['academic_label']['val']) .
                    $helper->input($data['academic_input']) .
                $helper->tag('/div') . 
                $helper->input($data['hidden_input']) .
			$helper->tag('div',['class'=>'row']) . $helper->input($data['create_btn']) . $helper->input($data['cancel_btn']) .$helper->tag('/div') .			
		$helper->tag('/form') .
		$helper->tag('/div') .			
	$helper->tag('/div') .
	$helper->tag('/section') .
$helper->tag('/main') ;
