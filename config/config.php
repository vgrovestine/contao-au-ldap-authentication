<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  2009-2013, Acadia University (Technology Services)
 * @author     Vincent Grovestine <vincent.grovestine@acadiau.ca>
 * @package    au-ldap_authentication
 * @license    LGPL 
 * @filesource
 */

// hooks
$GLOBALS['TL_HOOKS'] = array(
  'checkCredentials' => array(
    array('LdapAuthentication', 'authenticate')
  )
);

// predefine system setting defaults
$GLOBALS['TL_CONFIG']['ldapAuth_server'] = 'localhost';
$GLOBALS['TL_CONFIG']['ldapAuth_port'] = 3268;
$GLOBALS['TL_CONFIG']['ldapAuth_serverdn'] = '';
$GLOBALS['TL_CONFIG']['ldapAuth_basedn'] = '';
$GLOBALS['TL_CONFIG']['ldapAuth_password'] = '';
$GLOBALS['TL_CONFIG']['ldapAuth_option'] = '';



 
?>
