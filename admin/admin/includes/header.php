<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr bgcolor="<? echo HEADER_BACKGROUND_COLOR; ?>">
    <td align="left" valign="middle" nowrap><? echo tep_image(DIR_IMAGES . 'header_exchange_logo.gif', '57', '50', '0', STORE_NAME) . tep_image(DIR_IMAGES . 'pixel_trans.gif', '6', '1', '0', '') . tep_image(DIR_IMAGES . 'header_exchange.gif', '351', '50', '0', STORE_NAME); ?></td>
    <td align="right" nowrap><? echo '<a href="http://theexchangeproject.org">' . tep_image(DIR_IMAGES . 'header_support.gif', '50', '50', '0', HEADER_TITLE_SUPPORT_SITE) . '</a>'; ?>&nbsp;&nbsp;<? echo '<a href="' . DIR_CATALOG . FILENAME_DEFAULT . '">' . tep_image(DIR_IMAGES . 'header_checkout.gif', '53', '50', '0', HEADER_TITLE_ONLINE_DEMO) . '</a>'; ?>&nbsp;&nbsp;<? echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '">' . tep_image(DIR_IMAGES . 'header_administration.gif', '50', '50', '0', HEADER_TITLE_ADMINISTRATION) . '</a>'; ?>&nbsp;&nbsp;</td>
  </tr>
  <tr bgcolor="<? echo HEADER_NAVIGATION_BAR_BACKGROUND_COLOR; ?>" height="19">
    <td align="left" nowrap><font face="<? echo HEADER_NAVIGATION_BAR_FONT_FACE; ?>" color="<? echo HEADER_NAVIGATION_BAR_FONT_COLOR; ?>" size="<? echo HEADER_NAVIGATION_BAR_FONT_SIZE; ?>"><b>&nbsp;&nbsp;<? echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '" class="whitelink">' . HEADER_TITLE_TOP . '</a>'; ?></b></font></td>
    <td align="right" nowrap><font face="<? echo HEADER_NAVIGATION_BAR_FONT_FACE; ?>" color="<? echo HEADER_NAVIGATION_BAR_FONT_COLOR; ?>" size="<? echo HEADER_NAVIGATION_BAR_FONT_SIZE; ?>"><b><? echo '<a href="http://theexchangeproject.org" class="whitelink">' . HEADER_TITLE_SUPPORT_SITE . '</a>'; ?> &nbsp;|&nbsp; <? echo '<a href="/catalog/default.php" class="whitelink">' . HEADER_TITLE_ONLINE_DEMO . '</a>'; ?> &nbsp;|&nbsp; <? echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '" class="whitelink"', 'NONSSL') . '">' . HEADER_TITLE_ADMINISTRATION . '</a>'; ?>&nbsp;&nbsp;</b></font></td>
  </tr>
</table>
