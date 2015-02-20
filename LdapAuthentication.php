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


/**
 * Class LdapAuthentication 
 *
 * @copyright  2009-2015, Acadia University (Technology Services)
 * @author     Vincent Grovestine <vincent.grovestine@acadiau.ca>
 * @package    Controller
 */
class LdapAuthentication extends Controller {

	/**
	 * LDAP authentication
	 * @param string $strUsername
	 * @param string $strPassword
	 * @return boolean
	 */
	public function authenticate($strUsername, $strPassword) {
    
    // If PHP-LDAP module is not installed/enabled, log error then fail authentication
	  if(!function_exists('ldap_connect')) {
   	  $this->log('Unable to authenticate "' . $strUsername . '" via LDAP service: PHP LDAP extension does not appear to be installed/enabled. (Please notify the system administrator.)', 'LdapAuthentication authenticate()', 'LDAP_ERROR');
	    return false;
	  }

    // Allow special characters in passwords passed to LDAP
    $strPassword = $this->decodeSpecialChars($strPassword);

	  // Fix DN strings munged up by character encoding when they were saved to localconfig.php
	  $GLOBALS['TL_CONFIG']['ldapAuth_basedn'] = $this->decodeSpecialChars($GLOBALS['TL_CONFIG']['ldapAuth_basedn']);
	  $GLOBALS['TL_CONFIG']['ldapAuth_serverdn'] = $this->decodeSpecialChars($GLOBALS['TL_CONFIG']['ldapAuth_serverdn']);

    // Parse options
  	$strLdapAuth_option = array();
	  $x = explode(';', $GLOBALS['TL_CONFIG']['ldapAuth_option']);
	  foreach($x as $y) {
	    $z = explode(',', $y);
	    if(count($z) == 2) {
	      $strLdapAuth_option[] = $z;
	    }
	  } 

    // Return & log status: 1 = true/TL_ACCESS, 0 = false/TL_ACCESS, -1 = false/TL_ERROR, -9 = false/TL_ERROR
    $status = 0;
    // Log message
    $msg = '';
 
		// Establish LDAP connection
		// Connection successful
		if(($conn = ldap_connect($GLOBALS['TL_CONFIG']['ldapAuth_server'], $GLOBALS['TL_CONFIG']['ldapAuth_port']))) {

			// Set LDAP options
			foreach($strLdapAuth_option as $opt) {
				ldap_set_option($conn, $opt[0], $opt[1]);
			}
			
			// Bind server's username/password combination
			if(ldap_bind($conn, $GLOBALS['TL_CONFIG']['ldapAuth_serverdn'], $GLOBALS['TL_CONFIG']['ldapAuth_password']) !== false) {
			
        // Search for the TYPOlight user as an LDAP resource
        if(($user_search = ldap_search($conn, $GLOBALS['TL_CONFIG']['ldapAuth_basedn'], "(CN=$strUsername)", array('dn'))) !== false) {
          
          // Get the TYPOlight user's LDAP entry
          if(($user_entry = ldap_first_entry($conn, $user_search)) !== false) {

            // Get the TYPOlight user's LDAP DN
            if(($user_dn = ldap_get_dn($conn, $user_entry)) !== false) {

              // Verify the user's LDAP password 
              if(ldap_bind($conn, $user_dn, $strPassword)) {
                $status = 1;
                $msg = 'User has logged in successfully';
  			      }

        			// Unable to bind using the server's username/password combination
			        else {
			          $status = 0;
			          $msg = 'Incorrect password';
			        } // endif ldap_bind() user
			        
			      }
			      else {
			        $status = -1;
			        $msg = 'ldap_get_dn() failed';
            } // endif ldap_get_dn()

          }
          else {
            $status = -1;
            $msg = 'ldap_first_entry() failed';
          } // endif ldap_first_entry()

        }
        else {
          $status = 0;
          $msg = 'Username not found';
        } // endif ldap_search()
			  
			} 
			else {
			  $status = -1;
			  $msg = 'ldap_bind() failed';
			} // endif ldap_bind() server

    } 
    else {
      $status = -9;
      $msg = 'ldap_connect() failed';    
	  } // endif ldap_connect


    switch($status) {
      case 1: // Success
     	  $this->log('Valid credentials for member "' . $strUsername . '": ' . $msg, 'LdapAuthentication authenticate()', 'LDAP_ACCESS');
     	  ldap_close($conn);
     	  return true;
        break;
      case 0: // Failure due to bad login
     	  $this->log('Invalid credentials for member "' . $strUsername . '": ' . $msg, 'LdapAuthentication authenticate()', 'LDAP_ACCESS');
     	  ldap_close($conn);
        break;
      case -1: // Failure due to server issue
     	  $this->log('Unable to verify credentials for member "' . $strUsername . '": ' . $msg . ' (Please notify the system administrator.)', 'LdapAuthentication authenticate()', 'LDAP_ERROR');
     	  ldap_close($conn);
        break;
      case -9: // Failure due to server connectivity
     	  $this->log('Unable to establish connection to server for member "' . $strUsername . '": ' . $msg . ' (Please notify the system administrator.)', 'LdapAuthentication authenticate()', 'LDAP_ERROR');
        break;
    }

	  // Return false on failure (default)
	  return false; 
	}
	
  /**
   * Invert Contao's special character encoding 
   * See: ./system/libraries/Input.php, line 624, encodeSpecialCharacters()
   * @param string $str
   * @return string
   */
	public function decodeSpecialChars($str) {
    $arrReplace = array('#', '<', '>', '(', ')', '\\', '=');
		$arrSearch = array('&#35;', '&#60;', '&#62;', '&#40;', '&#41;', '&#92;', '&#61;');
		return str_replace($arrSearch, $arrReplace, $str);
	}
  
	
	/**
	 * Generate module
	 */
	protected function compile() { }
	
}

?>
