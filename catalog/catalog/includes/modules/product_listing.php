<table border="0" width="100%" cellspacing="0" cellpadding="2">
<?
  // create column list
  $define_list = array(
    'PRODUCT_LIST_MODEL' => PRODUCT_LIST_MODEL,
    'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
    'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER, 
    'PRODUCT_LIST_PRICE' => PRODUCT_LIST_PRICE, 
    'PRODUCT_LIST_QUANTITY' => PRODUCT_LIST_QUANTITY, 
    'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_WEIGHT, 
    'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE, 
    'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_BUY_NOW
  );
  asort($define_list);
  
  $column_list = array();
  reset($define_list);
  while (list($column, $value) = each($define_list)) {
    if ($value) $column_list[] = $column;
  }

  $colspan = sizeof($column_list);

  $listing_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $listing_sql, $listing_numrows);

  if ($listing_numrows > 0 && (PREV_NEXT_BAR_LOCATION == '1' || PREV_NEXT_BAR_LOCATION == '3')) {
?>
  <tr>
    <td colspan="<? echo $colspan; ?>"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td class="smallText" nowrap>&nbsp;<? echo $listing_split->display_count($listing_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?>&nbsp;</td>
        <td align="right" class="smallText" nowrap>&nbsp;<? echo TEXT_RESULT_PAGE; ?> <? echo $listing_split->display_links($listing_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="<? echo $colspan; ?>"><? echo tep_black_line(); ?></td>
  </tr>
<?
  }
?>
  <tr>
    <td nowrap>
<?
  $list_box_contents = array();
  $list_box_contents[] = array('params' => 'class="productListing-heading"');
  $cur_row = sizeof($list_box_contents) - 1;

  for ($col=0; $col<sizeof($column_list); $col++) {
    switch ($column_list[$col]) {
      case 'PRODUCT_LIST_MODEL':
        $lc_text = TABLE_HEADING_MODEL;
        $lc_align = 'left';
        break;
      case 'PRODUCT_LIST_NAME':
        $lc_text = TABLE_HEADING_PRODUCTS;
        $lc_align = 'left';
        break;
      case 'PRODUCT_LIST_MANUFACTURER':
        $lc_text = TABLE_HEADING_MANUFACTURER;
        $lc_align = 'left';
        break;
      case 'PRODUCT_LIST_PRICE':
        $lc_text = TABLE_HEADING_PRICE;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_QUANTITY':
        $lc_text = TABLE_HEADING_QUANTITY;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_WEIGHT':
        $lc_text = TABLE_HEADING_WEIGHT;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_IMAGE':
        $lc_text = TABLE_HEADING_IMAGE;
        $lc_align = 'center';
        break;
      case 'PRODUCT_LIST_BUY_NOW':
        $lc_text = TABLE_HEADING_BUY_NOW;
        $lc_align = 'center';
        break;
    }
    
    if ($column_list[$col] != 'PRODUCT_LIST_BUY_NOW' &&
        $column_list[$col] != 'PRODUCT_LIST_IMAGE')
      $lc_text = tep_create_sort_heading($HTTP_GET_VARS['sort'], $col+1, $lc_text);

    $list_box_contents[$cur_row][] = array('align' => $lc_align,
                                           'params' => 'class="productListing-heading"',
                                           'text'  => "&nbsp;" . $lc_text . "&nbsp;");
  }

  if ($listing_numrows > 0) {
    $number_of_products = '0';
    $listing = tep_db_query($listing_sql);
    while ($listing_values = tep_db_fetch_array($listing)) {
      $number_of_products++;

      if ( ($number_of_products/2) == floor($number_of_products/2) ) {
        $list_box_contents[] = array('params' => 'class="productListing-even"');
      } else {
        $list_box_contents[] = array('params' => 'class="productListing-odd"');
      }

      $cur_row = sizeof($list_box_contents) - 1;
      
      for ($col=0; $col<sizeof($column_list); $col++) {
        $lc_align = '';
        $lc_form = '';

        switch ($column_list[$col]) {
          case 'PRODUCT_LIST_MODEL':
            $lc_text = '&nbsp;' . $listing_values['products_model'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_NAME':
            if ($HTTP_GET_VARS['manufacturers_id']) {
              $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id'] . '&products_id=' . $listing_values['products_id'], 'NONSSL') . '">' . $listing_values['products_name'] . '</a>';
            } else {
              $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . ($HTTP_GET_VARS['cPath'] ? $HTTP_GET_VARS['cPath'] : tep_get_product_path($listing_values['products_id']) ) . '&products_id=' . $listing_values['products_id'], 'NONSSL') . '">' . $listing_values['products_name'] . '</a>&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_MANUFACTURER':
            $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing_values['manufacturers_id'], 'NONSSL') . '">' . $listing_values['manufacturers_name'] . '</a>&nbsp;';
            break;
          case 'PRODUCT_LIST_PRICE':
            $lc_align = 'right';
            if ($listing_values['specials_new_products_price']) {
              $lc_text = '&nbsp;<s>' .  tep_currency_format($listing_values['products_price']) . '</s>&nbsp;&nbsp;<font color="' . SPECIALS_PRICE_COLOR . '">' . tep_currency_format($listing_values['specials_new_products_price']) . '&nbsp;';
            } else {
              $lc_text = '&nbsp;' . tep_currency_format($listing_values['products_price']) . '&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_QUANTITY':
            $lc_align = 'right';
            $lc_text = '&nbsp;' . $listing_values['products_quantity'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_WEIGHT':
            $lc_align = 'right';
            $lc_text = '&nbsp;' . $listing_values['products_weight'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_IMAGE':
            $lc_align = 'center';
            $lc_text = '&nbsp;' . tep_image($listing_values['products_image'], $listing_values['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '&nbsp;';
            break;
          case 'PRODUCT_LIST_BUY_NOW':
            $lc_align = 'center';
            $lc_form = '<form method="post" action="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=add_update_product', 'NONSSL') . '">';
            $lc_text = '&nbsp;<input type="hidden" name="cart_quantity" value="1"><input type="hidden" name="products_id" value="' . $listing_values['products_id'] . '">' . tep_image_submit('button_buy_now.gif', TEXT_BUY . $listing_values['products_name'] . TEXT_NOW) . '&nbsp;';

            break;
        }

        $list_box_contents[$cur_row][] = array('align' => $lc_align,
                                               'params' => 'class="productListing-data" nowrap',
                                               'form' => $lc_form,
                                               'text'  => $lc_text);

      }
    }
    new infoBox($list_box_contents);

    echo '    </td>' . "\n";
    echo '  </tr>' . "\n";
  } else {
?>
  <tr class="productListing-odd">
    <td colspan="<? echo $colspan; ?>" class="smallText" nowrap>&nbsp;<? echo ($HTTP_GET_VARS['manufacturers_id'] ? TEXT_NO_PRODUCTS2 : TEXT_NO_PRODUCTS); ?>&nbsp;</td>
  </tr>
<?
  }
?>
  <tr>
    <td colspan="<? echo $colspan; ?>"><? echo tep_black_line(); ?></td>
  </tr>
<?
  if ($listing_numrows > 0 && (PREV_NEXT_BAR_LOCATION == '2' || PREV_NEXT_BAR_LOCATION == '3')) {
?>
  <tr>
    <td colspan="<? echo $colspan; ?>"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td class="smallText" nowrap>&nbsp;<? echo $listing_split->display_count($listing_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?>&nbsp;</td>
        <td align="right" class="smallText" nowrap>&nbsp;<? echo TEXT_RESULT_PAGE; ?> <? echo $listing_split->display_links($listing_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
<?
  }
?>
</table>
