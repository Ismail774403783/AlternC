<?php
/*
 ----------------------------------------------------------------------
 LICENSE

 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License (GPL)
 as published by the Free Software Foundation; either version 2
 of the License, or (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 To read the license please visit http://www.gnu.org/copyleft/gpl.html
 ----------------------------------------------------------------------
*/

/**
 * Renew an account's access for a specific period
 *
 * @copyright AlternC-Team 2000-2017 https://alternc.com/ 
 */

require_once("../class/config.php");

if (!$admin->enabled) {
  $msg->raise("ERROR", "admin", _("This page is restricted to authorized staff"));
  echo $msg->msg_html_all();
  exit();
}

$fields = array (
        "uid"                => array ("post", "integer", ""),
        "periods"            => array ("post", "integer", ""),
);
getFields($fields);

if (!$admin->checkcreator($uid)) {
  $msg->raise("ERROR", "admin", _("This page is restricted to authorized staff"));
  echo $msg->msg_html_all();
  exit();
}

if (!$admin->renew_mem($uid, $periods)){
  include("adm_edit.php");
} else {
  $msg->raise("INFO", "admin", _("The member has been successfully renewed"));
  include("adm_list.php");
}
?>
