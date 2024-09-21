<?php 

	// crea el objeto con la vista
	$tpl = new Kiwi("landing");

	// carga la vista
	$tpl->loadTPL();
	$vars = ["PROJECT_SECTION" => "Landing"];

	$tpl->setVarsTPL($vars);
	// imprime en la vista en la página
	$tpl->printTPL();