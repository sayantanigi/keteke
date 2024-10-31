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
$route['404_override'] = 'welcome/error_page';
$route['translate_uri_dashes'] = TRUE;
/*------------Marketplace FrontEnd Routes----------*/
$route['search?(:any)'] = 'shop/search_product/$1';
$route['products?(:any)'] = 'shop/pr_list/$1';
$route['product-details/(:any)'] = 'shop/pr_details/$1';
$route['shophome'] = 'shop/index';
/*------------FrontEnd Routes----------*/
$route['reach'] = 'welcome/contact';
$route['about'] = 'welcome/about_us';
$route['list-your-business'] = 'user/listingcreate'; 

$route['how-it-works'] = 'welcome/how_work';
$route['frequently-asked-questions'] = 'welcome/faq';  
$route['support'] = 'welcome/contact';
$route['privacy-policy'] = 'welcome/privacy';
$route['terms'] = 'welcome/terms';
$route['refund-policy'] = 'welcome/refundpolicy';

$route['login'] = 'welcome/login_ajax';
$route['signup'] = 'welcome/signin_signup'; 
$route['forgot-password'] = 'user/forget_password';
$route['update-forgot-password/(:any)'] = 'user/update_password/$1';

$route['service-list']='welcome/search_list';
/*------------Business owner/service provider/seller dashboard Routes----------*/
$route['signout'] = 'welcome/sign_out';
$route['myprofile'] = 'user/edit_profile';
$route['mydashboard'] = 'user/edit_profile';
/*------------userEnd Routes----------*/
$route['userdashboard']='user/edit_profile'; 

$route['mylistings'] = 'user/view_listing';
$route['remove-list/(:any)'] = 'user/listing_delete/$1';
$route['update-list/(:any)'] = 'user/edit_listing/$1';
$route['change-password'] = 'welcome/changepass';
/*-----seller routes-------*/
$route['seller-dashboard']='shop/sellerdashboard';
$route['add-product']='shop/seller_addproduct';
$route['seller-orders']='shop/sellerorders';
$route['view-products']='shop/sellerproductlisting';
$route['view-product/(:any)'] = 'shop/view_product/$1';
$route['edit-product/(:any)'] = 'shop/seller_editproduct/$1';
$route['Deleteproduct/(:any)'] = 'shop/delete_product/$1';

$route['account-settings']='seller/seller_accountsettings';
$route['sellercustomer-add']='seller/customer_add';
$route['seller-customers']='seller/view_customers';
$route['edit-customer/(:any)']='seller/customeredit/$1';
$route['view-orders/(:any)']='seller/view_order/$1';
$route['sellerDelete-customer/(:any)']='seller/customerdelete/$1';
$route['abandoned-checkouts']='seller/abandoned_Userproduct';
$route['viewabandoned-orders/(:any)']='seller/view_abandonorders/$1';
$route['draft-orders']='seller/draftorders';
$route['create-draftorder']='seller/create_draftorder';
$route['view-draftorders/(:any)']='seller/view_draftorder/$1';


/*---------------Pages-----------------*/
$route['pages/(:any)'] = 'pages/index/$1';
/*------------Admin Routes------------*/
$route['admin'] = 'admin/users';
$route['dashboard'] = 'admin/dashboard/index';

