<?php

function cat_get_template_file_e($template, $data = array()){
    extract($data);
    $template_file = cat_get_template_file($template);
    if ($template_file !== false) {
        ob_start();
        include $template_file;
        echo ob_get_clean();
    }
}

function cat_get_template_file__($template, $data = array()){
    extract($data);
    $template_file = cat_get_template_file($template);
    if ($template_file !== false) {
        ob_start();
        include $template_file;
        return ob_get_clean();
    }
    return false;
}

function cat_get_template_file($template, $dir = null){

    if ($dir === null) {
        $dir = CAT_THEME_TEMPLATES_DIR;
    }

    $template_file = get_template_directory() . DIRECTORY_SEPARATOR . $dir  .DIRECTORY_SEPARATOR. $template;

    if (file_exists($template_file)) {
        return $template_file;
    } else {
        $template_file = CAT_PLUGIN_TEMPLATES_PATH . DIRECTORY_SEPARATOR . $template;
        if (file_exists($template_file)) {
            return $template_file;
        }
    }

    return false;
}
