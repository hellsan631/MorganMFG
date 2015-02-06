<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['downloadfloorplan'] = "catering/downloadFile";

$route['listings/active'] = "listings/index/active";
$route['listings/rented'] = "listings/index/rented";

$route['space'] = "spaces";
$route['space/detail'] = "spaces/detail";
$route['space/detail/(:any)'] = "spaces/detail/$1";

$route['page/add'] = "page/add";
$route['page/all'] = "page/all";
$route['page/all/(:any)'] = "page/all/$1";
$route['page/all/(:any)/(:any)'] = "page/all/$1/$2";
$route['page/all/(:any)/(:any)/(:any)'] = "page/all/$1/$2/$3";

$route['page/header'] = "page/header";
$route['page/header/(:any)'] = "page/header/$1";

$route['page/edit/(:any)'] = "page/edit/$1";

$route['page/delete/(:any)'] = "page/delete/$1";

$route['page/(:any)'] = "page/index/$1";


$route['contact'] = "contactus";
$route['contact/(:any)'] = "contactus/$1";
$route['contact/(:any)/(:any)'] = "contactus/$1/$2";
$route['contact/(:any)/(:any)/(:any)'] = "contactus/$1/$2/$3";
$route['contact/(:any)/(:any)/(:any)/(:any)'] = "contactus/$1/$2/$3/$4";
$route['contact/(:any)/(:any)/(:any)/(:any)/(:any)'] = "contactus/$1/$2/$3/$4/$5";
$route['contact/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "contactus/$1/$2/$3/$4/$5/$6";


/* End of file routes.php */
/* Location: ./application/config/routes.php */