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

$route['default_controller'] = "signUp";
$route['404_override'] = '';

$route['dashBoard'] = 'dashBoard/submit';
$route['subscribe/course_for/organization/(:num)'] = 'subscribeCourse/add_org_enrollment/$1';
$route['members_of_organization/(:any)'] = 'organizationSignup/view_members/$1';
$route['enroll_course'] = 'dashBoard/add_courses';
$route['deactivate_course']='dashBoard/deactivate';
$route['activate_course'] = '/dashBoard/activate';
$route['unenroll_course']= '/dashBoard/delete_course';
$route['logout']='loginValidation/logout';
//$route['organization/(:num)/member/(:num)/enrollment/(:num)/course/(:num)'] = 'organisation_member/member_enrolment_course/$1/$2/$3/$4';
/* End of file routes.php */
/* Location: ./application/config/routes.php */