<?php
/*
  $Id: product_info.php,v 1.71 2001/11/22 21:48:42 dgw_ Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_INFO);

  $location = '';
?>
<html>
<head>
<title><?php echo TITLE; ?></title>
<base href="<?php echo (getenv('HTTPS') == 'on' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript"><!--
function popupImageWindow(url) {
  window.open(url,'popupImageWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="5" cellpadding="5">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
        </table></td>
      </tr>
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="topBarTitle">
          <tr>
            <td width="100%" class="topBarTitle">&nbsp;<?php echo TOP_BAR_TITLE; ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
<?php
  $product_info = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . $HTTP_GET_VARS['products_id'] . "' and pd.products_id = '" . $HTTP_GET_VARS['products_id'] . "' and pd.language_id = '" . $languages_id . "'");
  if (!tep_db_num_rows($product_info)) { // product not found in database
?>
      <tr>
        <td class="main"><br>&nbsp;<?php echo TEXT_PRODUCT_NOT_FOUND; ?>&nbsp;</td>
      </tr>
      <tr>
        <td><br><?php echo tep_black_line(); ?></td>
      </tr>
      <tr>
        <td align="right"><br><a href="<?php echo tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'); ?>"><?php echo tep_image_button('button_main_menu.gif', IMAGE_BUTTON_MAIN_MENU); ?></a></td>
      </tr>
<?php
  } else {
    tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . $HTTP_GET_VARS['products_id'] . "' and language_id = '" . $languages_id . "'");
    $product_info_values = tep_db_fetch_array($product_info);

    $check_special = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . $product_info_values['products_id'] . "'");
    if (tep_db_num_rows($check_special)) {
      $check_special_values = tep_db_fetch_array($check_special);
      $new_price = $check_special_values['specials_new_products_price'];
    }
    if ($new_price) {
      $products_price = '<s>' . $currencies->format($product_info_values['products_price']) . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->format($new_price) . '</span>';
    } else {
      $products_price = $currencies->format($product_info_values['products_price']);
    }
    $products_attributes = tep_db_query("select popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . $HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . $languages_id . "'");
    if (tep_db_num_rows($products_attributes)) {
      $products_attributes = '1';
    } else {
      $products_attributes = '0';
    }
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr height="40">
            <td class="pageHeading">&nbsp;<?php echo $product_info_values['products_name']; ?>&nbsp;</td>
            <td align="right" class="pageHeading">&nbsp;<?php echo $products_price; ?>&nbsp;</td>
          </tr>
<?php
    if (PRODUCT_LIST_MODEL) {
      echo '          <tr>' . "\n" .
           '            <td colspan="2" class="pageHeading">&nbsp;' . $product_info_values['products_model'] . '&nbsp;</td>' . "\n" .
           '          </tr>' . "\n";
    }
?>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_black_line(); ?></td>
      </tr></table>
    <form name="cart_quantity" method="post" action="<?php echo tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product', 'NONSSL'); ?>">
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%">
          <tr>
            <td class="main"><table border="0" cellspacing="0" cellpadding="2" align="right">
              <tr>
                <td class="main"><a href="javascript:popupImageWindow('<?php echo tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info_values['products_id']); ?>')"><?php echo tep_image($product_info_values['products_image'], $product_info_values['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'align="right" hspace="5" vspace="5"'); ?></a></td>
              </tr>
              <tr>
                <td align="center" class="smallText"><a href="javascript:popupImageWindow('<?php echo tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info_values['products_id']); ?>')"><?php echo TEXT_CLICK_TO_ENLARGE; ?></a></td>
              </tr>
            </table><p><?php echo stripslashes($product_info_values['products_description']); ?></p>
<?php
    if ($products_attributes == '1') {
      $products_options_name = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . $HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . $languages_id . "'");
      echo '<b>' . TEXT_PRODUCT_OPTIONS . '</b><br>';
      echo '<table border="0" cellpading="0" cellspacing"0">';
      while ($products_options_name_values = tep_db_fetch_array($products_options_name)) { 
        $selected = 0;
        $products_options = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . $HTTP_GET_VARS['products_id'] . "' and pa.options_id = '" . $products_options_name_values['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . $languages_id . "'");
        echo '<tr><td class="main">' . $products_options_name_values['products_options_name'] . ':&nbsp;</td><td>' . "\n" . '<select name ="id[' . $products_options_name_values['products_options_id'] . ']">' . "\n"; 
        while ($products_options_values = tep_db_fetch_array($products_options)) {
          echo "\n" . '<option name="' . $products_options_name_values['products_options_name'] . '" value="' . $products_options_values['products_options_values_id'] . '"';
          if ( ($products_options_values['options_values_price'] == 0 && $selected == 0) || ($cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name_values['products_options_id']] == $products_options_values['products_options_values_id'])) {
            $selected = 1;
            echo ' SELECTED';
          }
          echo '>' . $products_options_values['products_options_values_name'];
          if ($products_options_values['options_values_price'] != '0') {
            echo '&nbsp;(' . $products_options_values['price_prefix'] . $currencies->format($products_options_values['options_values_price']) .')&nbsp';
          }
          echo  '</option>';
        };
        echo '</select></td></tr>';
      }
      echo '</table>';
    }
?>
</td></tr></table></td>
      </tr>
<?php
    $reviews = tep_db_query("select count(*) as count from " . TABLE_REVIEWS . " where products_id = '" . $HTTP_GET_VARS['products_id'] . "'");
    $reviews_values = tep_db_fetch_array($reviews);

    if ($reviews_values['count'] > 0) {
?>
      <tr>
        <td class="main"><br><?php echo TEXT_CURRENT_REVIEWS . ' ' . $reviews_values['count']; ?><br>&nbsp;</td>
      </tr>
<?php
    }

    if ($product_info_values['products_url']) {
?>
      <tr>
        <td class="main"><?php echo sprintf(TEXT_MORE_INFORMATION, tep_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($product_info_values['products_url']), 'NONSSL', true, false)); ?><br>&nbsp;</td>
      </tr>
<?php
    }

    if ($product_info_values['products_date_available'] > date('Y-m-d H:i:s')) {
?>
      <tr>
        <td align="center" class="smallText"><?php echo sprintf(TEXT_DATE_AVAILABLE, tep_date_long($product_info_values['products_date_available'])); ?></td>
      </tr>
<?php
    } else {
?>
      <tr>
        <td align="center" class="smallText"><?php echo sprintf(TEXT_DATE_ADDED, tep_date_long($product_info_values['products_date_added'])); ?></td>
      </tr>
<?php
    }
?>
      <tr>
        <td><br><?php echo tep_black_line(); ?></td>
      </tr>
      <tr>
        <td><br><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php
    $get_params = substr(tep_get_all_get_params(), 0, -1);
    echo '            <td class="main">&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS, $get_params, 'NONSSL') . '">' . tep_image_button('button_reviews.gif', IMAGE_BUTTON_REVIEWS) . '</a></td>' . "\n" .
         '            <td align="right" class="main"><input type="hidden" name="products_id" value="' . $product_info_values['products_id'] . '">' . tep_image_submit('button_in_cart.gif', IMAGE_BUTTON_IN_CART) . '&nbsp;&nbsp;</td>' . "\n";
?>
          </tr>
        </table></td>
      </tr>
<?php
    if ( (USE_CACHE == 'true') && !SID) {
      echo tep_cache_also_purchased(3600);
    } else {
      include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
    }
  }
?>
    </table></form></td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
