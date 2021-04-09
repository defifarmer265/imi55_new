<?php
defined('BASEPATH') OR exit('No direct script access allowed');


 $route['default_controller'] = getenv('default_controller');


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['หน้าแรก']="web/index";
$route['ฟุตบอล']="web/sports";
$route['บาคาร่า']="web/casino";
$route['เกมส์สล็อต']="web/game";
$route['ไก่ชนไทย']="web/Cockfight";
$route['หวยไทย']="web/lotto";
$route['โปรโมชั่น']="web/promotion";
$route['บทความฟุตบอล']="web/football";
$route['วิธีการสมัครIMI55']="web/Register";
$route['วิธีการการฝากเงิน']="web/how_to_deposit";
$route['วิธีการถอนเงิน']="web/withdrawal_method";
$route['ผลบอลสด']="web/live_score";
$route['รายละเอียดบทความ']="web/football_detail";
$route['privacy']="web/privacy";
$route['วิธีการดาวน์โหลดแอปIOS'] = 'web/APP_IOS';
$route['วิธีการดาวน์โหลดแอปAandroid'] = 'web/APP_Aandroid';
$route['ช่วงเวลาปิดปรับปรุง'] = 'web/under_maintenance';
$route['บทความบาคาร่า'] = 'web/bacarar';

$route['api/(:any)'] = 'api/$1';
$route['backend/(:any)'] = 'backend/$1';
$route['sale/(:any)'] = 'sale/$1';


