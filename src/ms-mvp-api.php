<?php
/**
  * Plugin Name: Microsoft MVP API for WordPress
  * Plugin URI: https://github.com/thiagolunardi/microsoft-mvp-api-plugin-for-wordpress
  * Description: Automaticly add your post as a contribution in your MVP Profile.
  * Version: 1.0
  * Author: Thiago Lunardi
  * Author URI: http://thiagolunardi.net
  * License: GPL3
  * License URI: https://www.gnu.org/licenses/gpl-3.0.html

  * {Plugin Name} is free software: you can redistribute it and/or modify
  * it under the terms of the GNU General Public License as published by
  * the Free Software Foundation, either version 2 of the License, or
  * any later version.
  
  * {Plugin Name} is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  * GNU General Public License for more details.
  
  * You should have received a copy of the GNU General Public License
  * along with {Plugin Name}. If not, see {License URI}.
**/

include_once( 'settings.php' );

$msmvpapi_baseUrl = "https://mvpapi.azure-api.net/mvp/api";
$msmvpapi_options = get_option( "msmvpapi_options" );

/**
 * Deletes a Contribution item
 * @return void
 */
if ( !function_exists( 'msmvpapi_deleteContribution' ) ) {
  function msmvpapi_deleteContribution ( $id ) {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
    $areas = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/contributions?id=" + $id, $args ) );
    return $areas;
  }
}
/**
 * Deletes a OnlineIdentity item
 * @return void
 */
if ( !function_exists( 'msmvpapi_deleteOnlineIdentity' ) ) {
  function msmvpapi_deleteOnlineIdentity ( $id ) {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
    $areas = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/onlineidentities", $args ) );
    return $areas;
  }
}

/**
 * Gets a list of Contribution areas grouped by Award Names
 * @return array ContributionArea item
 */
if ( !function_exists( 'msmvpapi_getContributionAreas' ) ) {
  function msmvpapi_getContributionAreas ( )  {                      
    echo "msmvpapi_getContributionAreas(6)<br />";
    global $msmvpapi_baseUrl;
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
    echo "HTTP-Headers:<br />";
    print_r ( $args );
    $response = wp_remote_get( $msmvpapi_baseUrl . "/contributions/contributionsareas", $args );
    echo "URL: " . $msmvpapi_baseUrl . "/contributions/contributionsareas<br />";
    echo "RESPONSE:<br />";
    print_r ( $response );
    //$areas = wp_remote_retrieve_body ( $response );
    //return $areas;
  }       
}

/**
 * Gets a Contribution item by id
 * @param int $id ContributionId
 * @return object Contribution item
 */
if ( !function_exists( 'msmvpapi_getContributionById' ) ) {
  function msmvpapi_getContributionById ( int $id ) {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
    $contrib = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/contributions?id=" + $id, $args ) );
    return $contrib;
  }
}

/**
 * Gets a list of Contributions. Supports pagination
 * @param int $offset Page skip integer
 * @param int $limit Page take integer
 * @return array Contribution item
 */
if ( !function_exists( 'msmvpapi_getContributions' ) ) {
  function msmvpapi_getContributions ( int $offset = 0, int $limit = 0 ) {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
    $contribs = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/contributions/" + $offset +"/"+ $limit, $args ) );
    return $contribs;
  }
}

/**
 * Gets a list of Contribution Types
 * @return array ContributionType item
 */
if ( !function_exists( 'msmvpapi_getContributionTypes' ) ) {
  function msmvpapi_getContributionTypes ( ) {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
    $types = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/contributionstypes", $args ) );
    return $types;
  }
}

/**
 * Gets the current logged on user profile summary
 * @return object Profile item
 */
if ( !function_exists( 'msmvpapi_getMvpProfile' ) ) {
  function msmvpapi_getMvpProfile ( ) {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
    $profile = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/profile", $args ) );
    return $profile;
  }
}

/**
 * Gets a users public profile
 * @param string $mvpid Users mvpid
 * @return object Profile item
 */
if ( !function_exists( 'msmvpapi_getMvpProfileById' ) ) {
  function msmvpapi_getMvpProfileById ( string $mvpid )
  {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
    $profile = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/profile/" + $mvpid, $args ) );
    return $profile;
  }
}

/**
 * Get current user online identities. Retricted to the current user
 * @return array OnlineIdentity item
 */
if ( !function_exists( 'msmvpapi_getOnlineIdentities' ) ) {
  function msmvpapi_getOnlineIdentities ( ) {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
    $onlineIdentities = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/onlineidentities", $args ) );
    return $onlineIdentities;
  }
}
/**
 * Get current user online identities. Retricted to the current user
 * @param string $nominationsId Guid nominationsId
 * @return array OnlineIdentity item
 */
if ( !function_exists( 'msmvpapi_getOnlineIdentitiesByNominationId' ) ) {
  function msmvpapi_getOnlineIdentitiesByNominationId ( string $nominationsId )
  {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
    $onlineIdentities = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/onlineidentities/" + $nominationsId, $args ) );
    return $onlineIdentities;
  }
}

/**
 * Get current user online identity by Id. Retricted to the current user
 * @param int $id Online identity id
 * @return object OnlineIdentity item
 */
if ( !function_exists ( 'msmvpapi_getOnlineIdentitiesByNominationId' ) ) {
  function msmvpapi_getOnlineIdentitiesByNominationId ( string $id ) {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
    $onlineIdentities = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/onlineidentities/" + $id, $args ) );
    return $onlineIdentities;
  }
}

/**
 * Gets a list of Sharing Preference / Visibility Types for Contributions
 * @return array SharingPreference item
 */
if ( !function_exists ( 'msmvpapi_getSharingPreferences' ) ) {
  function msmvpapi_getSharingPreferences ( ) {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
    $sharingPreferences = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/sharingpreferences", $args ) );
    return $sharingPreferences;
  }
}

/**
 * Creates a new Contribution item
 * @param object Contribution item
 * @return object Newly created Contribution item
 */
if ( !function_exists ( 'msmvpapi_postContribution' ) ) {
  function msmvpapi_postContribution ( $contrib ) {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ), 'body' =>  $contrib );
    $contrib = wp_remote_retrieve_body ( wp_remote_post( $msmvpapi_baseUrl + "/contributions", $args ) );
    return $contrib;
  }
}

/**
 * Creates a new online identity item
 * @param object $onlineIdentity
 * @return object Newly created OnlineIdentity item
 */
if ( !function_exists ( 'msmvpapi_postOnlineIdentity' ) ) {
  function msmvpapi_postOnlineIdentity ( $onlineIdentity ) {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ), 'body' =>  $onlineIdentity );
    $onlineIdentity = wp_remote_retrieve_body ( wp_remote_post( $msmvpapi_baseUrl + "/onlineidentities", $args ) );
    return $onlineIdentity;
  }
}

/**
 * Updates a Contribution item
 * @param object $contrib Contribution item
 * @return object Updated Contribution item
 */
if ( !function_exists ( 'msmvpapi_putContribution' ) ) {
  function msmvpapi_putContribution ( $contrib ) {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ), 'body' =>  $contrib );
    $contrib = wp_remote_retrieve_body ( wp_remote_put( $msmvpapi_baseUrl + "/contributions", $args ) );
    return $contrib;
  }
}

/**
 * Updates a OnlineIdentity item
 * @param object $onlineIdentity
 * @return object Updated OnlineIdentity item
 */
if ( !function_exists ( 'msmvpapi_putOnlineIdentity' ) ) {
  function msmvpapi_putOnlineIdentity ( $onlineIdentity ) {
    $args = array ( 'headers' => msmvpapi_httpHeaders ( ), 'body' =>  $onlineIdentity );
    $onlineIdentity = wp_remote_retrieve_body ( wp_remote_put( $msmvpapi_baseUrl + "/onlineidentities", $args ) );
    return $onlineIdentity;
  }
}

/**
 * Create HTTP request Header with credenttials
 * @return object HTTPHeader
 */
if ( !function_exists ( 'msmvpapi_httpHeaders' ) ) {
  function msmvpapi_httpHeaders ( ) {
    global $msmvpapi_options;
    $token = $msmvpapi_options [ "token" ];
    $api_key = $msmvpapi_options [ "api_key" ];

    $headers = array (
      'Ocp-Apim-Subscription-Key' => $api_key,
      'Authorization' => $token );

    return $headers;
  }
}
?>