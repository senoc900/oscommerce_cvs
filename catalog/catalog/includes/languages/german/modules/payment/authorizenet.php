<?php
/*
  $Id: authorizenet.php,v 1.8 2001/09/20 19:41:26 mbs Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TITLE', 'Authorize.net');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION', 'Credit Card Test Info:<br><br>CC#: 4111111111111111<br>Expiry: Any');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TYPE', 'Typ:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER', 'Kreditkartenr.:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES', 'G�ltig bis:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER', '* Die \'Kreditkartenr.\' mu� mindestens aus ' . CC_NUMBER_MIN_LENGTH . ' Zahlen bestehen.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE', 'There has been an error processing you credit card, please try again.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR', 'Fehler bei der &Uuml;berp&uuml;fung der Kreditkarte!');
?>