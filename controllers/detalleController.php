<?php 

	// crea el objeto con la vista
	$tpl = new Kiwi("detalle");
	// carga la vista
	$tpl->loadTPL();
   
	$vars = ["PROJECT_SECTION" => "Detalle"];
	$tpl->setVarsTPL($vars);
	// imprime en la vista en la página
	$tpl->printTPL();