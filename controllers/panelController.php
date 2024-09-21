<?php 

	// crea el objeto con la vista
	$tpl = new Kiwi("panel");
    
	// carga la vista
	$tpl->loadTPL();

	$vars = ["PROJECT_SECTION" => "Panel"];

	// reemplaza las variables en la vista
	$tpl->setVarsTPL($vars);
	// imprime en la vista en la página
	$tpl->printTPL();