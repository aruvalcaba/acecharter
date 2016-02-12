<?php use Aura\Html\Escaper as e;

    $factory = new \Aura\Html\HelperLocatorFactory;
    $helper = $factory->newInstance();
    
    $h = $helper->escape()->html;
    $a = $helper->escape()->attr;
    $c = $helper->escape()->css;
    $j = $helper->escape()->js;
?>

<?php 
    //Meta
    echo $helper->metas(['charset'=>'utf-8'])->
                  addName('viewport','width=device-width, initial-scale=1.0')->
                  addName('description','ACE Charter Web Application')->
                  addName('author','Alan Ruvalcaba')->
                  addName('author email','aruval3@gmail.com');

    //Styles
    $helper->styles()->add('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
	$helper->styles()->add('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css');    
    $helper->styles()->add('/css/font-awesome.min.css');
    $helper->styles()->add('/css/animate.css');
    $helper->styles()->add('/css/style.css');
    $helper->styles()->add('/css/default.css');
    echo $helper->styles();
?> 
