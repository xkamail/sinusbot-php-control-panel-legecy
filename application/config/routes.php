<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'PageManager/view';
$route['api/getpage/(:any)'] = 'App/PageController/index/$1';
$route['api/(:any)/(:any)'] = 'App/$1/$2';
$route['control/(:any)/(:any)'] = 'Controller/$2/$1';
$route['api/payment/checktrue/(:any)'] = 'App/payment/truemoney_status/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
