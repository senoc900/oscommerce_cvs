<? include('includes/application_top.php'); ?>
<? $include_file = DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT; include(DIR_WS_INCLUDES . 'include_once.php'); ?>
<? $location = ' : <a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'NONSSL') . '" class="whitelink">' . NAVBAR_TITLE . '</a>'; ?>
<html>
<head>
<title><? echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript"><!--
function resetStateText(theForm) {
  theForm.state.value = '';
  if (theForm.zone_id.options.length > 1) {
    theForm.state.value = '<? echo JS_STATE_SELECT; ?>';
  }
}

function resetZoneSelected(theForm) {
  if (theForm.zone_id.options.length > 1) {
    theForm.state.value = '<? echo JS_STATE_SELECT; ?>';
  }
}

function update_zone(theForm) {
   
   var NumState = theForm.zone_id.options.length;
            
   while(NumState > 0) {
      NumState--;
      theForm.zone_id.options[NumState] = null;
   }

   var SelectedCountry = "";
            
   SelectedCountry = theForm.country.options[theForm.country.selectedIndex].value;
            
<? tep_js_zone_list("SelectedCountry", "theForm"); ?>
   resetStateText(theForm);

}   

function check_form() {
  var error = 0;
  var error_message = "<? echo JS_ERROR; ?>";

  var first_name = document.create_account.firstname.value;
  var last_name = document.create_account.lastname.value;
<?
  if (ACCOUNT_DOB) {
     echo 'var dob = document.create_account.dob.value;' . "\n";
  }
  if (ACCOUNT_STATE) {
?>
  if (document.create_account.zone_id.options.length > 1) {
    var zone_id = document.create_account.zone_id.options[document.create_account.zone_id.selectedIndex].value;
  }
<?
  }
?>
  var country = document.create_account.country.options[document.create_account.country.selectedIndex].value;
  var email_address = document.create_account.email_address.value;  
  var street_address = document.create_account.street_address.value;
  var postcode = document.create_account.postcode.value;
  var city = document.create_account.city.value;
  var telephone = document.create_account.telephone.value;
  var password = document.create_account.password.value;
  var confirmation = document.create_account.confirmation.value;

<?
  if (ACCOUNT_GENDER) {
?>
  if (document.create_account.gender[0].checked || document.create_account.gender[1].checked) {
  } else {
    error_message = error_message + "<? echo JS_GENDER; ?>";
    error = 1;
  }
<?
  }
?>
  
  if (first_name == "" || first_name.length < <? echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>) {
    error_message = error_message + "<? echo JS_FIRST_NAME; ?>";
    error = 1;
  }

  if (last_name == "" || last_name.length < <? echo ENTRY_LAST_NAME_MIN_LENGTH; ?>) {
    error_message = error_message + "<? echo JS_LAST_NAME; ?>";
    error = 1;
  }

<?
  if (ACCOUNT_DOB) {
?>
  if (dob == "" || dob.length < <? echo ENTRY_DOB_MIN_LENGTH; ?>) {
    error_message = error_message + "<? echo JS_DOB; ?>";
    error = 1;
  }
<?
  }
?>

  if (email_address == "" || email_address.length < <? echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>) {
    error_message = error_message + "<? echo JS_EMAIL_ADDRESS; ?>";
    error = 1;
  }

  if (street_address == "" || street_address.length < <? echo ENTRY_STREET_ADDRESS_MIN_LENGTH; ?>) {
    error_message = error_message + "<? echo JS_ADDRESS; ?>";
    error = 1;
  }

<?
  if (ACCOUNT_STATE) {
?>
  if (document.create_account.zone_id.options.length <= 1) {
    if (document.create_account.state.value == "" || document.create_account.state.value.length < <? echo ENTRY_STATE_MIN_LENGTH; ?> ) {
       error_message = error_message + "<? echo JS_STATE; ?>";
       error = 1;
    }
  } else {
    document.create_account.state.value = '';
    if (document.create_account.zone_id.selectedIndex == 0) {
       error_message = error_message + "<? echo JS_ZONE; ?>";
       error = 1;
    }
  }
<?
  }
?>

  if (postcode == "" || postcode.length < <? echo ENTRY_POSTCODE_MIN_LENGTH; ?>) {
    error_message = error_message + "<? echo JS_POST_CODE; ?>";
    error = 1;
  }

  if (city == "" || city.length < <? echo ENTRY_CITY_MIN_LENGTH; ?>) {
    error_message = error_message + "<? echo JS_CITY; ?>";
    error = 1;
  }

  if (telephone == "" || telephone.length < <? echo ENTRY_TELEPHONE_MIN_LENGTH; ?>) {
    error_message = error_message + "<? echo JS_TELEPHONE; ?>";
    error = 1;
  }

  if ((password != confirmation) || (password == "" || password.length < <? echo ENTRY_PASSWORD_MIN_LENGTH; ?>)) {
    error_message = error_message + "<? echo JS_PASSWORD; ?>";
    error = 1;
  }

  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}
//--></script>
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
    <td width="100%" valign="top"><form name="create_account" method="post" action="<? echo tep_href_link(FILENAME_CREATE_ACCOUNT_PROCESS, '', 'NONSSL'); ?>" onSubmit="return check_form();"><input type="hidden" name="action" value="process"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="topBarTitle">
          <tr>
            <td width="100%" class="topBarTitle" nowrap>&nbsp;<? echo TOP_BAR_TITLE; ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td nowrap><?php echo FONT_STYLE_HEADING; ?>&nbsp;<? echo HEADING_TITLE; ?>&nbsp;</font></td>
            <td align="right" nowrap>&nbsp;<? echo tep_image(DIR_WS_IMAGES . 'table_background_account.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><? echo tep_black_line(); ?></td>
      </tr>
<?
  if ($HTTP_GET_VARS['origin']) {
?>
      <tr>
        <td nowrap><br><?php echo FONT_STYLE_SMALL_TEXT; ?>&nbsp;<? echo TEXT_ORIGIN_LOGIN; ?>&nbsp;</font></td>
      </tr>
<?
  }
  $rowspan = 5+ACCOUNT_GENDER+ACCOUNT_DOB;
?>
      <tr>
        <td width="100%"><br><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" valign="middle" colspan="2" rowspan="<? echo $rowspan; ?>" nowrap><?php echo FONT_STYLE_ACCOUNT_CATEGORY; ?><? echo CATEGORY_PERSONAL; ?></font></td>
          </tr>
<?
   if (ACCOUNT_GENDER) {
?>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_GENDER; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<input type="radio" name="gender" value="m">&nbsp;<? echo MALE; ?>&nbsp;&nbsp;<input type="radio" name="gender" value="f">&nbsp;&nbsp;<? echo FEMALE; ?>&nbsp;<? echo ENTRY_GENDER_TEXT; ?></font></td>
          </tr>
<?
   }
?>
          <tr>
            <td colspan="2" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;</font></td>
          </tr>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_FIRST_NAME; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<input type="text" name="firstname" maxlength="32">&nbsp;<? echo ENTRY_FIRST_NAME_TEXT; ?></font></td>
          </tr>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_LAST_NAME; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<input type="text" name="lastname" maxlength="32">&nbsp;<? echo ENTRY_LAST_NAME_TEXT; ?></font></td>
          </tr>
<?
   if (ACCOUNT_DOB) {
?>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_DATE_OF_BIRTH; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<input type="text" name="dob" value="<? echo DOB_FORMAT_STRING; ?>" maxlength="10">&nbsp;<? echo ENTRY_DATE_OF_BIRTH_TEXT; ?></font></td>
          </tr>
<?
   }
   $rowspan = 5+ACCOUNT_SUBURB+ACCOUNT_STATE+ACCOUNT_STATE;
?>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_EMAIL_ADDRESS; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<input type="text" name="email_address" maxlength="96">&nbsp;<? echo ENTRY_EMAIL_ADDRESS_TEXT; ?></font></td>
          </tr>
          <tr>
            <td colspan="2" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;</font></td>
          </tr>
          <tr>
            <td align="right" valign="middle" colspan="2" rowspan="<? echo $rowspan; ?>" nowrap><?php echo FONT_STYLE_ACCOUNT_CATEGORY; ?><? echo CATEGORY_ADDRESS; ?></font></td>
          </tr>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_STREET_ADDRESS; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<input type="text" name="street_address" maxlength="64">&nbsp;<? echo ENTRY_STREET_ADDRESS_TEXT; ?></font></td>
          </tr>
<?
  if (ACCOUNT_SUBURB) {
?>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_SUBURB; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<input type="text" name="suburb" maxlength="32">&nbsp;<? echo ENTRY_SUBURB_TEXT; ?></font></td>
          </tr>
<?
   }
?>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_POST_CODE; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<input type="text" name="postcode" maxlength="8">&nbsp;<? echo ENTRY_POST_CODE_TEXT; ?></font></td>
          </tr>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_CITY; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<input type="text" name="city" maxlength="32">&nbsp;<? echo ENTRY_CITY_TEXT; ?></font></td>
          </tr>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_COUNTRY; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>
            &nbsp;<?tep_get_country_list("country", STORE_COUNTRY, (ACCOUNT_STATE)?"onChange=\"update_zone(this.form);\"":""); ?>&nbsp;<? echo ENTRY_COUNTRY_TEXT; ?></font></td>
          </tr>
<?
  if (ACCOUNT_STATE) {
?>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_STATE; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>
            &nbsp;<?tep_get_zone_list("zone_id", STORE_COUNTRY, "", "onChange=\"resetStateText(this.form)\";"); ?></select>&nbsp;<? echo ENTRY_STATE_TEXT; ?></font></td>
          </tr>
          <tr>
            <td></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>
            &nbsp;<input type="text" name="state" onChange="resetZoneSelected(this.form);" maxlength="32">&nbsp;<? echo ENTRY_STATE_TEXT; ?></font></td>
          </tr>
<?
   }
?>
          <tr>
            <td colspan="2" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;</font></td>
          </tr>
          <tr>
            <td align="right" valign="middle" colspan="2" rowspan="3" nowrap><?php echo FONT_STYLE_ACCOUNT_CATEGORY; ?><? echo CATEGORY_CONTACT; ?></font></td>
          </tr>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_TELEPHONE_NUMBER; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<input type="text" name="telephone" maxlength="32">&nbsp;<? echo ENTRY_TELEPHONE_NUMBER_TEXT; ?></font></td>
          </tr>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_FAX_NUMBER; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<input type="text" name="fax" maxlength="32">&nbsp;<? echo ENTRY_FAX_NUMBER_TEXT; ?></font></td>
          </tr>
          <tr>
            <td colspan="2" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;</font></td>
          </tr>
          <tr>
            <td align="right" valign="middle" colspan="2" rowspan="2" nowrap><?php echo FONT_STYLE_ACCOUNT_CATEGORY; ?><? echo CATEGORY_OPTIONS; ?></font></td>
          </tr>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_NEWSLETTER; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<select name="newsletter"><option value="1"><?php echo ENTRY_NEWSLETTER_YES; ?></option><option selected value="0"><? echo ENTRY_NEWSLETTER_NO; ?></option></select></font></td>
          </tr>
          <tr>
            <td colspan="2" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;</font></td>
          </tr>
          <tr>
            <td align="right" valign="middle" colspan="2" rowspan="3" nowrap><?php echo FONT_STYLE_ACCOUNT_CATEGORY; ?><? echo CATEGORY_PASSWORD; ?></font></td>
          </tr>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_PASSWORD; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<input type="password" name="password" maxlength="12">&nbsp;<? echo ENTRY_PASSWORD_TEXT; ?></font></td>
          </tr>
          <tr>
            <td align="right" nowrap><?php echo FONT_STYLE_FIELD_ENTRY; ?>&nbsp;<? echo ENTRY_PASSWORD_CONFIRMATION; ?>&nbsp;</font></td>
            <td nowrap><?php echo FONT_STYLE_FIELD_VALUE; ?>&nbsp;<input type="password" name="confirmation" maxlength="12">&nbsp;<? echo ENTRY_PASSWORD_CONFIRMATION_TEXT; ?></font></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><br><? echo tep_black_line(); ?></td>
      </tr>
      <tr>
        <td align="right" nowrap><br><?php echo FONT_STYLE_MAIN; ?><? echo tep_image_submit(DIR_WS_IMAGES . 'button_done.gif', IMAGE_DONE); ?>&nbsp;&nbsp;</font></td>
      </tr>
    </table><? if ($HTTP_GET_VARS['origin']) { echo '<input type="hidden" name="origin" value="' . $HTTP_GET_VARS['origin'] . '">'; } ?><? if ($HTTP_GET_VARS['connection']) { echo '<input type="hidden" name="connection" value="' . $HTTP_GET_VARS['connection'] . '">'; } ?></form></td>
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
