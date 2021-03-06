<?php
/*
  $Id: product_reviews_write.php,v 1.62 2005/03/07 10:04:36 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2005 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $osC_Session->value('language') . '/' . FILENAME_PRODUCT_REVIEWS_WRITE);

  if (!$osC_Services->isStarted('reviews')) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
  }

  if ( ($osC_Customer->isLoggedOn() == false ) && (SERVICE_REVIEW_ENABLE_REVIEWS == 1) ) {
    $navigation->set_snapshot();

    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $Qproduct = $osC_Database->query('select p.products_id, p.products_model, p.products_image, p.products_price, p.products_tax_class_id, pd.products_name from :table_products p, :table_products_description pd where p.products_id = :products_id and p.products_status = 1 and p.products_id = pd.products_id and pd.language_id = :language_id');
  $Qproduct->bindTable(':table_products', TABLE_PRODUCTS);
  $Qproduct->bindTable(':table_products_description', TABLE_PRODUCTS_DESCRIPTION);
  $Qproduct->bindInt(':products_id', $_GET['products_id']);
  $Qproduct->bindInt(':language_id', $osC_Session->value('languages_id'));
  $Qproduct->execute();

  if ($Qproduct->numberOfRows() < 1) {
    tep_redirect(tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params(array('action'))));
  }

  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    if ($osC_Customer->isLoggedOn() === false) {
      $customer_name = $_POST['customer_name'];
    } else {
      $customer_name = $osC_Customer->first_name . ' ' . $osC_Customer->last_name;
    }

    $error = false;
    if (strlen(trim($_POST['review'])) < REVIEW_TEXT_MIN_LENGTH) {
      $error = true;

      $messageStack->add('review', JS_REVIEW_TEXT);
    }

    if (($_POST['rating'] < 1) || ($_POST['rating'] > 5)) {
      $error = true;

      $messageStack->add('review', JS_REVIEW_RATING);
    }

    if ($error === false) {
      if ($osC_Reviews->is_moderated === true) {
        $reviews_status = '0';
        $messageStack->add_session('reviews', TEXT_REVIEW_MODERATION, 'success');
      } else {
        $reviews_status = '1';
      }

      $Qreview = $osC_Database->query('insert into :table_reviews (products_id, customers_id, customers_name, reviews_rating, languages_id, reviews_text, reviews_status, date_added) values (:products_id, :customer_id, :customers_name, :rating, :language_id, :review, :review_status, now())');
      $Qreview->bindTable(':table_reviews', TABLE_REVIEWS);
      $Qreview->bindInt(':products_id', $_GET['products_id']);
      $Qreview->bindInt(':customer_id', $osC_Customer->id);
      $Qreview->bindValue(':customers_name', $customer_name);
      $Qreview->bindValue(':rating', $_POST['rating']);
      $Qreview->bindInt(':language_id', $osC_Session->value('languages_id'));
      $Qreview->bindValue(':review', $_POST['review']);
      $Qreview->bindInt(':review_status', $reviews_status);
      $Qreview->execute();

      tep_redirect(tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params(array('action'))));
    }
  }

  if ($osC_Services->isStarted('specials') && ($new_price = $osC_Specials->getPrice($Qproduct->valueInt('products_id')))) {
    $products_price = '<s>' . $osC_Currencies->displayPrice($Qproduct->value('products_price'), $Qproduct->valueInt('products_tax_class_id')) . '</s> <span class="productSpecialPrice">' . $osC_Currencies->displayPrice($new_price, $Qproduct->valueInt('products_tax_class_id')) . '</span>';
  } else {
    $products_price = $osC_Currencies->displayPrice($Qproduct->valueInt('products_price'), $Qproduct->valueInt('products_tax_class_id'));
  }

  if (tep_not_null($Qproduct->value('products_model'))) {
    $products_name = $Qproduct->value('products_name') . '<br><span class="smallText">[' . $Qproduct->value('products_model') . ']</span>';
  } else {
    $products_name = $Qproduct->value('products_name');
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params()));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript"><!--
function checkForm() {
  var error = 0;
  var error_message = "<?php echo JS_ERROR; ?>";

  var review = document.product_reviews_write.review.value;

  if (review.length < <?php echo REVIEW_TEXT_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_REVIEW_TEXT; ?>";
    error = 1;
  }

  if ((document.product_reviews_write.rating[0].checked) || (document.product_reviews_write.rating[1].checked) || (document.product_reviews_write.rating[2].checked) || (document.product_reviews_write.rating[3].checked) || (document.product_reviews_write.rating[4].checked)) {
  } else {
    error_message = error_message + "<?php echo JS_REVIEW_RATING; ?>";
    error = 1;
  }

  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}

function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><?php echo tep_draw_form('product_reviews_write', tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, 'action=process&products_id=' . $_GET['products_id']), 'post', 'onSubmit="return checkForm();"'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading" valign="top"><?php echo $products_name; ?></td>
            <td class="pageHeading" align="right" valign="top"><?php echo $products_price; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($messageStack->size('review') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('review'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ($osC_Customer->isLoggedOn() == false) {
?>
              <tr>
                <td><table width="50%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td class="main"><?php echo '<b>' . ENTRY_NAME . '</b> '; ?></td>
                  <td class="main"><?php echo osc_draw_input_field('customer_name'); ?></td>
                </tr>
                <tr>
                  <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                </tr>
                <tr>
                  <td class="main"><?php echo '<b>' . ENTRY_EMAIL_ADDRESS . '</b> '; ?></td>
                  <td class="main"><?php echo osc_draw_input_field('customer_email_address'); ?></td>
                </tr>
              </table>
              </td>
            </tr>
            <tr>
              <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
            </tr>
<?php
  } else {
 ?>
              <tr>
                <td class="main"><?php echo '<b>' . SUB_TITLE_FROM . '</b> ' . tep_output_string_protected($osC_Customer->first_name . ' ' . $osC_Customer->last_name); ?></td>
              </tr>
<?php
  }
 ?>
              <tr>
                <td class="main"><b><?php echo SUB_TITLE_REVIEW; ?></b></td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
                  <tr class="infoBoxContents">
                    <td><table border="0" width="100%" cellspacing="2" cellpadding="2">
                      <tr>
                        <td class="main"><?php echo osc_draw_textarea_field('review', '', 60, 15); ?></td>
                      </tr>
                      <tr>
                        <td class="smallText" align="right"><?php echo TEXT_NO_HTML; ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo '<b>' . SUB_TITLE_RATING . '</b> ' . TEXT_BAD . ' ' . osc_draw_radio_field('rating', array('1', '2', '3', '4', '5')) . ' ' . TEXT_GOOD; ?></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
                  <tr class="infoBoxContents">
                    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                        <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params(array('reviews_id', 'action'))) . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                        <td class="main" align="right"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
                        <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            <td width="<?php echo SMALL_IMAGE_WIDTH + 10; ?>" align="right" valign="top"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td align="center" class="smallText">
<?php
  if (tep_not_null($Qproduct->value('products_image'))) {
?>
<script language="javascript"><!--
document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $Qproduct->valueInt('products_id')) . '\\\')">' . tep_image(DIR_WS_IMAGES . $Qproduct->value('products_image'), addslashes($Qproduct->value('products_name')), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>');
//--></script>
<noscript>
<?php echo '<a href="' . tep_href_link(DIR_WS_IMAGES . $Qproduct->value('products_image')) . '" target="_blank">' . tep_image(DIR_WS_IMAGES . $Qproduct->value('products_image'), $Qproduct->value('products_name'), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>
</noscript>
<?php
  }

  echo '<p><a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, tep_get_all_get_params(array('action')) . 'action=buy_now') . '">' . tep_image_button('button_in_cart.gif', IMAGE_BUTTON_IN_CART) . '</a></p>';
?>
                </td>
              </tr>
            </table>
          </td>
        </table></td>
      </tr>
    </table></form></td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
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
