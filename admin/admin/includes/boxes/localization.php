<?php
/*
  $Id: localization.php,v 1.14 2002/01/08 18:58:25 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- localization //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => BOX_HEADING_LOCALIZATION,
                     'link'  => tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('selected_box')) . 'selected_box=localization'));

  if ($selected_box == 'localization') {
    $contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_CURRENCIES, '', 'NONSSL') . '">' . BOX_LOCALIZATION_CURRENCIES . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_LANGUAGES, '', 'NONSSL') . '">' . BOX_LOCALIZATION_LANGUAGES . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_ORDERS_STATUS, '', 'NONSSL') . '">' . BOX_LOCALIZATION_ORDERS_STATUS . '</a>');
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- localization_eof //-->
