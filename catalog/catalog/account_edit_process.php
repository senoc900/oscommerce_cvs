<? include('includes/application_top.php'); ?>
<?
  if (!@$HTTP_POST_VARS['action']) {
    header('Location: ' . tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'NONSSL'));
    tep_exit();
  }

  $error = 0; // reset error flag

 if (ACCOUNT_GENDER) {
  if (($HTTP_POST_VARS['gender'] == 'm') || ($HTTP_POST_VARS['gender'] == 'f')) {
    $gender_error = 0;
  } else {
    $gender_error = 1;
    $error = 1;
  }
 }

  if (strlen(trim($HTTP_POST_VARS['firstname'])) < ENTRY_FIRST_NAME_MIN_LENGTH) {
    $firstname_error = 1;
    $error = 1;
  } else {
    $firstname_error = 0;
  }

  if (strlen(trim($HTTP_POST_VARS['lastname'])) < ENTRY_LAST_NAME_MIN_LENGTH) {
    $lastname_error = 1;
    $error = 1;
  } else {
    $lasttname_error = 0;
  }

 if (ACCOUNT_DOB) {
  if (checkdate(substr($HTTP_POST_VARS['dob'], 3, 2), substr($HTTP_POST_VARS['dob'], 0, 2),substr($HTTP_POST_VARS['dob'], -4))) {
    $dob_error = 0;
  } else {
    $dob_error = 1;
    $error = 1;
  }
 }


  if (strlen(trim($HTTP_POST_VARS['email_address'])) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
    $email_address_error = 1;
    $error = 1;
  } else {
    $email_address_error = 0;
  }
  
  if (!(tep_validate_email(trim($HTTP_POST_VARS['email_address'])))) {
    $email_address_check_error = 1;
    $error = 1;
  } else {
    $email_address_check_error = 0;
  }

  if (strlen(trim($HTTP_POST_VARS['street_address'])) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
    $street_address_error = 1;
    $error = 1;
  } else {
    $street_address_error = 0;
  }

  if (strlen(trim($HTTP_POST_VARS['postcode'])) < ENTRY_POSTCODE_MIN_LENGTH) {
    $postcode_error = 1;
    $error = 1;
  } else {
    $postcode_error = 0;
  }

  if (strlen(trim($HTTP_POST_VARS['city'])) < ENTRY_CITY_MIN_LENGTH) {
    $city_error = 1;
    $error = 1;
  } else {
    $city_error = 0;
  }

  if(ACCOUNT_STATE) {
    $zone_id = $HTTP_POST_VARS['zone_id'];
    if ($zone_id > 0) $state = "";
    else $state = trim($HTTP_POST_VARS['state']);
  }

  if ($HTTP_POST_VARS['country'] == '0') {
    $country_error = 1;
    $error = 1;
  } else {
    $country_error = 0;
  }

  if (strlen(trim($HTTP_POST_VARS['telephone'])) < ENTRY_TELEPHONE_MIN_LENGTH) {
    $telephone_error = 1;
    $error = 1;
  } else {
    $telephone_error = 0;
  }

  $passlen = strlen(trim($HTTP_POST_VARS['password']));
  if ($passlen != 0 && $passlen < ENTRY_PASSWORD_MIN_LENGTH) {
    $password_error = 1;
    $error = 1;
  } else {
    $password_error = 0;
  }

  if ($error == 1) {
?>
<? $include_file = DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_EDIT_PROCESS; include(DIR_WS_INCLUDES . 'include_once.php'); ?>
<? $location = ' : <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'NONSSL') . '" class="whitelink">' . NAVBAR_TITLE_1 . '</a> : <a href="' . tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'NONSSL') . '" class="whitelink">' . NAVBAR_TITLE_2 . '</a>'; ?>
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
    <td width="100%" valign="top"><form name="account_edit" method="post" action="<? echo tep_href_link(FILENAME_ACCOUNT_EDIT_PROCESS, '', 'NONSSL'); ?>"><input type="hidden" name="action" value="process"><table border="0" width="100%" cellspacing="0" cellpadding="0">
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
            <td align="right">&nbsp;<? echo tep_image(DIR_WS_IMAGES . 'table_background_account.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><? echo tep_black_line(); ?></td>
      </tr>
      <tr>
        <td width="100%"><br><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" valign="middle" colspan="2" rowspan="7" class="accountCategory"><? echo CATEGORY_PERSONAL; ?></td>
          </tr>
<?
  if (ACCOUNT_GENDER) {
?>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_GENDER; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
    if ($gender_error == 1) {
      echo '<input type="radio" name="gender" value="m">&nbsp;' . MALE . '&nbsp;<input type="radio" name="gender" value="m">&nbsp;' . FEMALE . '&nbsp;' . ENTRY_GENDER_ERROR;
    } else {
      if ($HTTP_POST_VARS['gender'] == 'm') {
        echo MALE . '<input type="hidden" name="gender" value="m">';
      } elseif ($HTTP_POST_VARS['gender'] == 'f') {
        echo FEMALE . '<input type="hidden" name="gender" value="f">';
      }
    }
?></td>
          </tr>
<? 
  } 
?>
          <tr>
            <td colspan="2" class="fieldKey">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_FIRST_NAME; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
    if ($firstname_error == 1) {            
      echo '<input type="text" name="firstname" maxlength="32" value="' . $HTTP_POST_VARS['firstname'] . '">&nbsp;' . ENTRY_FIRST_NAME_ERROR;
    } else {
      echo $HTTP_POST_VARS['firstname'] . '<input type="hidden" name="firstname" value="' . $HTTP_POST_VARS['firstname'] . '">';
    } ?></td>
          </tr>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_LAST_NAME; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
    if ($lastname_error == 1) {
      echo '<input type="text" name="lastname" maxlength="32" value="' . $HTTP_POST_VARS['lastname'] . '">&nbsp;' . ENTRY_LAST_NAME_ERROR;
    } else {
      echo $HTTP_POST_VARS['lastname'] . '<input type="hidden" name="lastname" value="' . $HTTP_POST_VARS['lastname'] . '">';
    } ?></td>
          </tr>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_DATE_OF_BIRTH; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
  if (ACCOUNT_DOB) {
    if ($dob_error == 1) {
      echo '<input type="text" name="dob" value="' . $HTTP_POST_VARS['dob'] . '"maxlength="10">&nbsp;' . ENTRY_DATE_OF_BIRTH_ERROR;
    } else {
      echo $HTTP_POST_VARS['dob'] . '<input type="hidden" name="dob" value="' . $HTTP_POST_VARS['dob'] . '">';
    }
  }
?></td>
          </tr>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_EMAIL_ADDRESS; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
    if ($email_address_error == 1) {
      echo '<input type="text" name="email_address" maxlength="96" value="' . $HTTP_POST_VARS['email_address'] . '">&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR;
    }  elseif ($email_address_check_error == 1) {
       echo '<input type="text" name="email_address" maxlength="96" value="' . $HTTP_POST_VARS['email_address'] . '">&nbsp;' . ENTRY_EMAIL_ADDRESS_CHECK_ERROR;
    } elseif ($email_exists == 1) {
      echo '<input type="text" name="email_address" maxlength="96" value="' . $HTTP_POST_VARS['email_address'] . '">&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR_EXISTS;
    } else {
      echo $HTTP_POST_VARS['email_address'] . '<input type="hidden" name="email_address" value="' . $HTTP_POST_VARS['email_address'] . '">';
    } ?></td>
          </tr>
          <tr>
            <td colspan="2" class="fieldKey">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" valign="middle" colspan="2" rowspan="7" class="accountCategory"><? echo CATEGORY_ADDRESS; ?></td>
          </tr>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_STREET_ADDRESS; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
    if ($street_address_error == 1) {
      echo '<input type="text" name="street_address" maxlength="64" value="' . $HTTP_POST_VARS['street_address'] . '">&nbsp;' . ENTRY_STREET_ADDRESS_ERROR;
    } else {
      echo $HTTP_POST_VARS['street_address'] . '<input type="hidden" name="street_address" value="' . $HTTP_POST_VARS['street_address'] . '">';
    } ?></td>
          </tr>
<?
  if (ACCOUNT_SUBURB) {
?>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_SUBURB; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
    echo $HTTP_POST_VARS['suburb'] . '<input type="hidden" name="suburb" value="' . $HTTP_POST_VARS['suburb'] . '">&nbsp;' . ENTRY_SUBURB_ERROR; ?></td>
          </tr>
<?
  }
?>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_POST_CODE; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
    if ($postcode_error == 1) {
      echo '<input type="text" name="postcode" maxlength="8" value="' . $HTTP_POST_VARS['postcode'] . '">&nbsp;' . ENTRY_POST_CODE_ERROR;
    } else {
      echo $HTTP_POST_VARS['postcode'] . '<input type="hidden" name="postcode" value="' . $HTTP_POST_VARS['postcode'] . '">';
    } ?></td>
          </tr>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_CITY; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
    if ($city_error == 1) {
      echo '<input type="text" name="city" maxlength="32" value="' . $HTTP_POST_VARS['city'] . '">&nbsp;' . ENTRY_CITY_ERROR;
    } else {
      echo $HTTP_POST_VARS['city'] . '<input type="hidden" name="city" value ="' . $HTTP_POST_VARS['city'] . '">';
    } ?></td>
          </tr>
<?
  if (ACCOUNT_STATE) {
?>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_STATE; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
    echo tep_get_zone_name($HTTP_POST_VARS['country'], $zone_id, $state) . '<input type="hidden" name="zone_id" value="' . $zone_id . '"><input type="hidden" name="state" value="' . $state . '">&nbsp;' . ENTRY_STATE_ERROR; ?></td>
          </tr>
<?
  }
?>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_COUNTRY; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
    if ($country_error == 1) {
      echo '<select name="country"><option value="0">' . PLEASE_SELECT . '</option>';
      $countries = tep_get_countries();
      for ($i=0; $i < sizeof($countries); $i++) {
        echo '<option value="' . $countries[$i]['countries_id'] . '"';
        if ($countries[$i]['countries_id'] == STORE_COUNTRY) echo ' SELECTED';
        echo '>' . $countries[$i]['countries_name'] . '</option>';
      }
      echo '</select>&nbsp;' . ENTRY_COUNTRY_ERROR;
    } else {
    $customers_country = tep_get_countries($HTTP_POST_VARS['country']);
    echo $customers_country['countries_name'] . '<input type="hidden" name="country" value="' . $HTTP_POST_VARS['country'] . '">';
    } ?></td>
          </tr>
          <tr>
            <td colspan="2" class="fieldKey">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" valign="middle" colspan="2" rowspan="3" class="accountCategory"><? echo CATEGORY_CONTACT; ?></td>
          </tr>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_TELEPHONE_NUMBER; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
    if ($telephone_error == 1) {
      echo '<input type="text" name="telephone" maxlength="32" value="' . $HTTP_POST_VARS['telephone'] . '">&nbsp;' . ENTRY_TELEPHONE_NUMBER_ERROR;
    } else {
      echo $HTTP_POST_VARS['telephone'] . '<input type="hidden" name="telephone" value="' . $HTTP_POST_VARS['telephone'] . '">';
    } ?></td>
          </tr>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_FAX_NUMBER; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
    echo $HTTP_POST_VARS['fax'] . '<input type="hidden" name="fax" value="' . $HTTP_POST_VARS['fax'] . '">&nbsp;' . ENTRY_FAX_NUMBER_ERROR; ?></td>
          </tr>
          <tr>
            <td colspan="2" class="fieldKey">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" valign="middle" colspan="2" rowspan="2" class="accountCategory"><? echo CATEGORY_OPTIONS; ?></td>
          </tr>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_NEWSLETTER; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<? echo $HTTP_POST_VARS['newsletter'] . '<input type="hidden" name="newsletter" value="' . $HTTP_POST_VARS['newsletter'] . '">&nbsp;' . ENTRY_NEWSLETTER_ERROR; ?></td>
          </tr>
          <tr>
            <td colspan="2" class="fieldKey">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" valign="middle" colspan="2" rowspan="3" class="accountCategory"><? echo CATEGORY_PASSWORD; ?></td>
          </tr>
          <tr>
            <td align="right" class="fieldKey">&nbsp;<? echo ENTRY_PASSWORD; ?>&nbsp;</td>
            <td class="fieldValue">&nbsp;<?
    if ($password_error == 1) {
      echo '<input type="password" name="password" maxlength="12" value="' . $HTTP_POST_VARS['password'] . '">&nbsp;' . ENTRY_PASSWORD_ERROR;
    } else {
      echo PASSWORD_HIDDEN . '<input type="hidden" name="password" value="' . $HTTP_POST_VARS['password'] . '">';
    } ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><br><? echo tep_black_line(); ?></td>
      </tr>
      <tr>
        <td align="right" class="main"><br><?php echo tep_image_submit('button_update.gif', IMAGE_BUTTON_UPDATE); ?>&nbsp;&nbsp;</td>
      </tr>
    </table></form></td>
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
<?
  } else {
    $date_now = date('Ymd');
    if (ACCOUNT_DOB) {
       $dob_ordered = substr($HTTP_POST_VARS['dob'], -4) . substr($HTTP_POST_VARS['dob'], 3, 2) . substr($HTTP_POST_VARS['dob'], 0, 2);
    }

    $update_query = 'update ' . TABLE_CUSTOMERS . ' set ';
    if (ACCOUNT_GENDER) {
       $update_query = $update_query . "customers_gender = '" . $HTTP_POST_VARS['gender'] . "', ";
    }
    $update_query = $update_query . "customers_firstname = '" . $HTTP_POST_VARS['firstname'] . "', customers_lastname = '" . $HTTP_POST_VARS['lastname'] . "', ";
    if (ACCOUNT_DOB) {
       $update_query = $update_query . "customers_dob = '" . $dob_ordered . "', ";
    }
    $update_query = $update_query . "customers_email_address = '" . $HTTP_POST_VARS['email_address'] . "', customers_street_address = '" . $HTTP_POST_VARS['street_address'] . "', ";
    if (ACCOUNT_SUBURB) {
       $update_query = $update_query . "customers_suburb = '" . $HTTP_POST_VARS['suburb'] . "', ";
    }
    $update_query = $update_query . "customers_postcode = '" . $HTTP_POST_VARS['postcode'] . "', customers_city = '" . $HTTP_POST_VARS['city'] . "', ";
    if (ACCOUNT_STATE) {
       if ($HTTP_POST_VARS['zone_id'] > 0) {
           $update_query = $update_query . "customers_zone_id = '" . $HTTP_POST_VARS['zone_id'] . "', customers_state = '', ";
       } else {
           $update_query = $update_query . "customers_zone_id = '0', customers_state = '" . $state . "', ";
       }
    }
    // Encrypted password mods
    // Encrypt the plaintext password
    if ($passlen > 0) {
       $cryptpass = crypt_password($HTTP_POST_VARS['password']);
       $update_query = $update_query . "customers_password = '" . $cryptpass . "', ";
    }
    $update_query = $update_query . "customers_country_id = '" . $HTTP_POST_VARS['country'] . "', customers_telephone = '" . $HTTP_POST_VARS['telephone'] . "', customers_fax = '" . $HTTP_POST_VARS['fax'] . "', customers_newsletter = '" . $HTTP_POST_VARS['newsletter'] . "' where customers_id = '" . $customer_id . "'";

    tep_db_query($update_query);
    tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_account_last_modified = '" . $date_now . "' where customers_info_id = '" . $customer_id . "'");

    header('Location: ' . tep_href_link(FILENAME_ACCOUNT, '', 'NONSSL'));
    tep_exit();
  }
?>
<? $include_file = DIR_WS_INCLUDES . 'application_bottom.php'; include(DIR_WS_INCLUDES . 'include_once.php'); ?>
