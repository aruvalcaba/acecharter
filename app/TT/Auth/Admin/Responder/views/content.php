<?php
$data = $this->data;

echo 
// <!-- Section: main --> 
$helper->tag('main') .
$helper->tag('section',['class'=>'home-section text-center','id'=>'service']) .
    $helper->tag('div',['class'=>'container wow bounceInDown','data-wow-delay'=>'2s']) .
        $helper->tag('div',['class'=>'row']) . $helper->tag('h2') . $data['admin']['val'] . '&nbsp;' . $data['login']['val'] . $helper->tag('/h2') . $helper->tag('/div') .        
        $helper->tag('div',['class'=>'row']) .
            $helper->tag('div',['class'=>'col-xs-6 col-xs-offset-3 panel panel-success panel-login']) .
                $helper->tag('div',['class'=>'row']) . $helper->label($data['email_label']['val'])->before($helper->input($data['email_input'])) . $helper->tag('/div') .
                $helper->tag('div',['class'=>'row']) . $helper->label($data['pwd_label']['val'])->before($helper->input($data['pwd_input'])) . $helper->tag('/div') .
                $helper->tag('div',['class'=>'row']) . $helper->input($data['login_btn']) . $helper->tag('/div') .           
            $helper->tag('/div') .
        $helper->tag('/div') .
    $helper->tag('/div') . 
$helper->tag('/section') .
$helper->tag('/main') ;
?>
<!-- Section: main -->
<!--
<main>
<section id="service" class="home-section text-center">
    <div class="container">
            <div class="col-md-6 col-md-offset-3 panel panel-danger" style="padding: 0px 0px">
                <div class="panel-heading">
                    <h3 class="panel-title">Admin Login</h3>
                </div>
                <form class="panel-body form-horizontal">
                    <div class="form-group">
                    <div class="row-fluid">
                        <div class="col-xs-3 col-md-4">
                            <label style="text-center">Email</label>
                        </div>
                        <div class="col-xs-9 col-md-6">
                            <input class="form-control" type="email" id="email">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row-fluid">
                        <div class="col-xs-3 col-md-4">
                            <label style="text-center">Password</label>
                        </div>
                        <div class="col-xs-9 col-md-6">
                            <input class="form-control" type="password" id="password">
                        </div>
                    </div>
                    </div>
                </form>
                <div class="row-fluid" style="margin-bottom: 15px">
                    <a class="btn btn-default" style="background-color:#ff962f;" id="login" role="button">Log in</a>
                </div>
           </div>
       </div>
</section>
</main>
-->
