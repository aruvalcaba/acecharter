<main>
<?php 
echo 
$helper->tag('div',['class'=>'modal-body']) .
				$helper->tag('p',['class'=>'booktext']) . 'It is important that <student name> attend school regularly. Students that miss more than 10% of the school year, are at-risk for dropping out of high school and not graduating on time.' . $helper->tag('/p') .
				$helper->tag('p',['class'=>'booktext']) . 'Here are five things you can do at home to help <student name> make it school on-time, every time.
							<ul>
								<li>First thing</li>
								<li>Second thing</li>
								<li>Third thing</li>
								<li>Fourth thing</li>
								<li>Fifth thing</li>
							</ul>' . $helper->tag('/p') .
				
			$helper->tag('/div') ;
?>
			
</main>
