<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
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
 * @copyright  2009-2010, Acadia University (Technology Services)
 * @author     Vincent Grovestine <vincent.grovestine@acadiau.ca>
 * @package    au-ldap_authentication
 * @license    LGPL
 * @filesource
 */


// Add to palette
$paletteMatch = 0;
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = str_replace(
  '{backend_legend', 
  '{ldapAuth_legend:hide},ldapAuth_server,ldapAuth_port,ldapAuth_serverdn,ldapAuth_basedn,ldapAuth_password,ldapAuth_option;{backend_legend', 
  $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'],
  $paletteMatch
  );
if($paletteMatch != 1) {
  $GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{ldapAuth_legend:hide},ldapAuth_server,ldapAuth_port,ldapAuth_serverdn,ldapAuth_basedn,ldapAuth_password,ldapAuth_option';
} 

// Add to fields
$GLOBALS['TL_DCA']['tl_settings']['fields']['ldapAuth_server'] = array
(
  'label'       =>  &$GLOBALS['TL_LANG']['tl_settings']['ldapAuth_server'],
  'default'     =>  '',
  'exclude'     =>  true,
  'inputType'   =>  'text',
  'eval'       => array('tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['ldapAuth_port'] = array
(
  'label'       =>  &$GLOBALS['TL_LANG']['tl_settings']['ldapAuth_port'],
  'default'     =>  '',
  'exclude'     =>  true,
  'inputType'   =>  'text',
  'eval'       => array('tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['ldapAuth_password'] = array
(
  'label'       =>  &$GLOBALS['TL_LANG']['tl_settings']['ldapAuth_password'],
  'default'     =>  '',
  'exclude'     =>  true,
  'inputType'   =>  'text',
  'eval'       => array('tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['ldapAuth_serverdn'] = array
(
  'label'       =>  &$GLOBALS['TL_LANG']['tl_settings']['ldapAuth_serverdn'],
  'default'     =>  '',
  'exclude'     =>  true,
  'inputType'   =>  'text',
  'decodeEntities'  =>  'false',
  'eval'       => array('tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['ldapAuth_basedn'] = array
(
  'label'       =>  &$GLOBALS['TL_LANG']['tl_settings']['ldapAuth_basedn'],
  'default'     =>  '',
  'exclude'     =>  true,
  'inputType'   =>  'text',
  'eval'       => array('tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['ldapAuth_option'] = array
(
  'label'       =>  &$GLOBALS['TL_LANG']['tl_settings']['ldapAuth_option'],
  'default'     =>  '',
  'exclude'     =>  true,
  'inputType'   =>  'text',
  'eval'       => array('tl_class'=>'w50')
);

?>
