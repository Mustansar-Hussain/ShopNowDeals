<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */
// $route['default_controller'] = 'Home';
// $route['404_override'] = 'home/index';
// $route['admin'] = 'admin/user/index';
// $route['login'] = 'users/login';
// $route['dashboard'] = 'admin/dashboard/index';
// $route['default_controller'] = "Home";
// $route['admin/maintain'] = "admin/dashboard/maintain";
// $route["report_specialprograms/(:any)"] = "admin/report_specialprograms/report/$1";
// $route["report_roster/(:any)"] = "admin/report_roster/report/$1";
// $route["fullunitsummary/(:any)"] = "admin/report/fullunitsummary/$1";
// $route["report_prepaid/(:any)"] = "admin/report/prepaid/$1";
// //Camp Admin
// $route['CampAdmin/maintain'] = "CampAdmin/dashboard/maintain";
// $route["CampAdmin_report_roster/(:any)"] = "CampAdmin/report_roster/report/$1";
// $route["CampAdmin_fullunitsummary/(:any)"] = "CampAdmin/report/fullunitsummary/$1";
// $route['404_override'] = '';

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;