<?php
/*
  The Exchange Project - Community Made Shopping!

  $Id: application_top.php,v 1.95 2001/03/21 17:30:55 tmoulton Exp $
*/

  if (file_exists('includes/local/configure.php')) {
    include('includes/local/configure.php');
    if ((!defined(CONFIGURE_STATUS_COMPLETED)) && (CONFIGURE_STATUS_COMPLETED != '1')) { // File not read properly
       die('File configure.php was not found or was improperly formatted, contact webmaster of this domain.<br>The configuration file in catalog/includes/local/configure.php was not properly formatted.<br>&nbsp;<br>Please add the following to that file:<br>&nbsp;<br>define(\'CONFIGURE_STATUS_COMPLETED\', \'1\');');
    }
  }

// for internal use until final v1.0 version is ready
  define('PROJECT_VERSION', 'Preview Release 2.1');

// define our webserver variables
// FS = Filesystem (physical)
// WS = Webserver (virtual)
  define('HTTP_SERVER', 'http://exchange');
  define('HTTPS_SERVER', 'https://exchange');
  define('ENABLE_SSL', 1); // ssl server enable(1)/disable(0)
  define('DIR_FS_DOCUMENT_ROOT', $DOCUMENT_ROOT . '/');
  define('DIR_FS_LOGS', '/usr/local/apache/logs/');
  define('DIR_WS_CATALOG', '/catalog/');
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_PAYMENT_MODULES', DIR_WS_MODULES . 'payment/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');

// default values
  define('DEFAULT_LANGUAGE', 'en'); // use the code
  define('DEFAULT_CURRENCY', 'USD'); // use the code

// who to send order confirmation emails to.. there is always one being sent to the customer, so there
// is no need to add their address to the following constant..
// use comma's to separate email addresses (as in the example)
//  define('SEND_EXTRA_ORDER_EMAILS_TO', 'root <root@localhost>, root <root@localhost>');

  define('EXIT_AFTER_REDIRECT', 1); // if enabled, the parse time will not store its time after the header(location) redirect - used with tep_exit();
  define('STORE_PAGE_PARSE_TIME', 0); // store the time it takes to parse a page
  define('STORE_PAGE_PARSE_TIME_LOG', DIR_FS_LOGS . 'exchange/parse_time_log');

  define('STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S');
  if (STORE_PAGE_PARSE_TIME == '1') {
    $parse_start_time = microtime();
  }
  define('STORE_DB_TRANSACTIONS', 0);

// define the filenames used in the project
  define('FILENAME_NEW_PRODUCTS', 'new_products.php'); // This is the middle of default.php (found in modules)
  define('FILENAME_UPCOMING_PRODUCTS', 'upcoming_products.php'); // This is the bottom of default.php (found in modules)
  define('FILENAME_ALSO_PURCHASED_PRODUCTS', 'also_purchased_products.php'); // This is the bottom of product_info.php (found in modules)
  define('FILENAME_ACCOUNT', 'account.php');
  define('FILENAME_ACCOUNT_EDIT', 'account_edit.php');
  define('FILENAME_ACCOUNT_EDIT_PROCESS', 'account_edit_process.php');
  define('FILENAME_ACCOUNT_HISTORY', 'account_history.php');
  define('FILENAME_ACCOUNT_HISTORY_INFO', 'account_history_info.php');
  define('FILENAME_ADDRESS_BOOK', 'address_book.php');
  define('FILENAME_ADDRESS_BOOK_PROCESS', 'address_book_process.php');
  define('FILENAME_ADVANCED_SEARCH', 'advanced_search.php');
  define('FILENAME_ADVANCED_SEARCH_RESULT', 'advanced_search_result.php');
  define('FILENAME_CHECKOUT_ADDRESS', 'checkout_address.php');
  define('FILENAME_CHECKOUT_CONFIRMATION', 'checkout_confirmation.php');
  define('FILENAME_CHECKOUT_PAYMENT', 'checkout_payment.php');
  define('FILENAME_CHECKOUT_PROCESS', 'checkout_process.php');
  define('FILENAME_CHECKOUT_SUCCESS', 'checkout_success.php');
  define('FILENAME_CONTACT_US', 'contact_us.php');
  define('FILENAME_CREATE_ACCOUNT', 'create_account.php');
  define('FILENAME_CREATE_ACCOUNT_PROCESS', 'create_account_process.php');
  define('FILENAME_CREATE_ACCOUNT_SUCCESS', 'create_account_success.php');
  define('FILENAME_DEFAULT', 'default.php');
  define('FILENAME_INFO_SHOPPING_CART', 'info_shopping_cart.php');
  define('FILENAME_LOGIN', 'login.php');
  define('FILENAME_LOGIN_CREATE', 'login_create.php');
  define('FILENAME_LOGOFF', 'logoff.php');
  define('FILENAME_PASSWORD_FORGOTTEN', 'password_forgotten.php');
  define('FILENAME_PRODUCT_INFO', 'product_info.php');
  define('FILENAME_PRODUCT_REVIEWS', 'product_reviews.php');
  define('FILENAME_PRODUCT_REVIEWS_INFO', 'product_reviews_info.php');
  define('FILENAME_PRODUCT_REVIEWS_WRITE', 'product_reviews_write.php');
  define('FILENAME_REVIEWS', 'reviews.php');
  define('FILENAME_SHOPPING_CART', 'shopping_cart.php');
  define('FILENAME_SPECIALS', 'specials.php');
  define('FILENAME_PASSWORD_CRYPT', 'password_funcs.php');

// define our database connection
  define('DB_SERVER', 'exchange');
  define('DB_SERVER_USERNAME', 'mysql');
  define('DB_SERVER_PASSWORD', '');
  define('DB_DATABASE', 'catalog');
  define('USE_PCONNECT', 1);

// customization for the design layout
  define('CART_DISPLAY', 1); // Enable to view the shopping cart after adding a product
  define('TAX_VALUE', 16); // propducts tax
  define('TAX_DECIMAL_PLACES', 0); // 16% - If this were 2 it would be 16.00%
  define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)

  define('HEADER_BACKGROUND_COLOR', '#AABBDD');
  define('HEADER_NAVIGATION_BAR_BACKGROUND_COLOR', '#000000');
  define('HEADER_NAVIGATION_BAR_BACKGROUND_ERROR_COLOR', '#FF0000');
  define('HEADER_NAVIGATION_BAR_BACKGROUND_INFO_COLOR', '#00FF00');
  define('HEADER_NAVIGATION_BAR_FONT_ERROR_COLOR', '#FFFFFF');
  define('HEADER_NAVIGATION_BAR_FONT_INFO_COLOR', '#000000');

  define('FOOTER_BAR_BACKGROUND_COLOR', '#000000');

  define('BOX_HEADING_BACKGROUND_COLOR', '#AABBDD');

  define('BOX_CONTENT_BACKGROUND_COLOR', '#FFFFFF');
  define('BOX_CONTENT_HIGHLIGHT_COLOR', '#FFFF33');     // use in best_sellers.php

  define('TOP_BAR_BACKGROUND_COLOR', '#AABBDD');
  define('SUB_BAR_BACKGROUND_COLOR', '#f4f7fd');
  define('TABLE_ROW_BACKGROUND_COLOR', '#ffffff');
  define('TABLE_ALT_BACKGROUND_COLOR', '#f4f7fd');

  define('SPECIALS_PRICE_COLOR', '#FF0000'); // font color for the new price of products on special

  define('CHECKOUT_BAR_TEXT_COLOR', '#AABBDD');
  define('CHECKOUT_BAR_TEXT_COLOR_HIGHLIGHTED', '#000000');

// set to "1" if extended email check function should be used
// If you're testing locally and your webserver has no possibility to query 
// a dns server you should set this to "0" !
  define('ENTRY_EMAIL_ADDRESS_CHECK', 0); 

// Control what fields of the customer table are used
  define('ACCOUNT_GENDER', 1);
  define('ACCOUNT_DOB', 1);
  define('ACCOUNT_SUBURB', 1);
  define('ACCOUNT_STATE', 1);

// Advanced Search controls
  define('ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and'); // default boolean search operator: or/and
  define('ADVANCED_SEARCH_DISPLAY_TIPS', 1); // Display Advanced Search Tips at the bottom of the page: 0=disable; 1=enable

// Bestsellers Min/Max Controls 
  define('MIN_DISPLAY_BESTSELLERS', 1);    // Min no. of bestsellers to display
  define('MAX_DISPLAY_BESTSELLERS', 10);   // Max no. of bestsellers to display

// Min/Max Controls for also_purchased_products.php : 'Customers who bought this product also purchased' module
  define('MIN_DISPLAY_ALSO_PURCHASED', 1);   // Min no. of products in purchased list to qualify
  define('MAX_DISPLAY_ALSO_PURCHASED', 5);   // Max no. of products to display

// Prev/Next Navigation Bar location
  define('PREV_NEXT_BAR_LOCATION', 2) ;    // 1 - top, 2 - bottom, 3 - both

// Manufacturers box
  define('DISPLAY_MANUFACTURERS_BOX', 1); // Manufacturers Box: 0=disable; 1=enable
  define('DISPLAY_EMPTY_MANUFACTURERS', 1); // Display Manufacturers with no products: 0=disable; 1=enable

// Rollover Effect
  define('USE_ROLLOVER_EFFECT', 1); // Rollover Effect: 0=disable; 1=enable

// Categories Box: recursive products count
  define('SHOW_COUNTS', 1); // show category count: 0=disable; 1=enable
  define('USE_RECURSIVE_COUNT', 1); // recursive count: 0=disable; 1=enable

// include cache class - only for PHP4
  $CACHE_DEBUG = 0;     /* Default: 0 - Turn debugging on/off */
  define(CACHE_ON, 0); /* Default: 0 - Turn caching on/off */
  define(CACHE_DIR, '/tmp/'); /* Default: /tmp/ - Default cache directory */
  define(CACHE_GC, .10); /* Default: .10 - Probability of garbage collection */

  $include_file = DIR_WS_CLASSES . 'cache.php'; include(DIR_WS_INCLUDES . 'include_once.php');
  $cache = new phpCache;

// include the database functions
  $include_file = DIR_WS_FUNCTIONS . 'database.php';  include(DIR_WS_INCLUDES . 'include_once.php');

// make a connection to the database... now
  tep_db_connect() or die('Unable to connect to database server!');

// include shopping cart class
  $include_file = DIR_WS_CLASSES . 'shopping_cart.php'; include(DIR_WS_INCLUDES . 'include_once.php');

// some code to solve compatibility issues
  $include_file = DIR_WS_FUNCTIONS . 'compatibility.php'; include(DIR_WS_INCLUDES . 'include_once.php');

// check to see if php implemented session management functions - if not, include php3/php4 compatible session class
  if (!function_exists('session_start')) {
    $include_file = DIR_WS_CLASSES . 'sessions.php'; include(DIR_WS_INCLUDES . 'include_once.php');
  }

// define how the session functions will be used
  $include_file = DIR_WS_FUNCTIONS . 'sessions.php';  include(DIR_WS_INCLUDES . 'include_once.php');

// lets start our session
  if (!SID && $HTTP_GET_VARS[tep_session_name()]) tep_session_id($HTTP_GET_VARS[tep_session_name()]);
  tep_session_start();
  if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, DIR_WS_CATALOG);
  }

// Create the cart & Fix the cart if necesary
  if ($cart) {
    if (!eregi('^4\.', phpversion()) || eregi('^4.0b2', phpversion())) {
      $broken_cart = $cart;
      $cart = new shoppingCart;
      $cart->unserialize($broken_cart);
    }
  } else {
    tep_session_register('cart');
    $cart = new shoppingCart;
  }

// set the application parameters (can be modified through the administration tool)
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from configuration');
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }

// define our general functions used application-wide
  $include_file = DIR_WS_FUNCTIONS . 'general.php'; include(DIR_WS_INCLUDES . 'include_once.php');

// include the who's online functions
  $include_file = DIR_WS_FUNCTIONS . 'whos_online.php'; include(DIR_WS_INCLUDES . 'include_once.php');
  tep_update_whos_online();

// language
  if ( (!$language) || ($HTTP_GET_VARS['language']) ) {
    if (!$language) tep_session_register('language');

    $language = tep_get_languages_directory($HTTP_GET_VARS['language']);
    if (!$language) $language = tep_get_languages_directory(DEFAULT_LANGUAGE);
  }

// currency
  if ( (!$currency) || ($HTTP_GET_VARS['currency']) ) {
    if (!$currency) tep_session_register('currency');

    $currency = tep_currency_exists($HTTP_GET_VARS['currency']);
    if (!$currency) $currency = DEFAULT_CURRENCY;
  }

// include the currency rates, and the language translations
  $include_file = DIR_WS_INCLUDES . 'data/rates.php'; include(DIR_WS_INCLUDES . 'include_once.php');
  $include_file = DIR_WS_LANGUAGES . $language . '.php'; include(DIR_WS_INCLUDES . 'include_once.php');

// Include the password crypto functions
 $include_file = DIR_WS_FUNCTIONS . FILENAME_PASSWORD_CRYPT; include(DIR_WS_INCLUDES . 'include_once.php'); 

// Include validation functions (right now only email address)
 $include_file = DIR_WS_FUNCTIONS . 'validations.php'; include(DIR_WS_INCLUDES . 'include_once.php'); 

// split-page-results
  $include_file = DIR_WS_CLASSES . 'split_page_results.php'; include(DIR_WS_INCLUDES . 'include_once.php');

// infobox
  $include_file = DIR_WS_CLASSES . 'boxes.php'; include(DIR_WS_INCLUDES . 'include_once.php');

// Shopping cart actions
  if ($HTTP_GET_VARS['action']) {
    $goto = (CART_DISPLAY) ? FILENAME_SHOPPING_CART : basename($PHP_SELF);
    $parameters = (CART_DISPLAY) ? array('action', 'cPath', 'products_id') : array('action');
    if ($HTTP_GET_VARS['action'] == 'remove_product') {
      // customer wants to remove a product from their shopping cart
      $cart->remove($HTTP_GET_VARS['products_id']);
      header('Location: ' . tep_href_link($goto, tep_get_all_get_params($parameters), 'NONSSL')); 
      tep_exit();
    } elseif ($HTTP_GET_VARS['action'] == 'add_update_product') {
      // customer wants to update the product quantity in their shopping cart
      if ((is_array($HTTP_POST_VARS['cart_quantity'])) && (is_array($HTTP_POST_VARS['products_id']))) {
        for ($i=0; $i<sizeof($HTTP_POST_VARS['products_id']);$i++) {
          $attributes = ($HTTP_POST_VARS['id'][$HTTP_POST_VARS['products_id'][$i]]) ? $HTTP_POST_VARS['id'][$HTTP_POST_VARS['products_id'][$i]] : '';
          $cart->add_cart($HTTP_POST_VARS['products_id'][$i], $HTTP_POST_VARS['cart_quantity'][$i], $attributes);
        }
      } else {
        if (ereg('^[0-9]+$', $HTTP_POST_VARS['products_id'])) {
          $cart->add_cart($HTTP_POST_VARS['products_id'], $HTTP_POST_VARS['cart_quantity'], $HTTP_POST_VARS['id']);
        }
      }
      header('Location: ' . tep_href_link($goto, tep_get_all_get_params($parameters), 'NONSSL'));
      tep_exit();
    } elseif ($HTTP_GET_VARS['action'] == 'remove_all') {
      // customer wants to remove all products from their shopping cart
      $cart->reset(TRUE);
      header('Location: ' . tep_href_link($goto, '', 'NONSSL')); 
      tep_exit();
    } elseif ($HTTP_GET_VARS['action'] == 'add_a_quickie') {
      // customer wants to add a quickie to the cart (called from a box)
      $quickie_query = tep_db_query("select products_id from products where products_model = '" . $HTTP_POST_VARS['quickie'] . "'");
      if (tep_db_num_rows($quickie_query) == 0) {
        $quickie_query = tep_db_query("select products_id from products where products_model LIKE '" . $HTTP_POST_VARS['quickie'] . "%'");
      }
      if (tep_db_num_rows($quickie_query) == 0 ||tep_db_num_rows($quickie_query) > 1) {
        Header( 'Location: ' . tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, 'keywords=' . $HTTP_POST_VARS['quickie'], 'NONSSL'));
        tep_exit();
      }
      $quickie_values = tep_db_fetch_array($quickie_query);
      $cart->add_cart($quickie_values['products_id'], 1, '');
      header('Location: ' . tep_href_link($goto, tep_get_all_get_params(array('action')), 'NONSSL')); 
      tep_exit();
    }
  }

// calculate category path
  $cPath = $HTTP_GET_VARS['cPath'];
  if (strlen($cPath) > 0) {
    $cPath_array = explode('_', $cPath);
    if (sizeof($cPath_array) > 1) {
      $current_category_id = $cPath_array[(sizeof($cPath_array)-1)];
    } else {
      $current_category_id = $cPath_array[0];
    }
  } else {
    $current_category_id = 0;
  }
?>
