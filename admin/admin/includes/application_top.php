<?
  if (file_exists('includes/local/configure.php')) {
    include('includes/local/configure.php');
    if (!CONFIGURE_STATUS_COMPLETED) { // File not read properly
       die('File configure.php was not found or was improperly formatted, contact webmaster of this domain.<br>The configuration file in catalog/includes/local/configure.php was not properly formatted.');
    }
  }

// for internal use until final v1.0 version is ready
  define('PROJECT_VERSION', 'Preview Release 2.1');

// expert mode?
  define('EXPERT_MODE', '0'); // enable if you know what your doing with the database structure

// define our webserver variables
// FS = Filesystem (physical)
// WS = Webserver (virtual)
  define('HTTP_SERVER', '');
  define('DIR_FS_DOCUMENT_ROOT', $DOCUMENT_ROOT); // where your pages are located on the server.. needed to delete images.. (eg, /usr/local/apache/htdocs)
  define('DIR_FS_LOGS', '/usr/local/apache/logs/');
  define('DIR_WS_ADMIN', '/admin/');
  define('DIR_WS_CATALOG', '/catalog/');
  define('DIR_FS_CATALOG', DIR_FS_DOCUMENT_ROOT . DIR_WS_CATALOG);
  define('DIR_WS_IMAGES', DIR_WS_ADMIN . 'images/');
  define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG . 'images/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
  define('DIR_WS_CATALOG_LANGUAGES', DIR_WS_CATALOG . 'includes/languages/');
  define('DIR_FS_PAYMENT_MODULES', DIR_FS_DOCUMENT_ROOT . DIR_WS_CATALOG . 'includes/modules/payment/');
  define('DIR_FS_SHIPPING_MODULES', DIR_FS_DOCUMENT_ROOT . DIR_WS_CATALOG . 'includes/modules/shipping/');

// default localization values
  define('DEFAULT_LANGUAGE', 'en'); // codes are in the "languages" database table

  define('STORE_NAME', 'The Exchange Project');
  define('STORE_COUNTRY', 81); // Germany is 81, USA is 223

  define('EXIT_AFTER_REDIRECT', 1); // if enabled, the parse time will not store its time after the header(location) redirect - used with tep_tep_exit();
  define('STORE_PAGE_PARSE_TIME', 0); // store the time it takes to parse the page
  define('STORE_PAGE_PARSE_TIME_LOG', DIR_FS_LOGS . 'exchange/parse_time_log');

  define('STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S');
  if (STORE_PAGE_PARSE_TIME == '1') {
    $parse_start_time = microtime();
  }
  define('STORE_DB_TRANSACTIONS', 0);

// define the filenames used in the project
  define('FILENAME_BACKUP', 'backup.php');
  define('FILENAME_BANNERS_MANAGER', 'banner_manager.php');
  define('FILENAME_CATEGORIES', 'categories.php');
  define('FILENAME_CONFIGURATION', 'configuration.php');
  define('FILENAME_COUNTRIES', 'countries.php');
  define('FILENAME_CURRENCIES', 'currencies.php');
  define('FILENAME_CUSTOMERS', 'customers.php');
  define('FILENAME_DEFAULT', 'default.php');
  define('FILENAME_DEFINE_LANGUAGE', 'define_language.php');
  define('FILENAME_LANGUAGES', 'languages.php');
  define('FILENAME_MAIL', 'mail.php');
  define('FILENAME_MANUFACTURERS', 'manufacturers.php');
  define('FILENAME_MODULES', 'modules.php');
  define('FILENAME_ORDERS', 'orders.php');
  define('FILENAME_POPUP_IMAGE', 'popup_image.php');
  define('FILENAME_PRODUCTS_ATTRIBUTES', 'products_attributes.php');
  define('FILENAME_PRODUCTS_EXPECTED', 'products_expected.php');
  define('FILENAME_REVIEWS', 'reviews.php');
  define('FILENAME_SHIPPING_MODULES', 'shipping_modules.php');
  define('FILENAME_SPECIALS', 'specials.php');
  define('FILENAME_STATS_CUSTOMERS', 'stats_customers.php');
  define('FILENAME_STATS_PRODUCTS_PURCHASED', 'stats_products_purchased.php');
  define('FILENAME_STATS_PRODUCTS_VIEWED', 'stats_products_viewed.php');
  define('FILENAME_TAX_CLASSES', 'tax_classes.php');
  define('FILENAME_TAX_RATES', 'tax_rates.php');
  define('FILENAME_WHOS_ONLINE', 'whos_online.php');
  define('FILENAME_ZONES', 'zones.php');

// define the database table names used in the project
  define('TABLE_ADDRESS_BOOK', 'address_book');
  define('TABLE_ADDRESS_BOOK_TO_CUSTOMERS', 'address_book_to_customers');
  define('TABLE_ADDRESS_FORMAT', 'address_format');
  define('TABLE_BANNERS', 'banners');
  define('TABLE_BANNERS_HISTORY', 'banners_history');
  define('TABLE_CATEGORIES', 'categories');
  define('TABLE_CATEGORIES_DESCRIPTION', 'categories_description');
  define('TABLE_CONFIGURATION', 'configuration');
  define('TABLE_CONFIGURATION_GROUP', 'configuration_group');
  define('TABLE_COUNTRIES', 'countries');
  define('TABLE_CURRENCIES', 'currencies');
  define('TABLE_CUSTOMERS', 'customers');
  define('TABLE_CUSTOMERS_BASKET', 'customers_basket');
  define('TABLE_CUSTOMERS_BASKET_ATTRIBUTES', 'customers_basket_attributes');
  define('TABLE_CUSTOMERS_INFO', 'customers_info');
  define('TABLE_LANGUAGES', 'languages');
  define('TABLE_MANUFACTURERS', 'manufacturers');
  define('TABLE_ORDERS', 'orders');
  define('TABLE_ORDERS_PRODUCTS', 'orders_products');
  define('TABLE_ORDERS_PRODUCTS_ATTRIBUTES', 'orders_products_attributes');
  define('TABLE_PRODUCTS', 'products');
  define('TABLE_PRODUCTS_ATTRIBUTES', 'products_attributes');
  define('TABLE_PRODUCTS_DESCRIPTION', 'products_description');
  define('TABLE_PRODUCTS_OPTIONS', 'products_options');
  define('TABLE_PRODUCTS_OPTIONS_VALUES', 'products_options_values');
  define('TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS', 'products_options_values_to_products_options');
  define('TABLE_PRODUCTS_TO_CATEGORIES', 'products_to_categories');
  define('TABLE_REVIEWS', 'reviews');
  define('TABLE_REVIEWS_EXTRA', 'reviews_extra');
  define('TABLE_SESSIONS', 'sessions');
  define('TABLE_SPECIALS', 'specials');
  define('TABLE_TAX_CLASS', 'tax_class');
  define('TABLE_TAX_RATES', 'tax_rates');
  define('TABLE_WHOS_ONLINE', 'whos_online');
  define('TABLE_ZONES', 'zones');

// define our database connection
  define('DB_SERVER', '');
  define('DB_SERVER_USERNAME', 'mysql');
  define('DB_SERVER_PASSWORD', '');
  define('DB_DATABASE', 'catalog');
  define('USE_PCONNECT', 1);
  define('STORE_SESSIONS', '');

// customization for the design layout
  define('MAX_DISPLAY_SEARCH_RESULTS', 20); // how many products to list
  define('MAX_DISPLAY_PAGE_LINKS', 5); // how many page numbers to link for page-sets
  define('IMAGE_REQUIRED', 1); // require product images? 1 = yes
  define('TAX_VALUE', 0); // propducts tax
  define('TAX_DECIMAL_PLACES', 0); // Display format for tax rate
  define('TAX_INCLUDE', false); // Show prices with tax (true) or without tax (false)
  define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)
  define('SMALL_IMAGE_WIDTH', 100); // the width in pixels of small images (default: 100);
  define('SMALL_IMAGE_HEIGHT', 80); // the height in pixels of small images (default: 80);
  define('HEADING_IMAGE_WIDTH', 85);
  define('HEADING_IMAGE_HEIGHT', 60);

  define('HEADER_BACKGROUND_COLOR', '#AABBDD');
  define('HEADER_NAVIGATION_BAR_BACKGROUND_COLOR', '#000000');
  define('HEADER_NAVIGATION_BAR_FONT_FACE', 'Tahoma, Verdana, Arial');
  define('HEADER_NAVIGATION_BAR_FONT_COLOR', '#FFFFFF');
  define('HEADER_NAVIGATION_BAR_FONT_SIZE', '2');

  define('FOOTER_BAR_BACKGROUND_COLOR', '#000000');
  define('FOOTER_BAR_FONT_FACE', 'Tahoma, Verdana, Arial');
  define('FOOTER_BAR_FONT_COLOR', '#FFFFFF');
  define('FOOTER_BAR_FONT_SIZE', '2');

  define('BOX_HEADING_BACKGROUND_COLOR', '#AABBDD');
  define('BOX_HEADING_FONT_FACE', 'Tahoma, Verdana, Arial');
  define('BOX_HEADING_FONT_COLOR', '#000000');
  define('BOX_HEADING_FONT_SIZE', '2');
  define('BOX_CONTENT_BACKGROUND_COLOR', '#FFFFFF');
  define('BOX_CONTENT_FONT_FACE', 'Verdana, Arial');
  define('BOX_CONTENT_FONT_COLOR', '#000000');
  define('BOX_CONTENT_FONT_SIZE', '1');

  define('TOP_BAR_BACKGROUND_COLOR', '#AABBDD');
  define('TOP_BAR_FONT_FACE', 'Tahoma, Verdana, Arial');
  define('TOP_BAR_FONT_COLOR', '#000000');
  define('TOP_BAR_FONT_SIZE', '2');

  define('HEADING_FONT_FACE', 'Verdana, Arial');
  define('HEADING_FONT_SIZE', '4');
  define('HEADING_FONT_COLOR', '#000000');

  define('SUB_BAR_BACKGROUND_COLOR', '#f4f7fd');
  define('SUB_BAR_FONT_FACE', 'Verdana, Arial');
  define('SUB_BAR_FONT_SIZE', '1');
  define('SUB_BAR_FONT_COLOR', '#000000');
  
  define('TEXT_FONT_FACE', 'Verdana, Arial');
  define('TEXT_FONT_SIZE', '2');
  define('TEXT_FONT_COLOR', '#000000');

  define('TABLE_HEADING_FONT_FACE', 'Verdana, Arial');
  define('TABLE_HEADING_FONT_SIZE', '1');
  define('TABLE_HEADING_FONT_COLOR', '#000000');

  define('SMALL_TEXT_FONT_FACE', 'Verdana, Arial');
  define('SMALL_TEXT_FONT_SIZE', '1');
  define('SMALL_TEXT_FONT_COLOR', '#000000');

  define('SPECIALS_PRICE_COLOR', '#FF0000'); // font color for the new price of products on special

  define('CATEGORY_FONT_FACE', 'Verdana, Arial');
  define('CATEGORY_FONT_SIZE', 2);
  define('CATEGORY_FONT_COLOR', '#AABBDD');

  define('ENTRY_FONT_FACE', 'Verdana, Arial');
  define('ENTRY_FONT_SIZE', 2);
  define('ENTRY_FONT_COLOR', '#000000');
  define('VALUE_FONT_FACE', 'Verdana, Arial');
  define('VALUE_FONT_SIZE', 2);
  define('VALUE_FONT_COLOR', '#000000');

// font styles
  define('FONT_STYLE_GENERAL', '<font face="Verdana, Arial" size="2">');
  define('FONT_STYLE_INFO_BOX_HEADING', '<font face="Verdana, Arial" size="1" color="#ffffff">');
  define('FONT_STYLE_INFO_BOX_BODY', '<font face="Verdana, Arial" size="1">');
  define('FONT_STYLE_NAVIGATION_BOX_HEADING', '<font face="Tahoma, Verdana, Arial" size="2">');

// minimum length of text field values accepted
  define('ENTRY_FIRST_NAME_MIN_LENGTH', 3);
  define('ENTRY_LAST_NAME_MIN_LENGTH', 3);
  define('ENTRY_DOB_MIN_LENGTH', 10);
  define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH', 6);
  define('ENTRY_STREET_ADDRESS_MIN_LENGTH', 5);
  define('ENTRY_POSTCODE_MIN_LENGTH', 4);
  define('ENTRY_CITY_MIN_LENGTH', 4);
  define('ENTRY_TELEPHONE_MIN_LENGTH', 3);
  define('ENTRY_PASSWORD_MIN_LENGTH', 5);

// Control what fields of the customer table are used
  define('ACCOUNT_GENDER', 1);
  define('ACCOUNT_DOB', 1);
  define('ACCOUNT_SUBURB', 1);
  define('ACCOUNT_STATE', 1);

// include the database functions
  require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
  tep_db_connect() or die('Unable to connect to database server!');

// include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');

// some code to solve compatibility issues
  require(DIR_WS_FUNCTIONS . 'compatibility.php');

// check to see if php implemented session management functions - if not, include php3/php4 compatible session class
  if (!function_exists('session_start')) {
    include(DIR_WS_CLASSES . 'sessions.php');
  }

// include mysql session storage handler
  if (STORE_SESSIONS == 'mysql') {
    include(DIR_WS_FUNCTIONS . 'sessions_mysql.php');
  }

// define how the session functions will be used
  require(DIR_WS_FUNCTIONS . 'sessions.php');

// lets start our session
  tep_session_start();
  if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, DIR_WS_ADMIN);
  }

// language
  require(DIR_WS_FUNCTIONS . 'languages.php');
  if ( (!$language) || ($HTTP_GET_VARS['language']) ) {
    if (!$language) {
      tep_session_register('language');
      tep_session_register('languages_id');
    }

    $language = tep_get_languages_directory($HTTP_GET_VARS['language']);
    if (!$language) $language = tep_get_languages_directory(DEFAULT_LANGUAGE);
  }

// include the currency rates, and the language translations
  require(DIR_FS_CATALOG . 'includes/data/rates.php');
  require(DIR_WS_LANGUAGES . $language . '.php');
  require(DIR_WS_LANGUAGES . $language . '/' . basename($PHP_SELF));

// define our general functions used application-wide
  require(DIR_WS_FUNCTIONS . 'general.php');

// setup our boxes
  require(DIR_WS_CLASSES . 'boxes.php');

// split-page-results
  require(DIR_WS_CLASSES . 'split_page_results.php');

// entry/item info classes
  require(DIR_WS_CLASSES . 'category_info.php');
  require(DIR_WS_CLASSES . 'configuration_info.php');
  require(DIR_WS_CLASSES . 'countries_info.php');
  require(DIR_WS_CLASSES . 'currencies_info.php');
  require(DIR_WS_CLASSES . 'customer_info.php');
  require(DIR_WS_CLASSES . 'languages_info.php');
  require(DIR_WS_CLASSES . 'manufacturer_info.php');
  require(DIR_WS_CLASSES . 'module_info.php');
  require(DIR_WS_CLASSES . 'product_expected_info.php');
  require(DIR_WS_CLASSES . 'product_info.php');
  require(DIR_WS_CLASSES . 'review_info.php');
  require(DIR_WS_CLASSES . 'special_price_info.php');
  require(DIR_WS_CLASSES . 'tax_class_info.php');
  require(DIR_WS_CLASSES . 'tax_rate_info.php');
  require(DIR_WS_CLASSES . 'zones_info.php');

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

// default open navigation box
  if (@!$selected_box) {
    tep_session_register('selected_box');
    $selected_box = 'configuration';
  } elseif ($HTTP_GET_VARS['selected_box']) {
    $selected_box = $HTTP_GET_VARS['selected_box'];
  }
?>