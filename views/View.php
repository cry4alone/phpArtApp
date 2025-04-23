<?php

class View {
    public function renderLayout($tpl, $pageData) {
        include ROOT . "/views/layout/header.tpl.php";
        include ROOT . $tpl;
        include ROOT . "/views/layout/footer.tpl.php";

    }
	public function render($tpl, $pageData) {
		include ROOT. $tpl;
	}
}