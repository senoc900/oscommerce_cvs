<? include('includes/application_top.php'); ?>
<? $include_file = DIR_WS_LANGUAGES . $language . '/' . FILENAME_REVIEWS; include(DIR_WS_INCLUDES . 'include_once.php'); ?>
<? $location = ' : <a href="' . tep_href_link(FILENAME_REVIEWS, '', 'NONSSL') . '" class="whitelink">' . NAVBAR_TITLE . '</a>'; ?>
<html>
<head>
<title><? echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<? $include_file = DIR_WS_INCLUDES . 'header.php';  include(DIR_WS_INCLUDES . 'include_once.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="5" cellpadding="5">
  <tr>
    <td width="<? echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<? echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<? $include_file = DIR_WS_INCLUDES . 'column_left.php'; include(DIR_WS_INCLUDES . 'include_once.php'); ?>
<!-- left_navigation_eof //-->
        </table></td>
      </tr>
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="topBarTitle">
          <tr>
            <td width="100%" class="topBarTitle">&nbsp;<? echo TOP_BAR_TITLE; ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;<? echo HEADING_TITLE; ?>&nbsp;</td>
            <td align="right">&nbsp;<? echo tep_image(DIR_WS_IMAGES . 'table_background_reviews_new.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><? echo tep_black_line(); ?></td>
      </tr>
      <tr>
        <td><br>
<?php
  $reviews_query_raw = "select r.reviews_id, rd.reviews_text, r.reviews_rating, r.date_added, p.products_id, pd.products_name, p.products_image, c.customers_firstname, c.customers_lastname from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CUSTOMERS . " c where p.products_status = '1' and p.products_id = r.products_id and r.reviews_id = rd.reviews_id and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' and rd.languages_id = '" . $languages_id . "' and r.customers_id = c.customers_id order by r.reviews_id DESC";

  $reviews_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_NEW_REVIEWS, $reviews_query_raw, $reviews_numrows);

  $reviews_query = tep_db_query($reviews_query_raw);
  while ($reviews = tep_db_fetch_array($reviews_query)) {
    $reviews_array[] = array('id' => $reviews['reviews_id'],
                             'products_id' => $reviews['products_id'],
                             'reviews_id' => $reviews['reviews_id'],
                             'products_name' => $reviews['products_name'],
                             'products_image' => $reviews['products_image'],
                             'authors_first_name' => $reviews['customers_firstname'],
                             'authors_last_name' => $reviews['customers_lastname'],
                             'review' => htmlspecialchars(substr($reviews['reviews_text'], 0, 250)) . '&nbsp;..',
                             'rating' => $reviews['reviews_rating'],
                             'word_count' => tep_word_count($reviews['reviews_text'], ' '),
                             'date_added' => $reviews['date_added']);
  }

  require(DIR_WS_MODULES  . 'reviews.php');
?>
        </td>
      </tr>
      <tr>
        <td><br><? echo tep_black_line(); ?></td>
      </tr>
<?php
  if ($reviews_numrows > 0 && (PREV_NEXT_BAR_LOCATION == '2' || PREV_NEXT_BAR_LOCATION == '3')) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText">&nbsp;<?php echo $reviews_split->display_count($reviews_numrows, MAX_DISPLAY_NEW_REVIEWS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<? echo TEXT_RESULT_PAGE; ?> <? echo $reviews_split->display_links($reviews_numrows, MAX_DISPLAY_NEW_REVIEWS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table></td>
<!-- body_text_eof //-->
    <td width="<? echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<? echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<? $include_file = DIR_WS_INCLUDES . 'column_right.php'; include(DIR_WS_INCLUDES . 'include_once.php'); ?>
<!-- right_navigation_eof //-->
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<? $include_file = DIR_WS_INCLUDES . 'footer.php'; include(DIR_WS_INCLUDES . 'include_once.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<? $include_file = DIR_WS_INCLUDES . 'application_bottom.php'; include(DIR_WS_INCLUDES . 'include_once.php'); ?>
