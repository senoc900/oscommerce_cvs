<?
/*
English Text for The Exchange Project Preview Release 2.0
Last Update: 01/12/2000
Author(s): Harald Ponce de Leon (hpdl@theexchangeproject.org)
*/

if ($HTTP_GET_VARS['action'] == 'success') {
  define('SUB_BAR_TITLE', 'Anfrage wurde gesendet');
} else {
  define('SUB_BAR_TITLE', 'Sie haben Fragen?');
}
define('TOP_BAR_TITLE', 'Kontakt');
define('HEADING_TITLE', 'Kontakt');
define('NAVBAR_TITLE', 'Kontakt');
define('TEXT_SUCCESS', 'Ihre Anfrage wurde erfolgreich an den Vertrieb gesendet.');
define('EMAIL_SUBJECT', 'Anfrage von ' . STORE_NAME);

define('ENTRY_NAME', 'Vollständiger Name:');
define('ENTRY_EMAIL', 'EMail-Adresse:');
define('ENTRY_ENQUIRY', 'Anfrage:');

define('IMAGE_SUBMIT', 'Senden');
?>