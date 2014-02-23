<?php

define('VIEW_DIR', APPLICATION_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);

class View {

    public $layout = null;
    public $view = null;
    public $data = array();
    public $css = array();
    public $js = array();

    public function setView($view) {
        $this->view = VIEW_DIR . $view;
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function setData($key, $val) {
        $this->data[$key] = $val;
    }

    public function loadCss($css) {
        $this->css[] = $css;
    }

    public function loadJs($js) {
        $this->js[] = $js;
    }

    public function render() {
        if ($this->layout)
            require VIEW_DIR . $this->layout;
    }

    public function renderViewGetContent($view) {
        $view = VIEW_DIR . $view;
        if (!file_exists($view))
            return false;
        ob_start();
        require $view;
        $out = ob_get_contents();
        ob_end_clean();
        return $out;
    }

}
