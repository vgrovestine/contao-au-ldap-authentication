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
 * @copyright  2009-2015, Acadia University (Technology Services)
 * @author     Vincent Grovestine <vincent.grovestine@acadiau.ca>
 * @package    au-ldap_authentication
 * @license    LGPL 
 * @filesource
 */

// legend
$GLOBALS['TL_LANG']['tl_settings']['ldapAuth_legend'] = 'LDAP/Active Directory Authentication';

// fields
$GLOBALS['TL_LANG']['tl_settings']['ldapAuth_server'] = array('Server', 'Hostname of the LDAP/Active Directory service provider.');
$GLOBALS['TL_LANG']['tl_settings']['ldapAuth_port'] = array('Port', 'Service port. (eg. 3268 or 389)');
$GLOBALS['TL_LANG']['tl_settings']['ldapAuth_serverdn'] = array('Server DN', 'Distinguising name used to connect to the server. (eg. CN=ServerUser, OU=special, DC=XYZ, DC=MyHost, DC=TLD)');
$GLOBALS['TL_LANG']['tl_settings']['ldapAuth_basedn'] = array('Base DN', 'Base distinguished name. (eg. DC=XYZ, DC=MyHost, DC=TLD)');
$GLOBALS['TL_LANG']['tl_settings']['ldapAuth_password'] = array('Server Password', 'If needed to connect to the server DN.');
$GLOBALS['TL_LANG']['tl_settings']['ldapAuth_option'] = array('Optional parameters', 'See PHP documentation for <a href="http://ca2.php.net/manual/en/function.ldap-set-option.php" target="_blank">ldap_set_option()</a>. (eg. LDAP_OPT_PROTOCOL_VERSION,3; LDAP_OPT_REFERRALS,0)');
