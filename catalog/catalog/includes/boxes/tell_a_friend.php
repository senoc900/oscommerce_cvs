<?php
/*
  $Id: tell_a_friend.php,v 1.11 2002/01/03 20:55:11 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2001 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- tell_a_friend //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                               'text'  => BOX_HEADING_TELL_A_FRIEND
                              );
  new infoBoxHeading($info_box_contents, false, false);

  $hide = '<input type="hidden" name="products_id" value="' . $HTTP_GET_VARS['products_id'] . '">';
  $hide .= tep_hide_session_id();

  $info_box_contents = array();
  $info_box_contents[] = array('form'  => '<form name="tell_a_friend" method="get" action="' . tep_href_link(FILENAME_TELL_A_FRIEND, '', 'NONSSL', false) . '">',
                               'align' => 'left',
                               'text'  => '<input type="text" name="send_to" size="10">' . tep_image_submit('button_tell_a_friend.gif', BOX_HEADING_TELL_A_FRIEND) . $hide . '<br>' . BOX_TELL_A_FRIEND_TEXT
                              );
  new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- tell_a_friend_eof //-->
