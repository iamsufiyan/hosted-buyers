<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['dashboard'] = 'Admin_registration/dashboard';
$route['add-buyers'] = 'Admin_registration/buyers';
$route['add-sellers'] = 'Admin_registration/seller';
$route['add-admin'] = 'Admin_registration/addadmin';
$route['add-event'] = 'Admin_registration/addevent';
$route['registration-type'] = 'Admin_registration/regtype';
$route['log-out'] = 'Admin_registration/logout';
$route['insert-admin'] = 'Admin_registration/insert_admin';
$route['insert-seller'] = 'Admin_registration/insert_seller';
$route['update-seller'] = 'Admin_registration/updateseller';
$route['update-buyer'] = 'Admin_registration/updatebuyer';
$route['insert-buyer'] = 'Admin_registration/insert_buyer';
$route['insert-event'] = 'Admin_registration/insert_event';
$route['update-buyer-password'] = 'Admin_registration/insert_buyer_password';
$route['update-seller-password'] = 'Admin_registration/insert_seller_password';
$route['buyer-login'] = 'Buyers_login/dashboard';
$route['buyer-dashboard'] = 'Buyers_login/home';
$route['buyer-log-out'] = 'Buyers_login/logout';
$route['add-profile'] = 'Buyers_login/add_profile';
$route['insert-profile'] = 'Buyers_login/insert_profile';
$route['change-password'] = 'Buyers_login/change_password';
$route['upload-image'] = 'Buyers_login/upload_file';

$route['seller-login'] = 'Sellers_login/dashboard';
$route['seller-dashboard'] = 'Sellers_login/home';
$route['seller-log-out'] = 'Sellers_login/logout';
$route['seller-add-profile'] = 'Sellers_login/add_profile';
$route['insert-seller-profile'] = 'Sellers_login/insert_profile';
$route['add-appointment'] = 'Admin_registration/add_appointment';
$route['insert-appoint'] = 'Admin_registration/insert_appoint';
$route['view-appointment'] = 'Admin_registration/view_appoint';
$route['view-slot'] = 'Admin_registration/view_slot';
$route['view-sellers'] = 'Buyers_login/view_seller';
$route['buyer-booking'] = 'Buyers_login/booking';
$route['confirm-booking'] = 'Buyers_login/booking_insert';
$route['farm'] = 'Admin_registration/farm_home';
$route['view-farm'] = 'Buyers_login/view_farm';
$route['upload-image-seller'] = 'Sellers_login/upload_file';