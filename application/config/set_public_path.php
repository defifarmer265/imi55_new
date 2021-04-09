<?php

$CI =& get_instance();

$config['root_url'] = $CI->config->base_url().'/public/';

// =============== tem_frontend =======================
$config['tem_frontend'] = $config['root_url'] . 'tem_frontend/';
$config['tem_frontend_css'] = $config['tem_frontend'] . 'css/';
$config['tem_frontend_fonts'] = $config['tem_frontend'] . 'fonts/';
$config['tem_frontend_img'] = $config['tem_frontend'] . 'img/';
$config['tem_frontend_js'] = $config['tem_frontend'] . 'js/';
$config['tem_frontend_scss'] = $config['tem_frontend'] . 'scss/';
$config['tem_frontend_vendors'] = $config['tem_frontend'] . 'vendors/';
// =============== END tem_frontend =======================
$config['tem_frontend_mobile'] = $config['tem_frontend'] . 'mobile/';


// =============== tem_admin ==============================
$config['tem_admin'] = $config['root_url'] . 'tem_admin/';
$config['tem_admin_css'] = $config['tem_admin'] . 'css/';
$config['tem_admin_font'] = $config['tem_admin'] . 'font/';
$config['tem_admin_img'] = $config['tem_admin'] . 'img/';
$config['tem_admin_js'] = $config['tem_admin'] . 'js/';

$config['tem_backend_vendors'] = $config['tem_admin'] . 'vendors/';


// =============== END tem_admin ==============================

?>
