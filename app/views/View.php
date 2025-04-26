<?php

class View {
    public function renderLayout($tpl, $pageData) {
        include ROOT . "/views/includes/header.tpl.php";
        include ROOT . $tpl;
        include ROOT . "/views/includes/footer.tpl.php";
    }
	public function render($tpl, $pageData) {
		include ROOT. $tpl;
	}
}