<?php
/** 
 * Postfix Admin 
 * 
 * LICENSE 
 * This source file is subject to the GPL license that is bundled with  
 * this package in the file LICENSE.TXT. 
 * 
 * Further details on the project are available at http://postfixadmin.sf.net 
 * 
 * @version $Id: editactive.php 1566 2013-11-10 22:22:22Z christian_boltz $ 
 * @license GNU GPL v2 or later. 
 * 
 * File: delete.php
 * Used to delete admins, domains, mailboxes, aliases etc.
 *
 * Template File: none
 */

require_once('common.php');

if (safeget('token') != $_SESSION['PFA_token']) die('Invalid token!');

$username = authentication_get_username(); # enforce login

$id     = safeget('id');
$table  = safeget('table');
$active = safeget('active');

$handlerclass = ucfirst($table) . 'Handler';

if ( !preg_match('/^[a-z]+$/', $table) || !file_exists("model/$handlerclass.php")) { # validate $table
    die ("Invalid table name given!");
}

$handler = new $handlerclass(0, $username);                                                                                                           

$formconf = $handler->webformConfig();

authentication_require_role($formconf['required_role']);

if ($handler->init($id)) { # errors will be displayed as last step anyway, no need for duplicated code ;-)
    if ($active != '0' && $active != '1') {
        die(Config::Lang('invalid_parameter'));
    }

    $values['active'] = $active;

    if ( $handler->set(array('active' => $active)) ) {
        $handler->store();
    }
}

flash_error($handler->errormsg);
flash_info($handler->infomsg);

header ("Location: " . $formconf['listview']);
exit;

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */
?>
