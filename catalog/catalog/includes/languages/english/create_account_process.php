<?php
/*
  $Id: create_account_process.php,v 1.6 2001/06/03 18:08:50 dwatkins Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Create an Account');
define('NAVBAR_TITLE_2', 'Process');
define('TOP_BAR_TITLE', 'Create an Account');
define('HEADING_TITLE', 'My Account Information');
define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>NOTE:</b></font></small> If you already have an account with us, please login at the <a href="' . tep_href_link(FILENAME_LOGIN, 'origin=checkout_address', 'NONSSL') . '"><u>login page</u></a>.');

define('EMAIL_WELCOME', '*** Note: This email address was given to us by one of our customers. If you did not signup to be a member, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n" . 'Dear %s %s,' . "\n\n" . 'We welcome you to ' . STORE_NAME . '! You can now take part in the various services we have to offer you. Some of these services include;' . "\n\n" . '* Permanent Cart - Any products added to your online cart remain there until you remove them, or check them out..' . "\n" . '* Address Book - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves..' . "\n" . '* Order History - View your history of purchases that you have made with us..' . "\n" . '* Product Reviews - Share your opinions on products with our other customers..' . "\n\n" . 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WELCOME_SUBJECT', 'Welcome to ' . STORE_NAME . '!');
?>
