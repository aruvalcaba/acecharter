<?php
$data = $this->data;

echo 
$helper->tag('nav',['class'=>'navbar navbar-custom navbar-fixed-top','role'=>'navigation','style'=>'background-color: #a42a4e']) .
	$helper->tag('div',['class'=>'container col-lg-8 col-lg-offset-2']) .
		$helper->tag('div',['class'=>'navbar-header page-scroll']) .
			$helper->input(array('type'=>'button','name'=>'btn','attribs'=>array('class'=>'navbar-toggle','data-toggle'=>'collapse','data-target'=>'.navbar-main-collapse'))) .
				//$helper->tag('i',['class'=>'fa fa-bars']) . $helper->tag('/i') .
				$helper->tag('h1') .
				$helper->a('/', $data['ace_family_link']['val'], array('class'=>'navbar-brand','style'=>'color:#FFF')) .	
				$helper->tag('/h1') .
		$helper->tag('/div') .
		$helper->tag('div',['class'=>'navbar-collapse navbar-right navbar-main-collapse']) ;
		if( ! Sentry::check() ) { 
		echo 
			$helper->ul(array('class'=>'nav navbar-nav')) .
					$helper->ul()->rawItems(array($helper->a('/parent/login', $data['parents']['val'],array('style'=>'background-color: #a42a4e')) , $helper->a('/teacher/login', $data['teachers']['val'],array('class'=>'active','style'=>'background-color: #a42a4e')))) ;
			
         } else { 
		echo			
			$helper->tag('ul',['class'=>'nav navbar-nav']) .
				$helper->tag('li', ['class'=>'dropdown','style'=>'background-color: #a42a4e']) .
						$helper->a('#', $h($this->user->first_name) , array('class'=>'dropdown-toggle','data-toggle'=>'dropdown')) .
				$helper->tag('ul',['class'=>'dropdown-menu']) .
						$helper->tag('li') . $helper->a('/pwd/change',$data['changed_pwd'] , array('style'=>'color:black')) . $helper->tag('/li') .
						$helper->tag('li') . $helper->a('/logout', $data['logout'] ,array('style'=>'color:black')) . $helper->tag('/li') .
				$helper->tag('/ul') .               
                $helper->tag('/li') .
			$helper->tag('/ul') ;	
			
				
		}
		if(Session::get('lang')== 'en' || Session::get('lang')== ''){
			echo
			$helper->ul(array('class'=>'nav navbar-nav')) .
					$helper->ul()->rawItems(array($helper->a('/es','Español',array('style'=>'background-color: #a42a4e')))) ;
		}
		else { 
			echo
			$helper->ul(array('class'=>'nav navbar-nav')) .
					$helper->ul()->rawItems(array($helper->a('/en','English',array('style'=>'background-color: #a42a4e')))) ;
		} echo
		$helper->tag('/div') .
	 $helper->tag('/div') .
$helper->tag('/nav') ;

