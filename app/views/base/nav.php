<?php
$data = $this->data;

echo 
$helper->tag('nav',['class'=>'navbar navbar-custom navbar-fixed-top','role'=>'navigation','style'=>'background-color: #a42a4e']) .
	$helper->tag('div',['class'=>'container col-lg-8 col-lg-offset-2']) .
		$helper->tag('div',['class'=>'navbar-header page-scroll']) .
			$helper->input(array('type'=>'button','name'=>'btn','attribs'=>array('class'=>'navbar-toggle','data-toggle'=>'collapse','data-target'=>'.navbar-main-collapse'))) .
				//$helper->tag('i',['class'=>'fa fa-bars']) . $helper->tag('/i') .
				$helper->a('/','',array('class'=>'navbar-brand')) .	
				$helper->tag('h1',['class'=>'navbar-brand','style'=>'color:#FFF']) . $data['ace_family_link']['val'] . $helper->tag('/h1') .
		$helper->tag('/div') .
		$helper->tag('div',['class'=>'collapse navbar-collapse navbar-right navbar-main-collapse']) ;
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
			
			//$helper->ul(array('class'=>'nav navbar-nav')) .
			//	$helper->ul()->rawItem($helper->a('#', $h($this->user->first_name), array('class'=>'dropdown-toggle','data-toggle'=>'dropdown')), array('class'=>'dropdown','style'=>'background-color: #a42a4e')) .
				//$helper->ul()->rawItem($helper->ul(array('class'=>'dropdown-menu'))).
			//	$helper->ul(array('class'=>'dropdown-menu')) .
			//		$helper->ul()->rawItems(array($helper->a('/pwd/change',$data['changed_pwd']) => array('style'=>'color:black'), $helper->a('/logout', $data['logout'])=>array('style'=>'color:black'))) .				
				
			
		}
		if(Session::get('lang')=='en'){
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
?>
<!-- <nav class="navbar navbar-custom navbar-fixed-top " role="navigation" style="background-color: #a42a4e">
    <div class="container col-lg-8 col-lg-offset-2">
        <div class="navbar-header page-scroll" >
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/" >
                <h1 style="color:#FFF">ACE FAMILY LINK</h1>
            </a>
        </div>
        <?php if( ! Sentry::check() ) { ?>
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse " style="background-color: #a42a4e">
            <ul class="nav navbar-nav">
                <li style="background-color: #a42a4e"><a href="/parent/login">Parents</a></li>
                <li class="active" style="background-color: #a42a4e"><a href="/teacher/login">Teachers</a></li> 
            </ul>
        </div>
        <?php } else { ?> 
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse ">
            <ul class="nav navbar-nav">
                <li class="dropdown" style="background-color: #a42a4e"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $h($this->user->first_name);?>&nbsp;<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="/pwd/change" style="color:black">Change Password</a></li>
                    <li><a href="/logout" style="color:black">Logout</a></li>
                </ul>
                </li>
            </ul>
        </div>
        <?php } ?>
    </div>
</nav>
-->
