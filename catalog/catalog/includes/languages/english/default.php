<?
/*
English Text for The Exchange Project Preview Release 1.1
Last Update: 14/05/2000
Author(s): Harald Ponce de Leon (hpdl@theexchangeproject.org)
*/

define('TEXT_MAIN', 'Welcome to \'' . STORE_NAME . '\'! This is a demonstration online-shop, <b>any products purchased will not be delivered nor billed</b>. Any information seen on these products are to be treated fictional.<br><br>If you wish to download this sample shop, or to contribute to this project, please visit the <a href="http://theexchangeproject.org"><u>support site</u></a>. This shop is based on the upcoming Preview Release 2 - which will be made available to download when it is complete. Preview Release 1 is available to download at the support site.<br><br>All outgoing emails sent from this online demonstration has been disabled.');
define('TABLE_HEADING_NEW_PRODUCTS', 'New Products For %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Upcoming Products');
define('TABLE_HEADING_DATE_EXPECTED', 'Date Expected');

if (@$HTTP_GET_VARS['category_id']) {
  define('TOP_BAR_TITLE', 'New Products In This Category');
  define('HEADING_TITLE', 'Whats New Here?');
  define('SUB_BAR_TITLE', 'Categories');
} else {
  define('TOP_BAR_TITLE', 'Welcome To \'' . STORE_NAME . '\'!');
  define('HEADING_TITLE', 'Whats New Here?');
  define('SUB_BAR_TITLE', strftime(DATE_FORMAT_LONG, mktime(0,0,0,2,6,2000)));
}
?>