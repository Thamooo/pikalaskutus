<?php

$lang['email_must_be_array'] = "The email validation method must be passed an array.";
$lang['email_invalid_address'] = "Virheellinen sähköpostiosoite: %s";
$lang['email_attachment_missing'] = "Kyseisen liitten löytäminen epäonnistui: %s";
$lang['email_attachment_unreadable'] = "Kyseistä liitettä ei voitu avata: %s";
$lang['email_no_recipients'] = "Sinun on määritetävä vastaanottajat: To, Cc, or Bcc";
$lang['email_send_failure_phpmail'] = "Sähköpostin lähettäminen epäonnistui käyttäen: PHP mail().  Sähköpostipalvelin ei ole välttämättä optimoitu lhettämään viestejä kyseisellä tavalla";
$lang['email_send_failure_sendmail'] = "Sähköpostin lähettäminen epäonnistui käyttäen: PHP Sendmailia.  Sähköpostipalvelin ei ole välttämättä optimoitu lhettämään viestejä kyseisellä tavalla";
$lang['email_send_failure_smtp'] = "Sähköpostin lähettäminen epäonnistui käyttäen: PHP SMTP:tä. Sähköpostipalvelin ei ole välttämättä optimoitu lhettämään viestejä kyseisellä tavalla";
$lang['email_sent'] = "Viestisi on lähetetty onnistuneesti käyttäen seuraavaa metodia: %s";
$lang['email_no_socket'] = "Unable to open a socket to Sendmail. Please check settings. Yhteydenavaus Sendmailiin epäonnistui. Tarkista asetuksesin. ";
$lang['email_no_hostname'] = "Et märitellyt SMTP host nimeä";
$lang['email_smtp_error'] = "Tällainen SMTP virhe löytyi: %s";
$lang['email_no_smtp_unpw'] = "Error: Sinun tulee määrittää SMTP käyttäjätunnus ja salasana.";
$lang['email_failed_smtp_login'] = "Failed to send AUTH LOGIN command. Error: %s";
$lang['email_smtp_auth_un'] = "Käyttäjätunnus on virheellinen. Error: %s";
$lang['email_smtp_auth_pw'] = "Salasana on virheellinen. Error: %s";
$lang['email_smtp_data_failure'] = "Kyseistä tietoa ei voitu lähettää: %s";
$lang['email_exit_status'] = "Exit status code: %s";


/* End of file email_lang.php */
/* Location: ./system/language/english/email_lang.php */