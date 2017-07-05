<?php
/**
  * Plugin Name: Microsoft MVP API for WordPress
  * Plugin URI: https://github.com/ThiagoLunardi/microsoft-mvp-api-for-wordpress
  * Description: Automaticly add your post as a contribution in your MVP Profile.
  * Version: 1.0
  * Author: Thiago Lunardi
  * License: GPL2
**/

$msmvpapi_baseUrl = "https://mvpapi.azure-api.net/mvp/api";

/**
 * Deletes a Contribution item
 * @return void
 */
function msmvpapi_deleteContribution ( $id )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
  $areas = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/contributions?id=" + $id, $args ) );
  return $areas;
}

/**
 * Deletes a OnlineIdentity item
 * @return void
 */
function msmvpapi_deleteOnlineIdentity ( $id )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
  $areas = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/onlineidentities", $args ) );
  return $areas;
}

/**
 * Gets a list of Contribution areas grouped by Award Names
 * @return array ContributionArea item
 */
function msmvpapi_getContributionAreas ( )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
  $areas = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/contributionsareas", $args ) );
  return $areas;
}

/**
 * Gets a Contribution item by id
 * @param int $id ContributionId
 * @return object Contribution item
 */
function msmvpapi_getContributionById ( int $id )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
  $contrib = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/contributions?id=" + $id, $args ) );
  return $contrib;
}

/**
 * Gets a list of Contributions. Supports pagination
 * @param int $offset Page skip integer
 * @param int $limit Page take integer
 * @return array Contribution item
 */
function msmvpapi_getContributions ( int $offset = 0, int $limit = 0 )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
  $contribs = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/contributions/" + $offset +"/"+ $limit, $args ) );
  return $contribs;
}

/**
 * Gets a list of Contribution Types
 * @return array ContributionType item
 */
function msmvpapi_getContributionTypes ( )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
  $types = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/contributionstypes", $args ) );
  return $types;
}

/**
 * Gets the current logged on user profile summary
 * @return object Profile item
 */
function msmvpapi_getMvpProfile ( )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
  $profile = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/profile", $args ) );
  return $profile;
}

/**
 * Gets a users public profile
 * @param string $mvpid Users mvpid
 * @return object Profile item
 */
function msmvpapi_getMvpProfileById ( string $mvpid )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
  $profile = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/profile/" + $mvpid, $args ) );
  return $profile;
}

/**
 * Get current user online identities. Retricted to the current user
 * @return array OnlineIdentity item
 */
function msmvpapi_getOnlineIdentities ( )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
  $onlineIdentities = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/onlineidentities", $args ) );
  return $onlineIdentities;
}

/**
 * Get current user online identities. Retricted to the current user
 * @param string $nominationsId Guid nominationsId
 * @return array OnlineIdentity item
 */
function msmvpapi_getOnlineIdentitiesByNominationId ( string $nominationsId )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
  $onlineIdentities = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/onlineidentities/" + $nominationsId, $args ) );
  return $onlineIdentities;
}

/**
 * Get current user online identity by Id. Retricted to the current user
 * @param int $id Online identity id
 * @return object OnlineIdentity item
 */
function msmvpapi_getOnlineIdentitiesByNominationId ( string $id )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
  $onlineIdentities = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/onlineidentities/" + $id, $args ) );
  return $onlineIdentities;
}

/**
 * Gets a list of Sharing Preference / Visibility Types for Contributions
 * @return array SharingPreference item
 */
function msmvpapi_getSharingPreferences ( )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ) );
  $sharingPreferences = wp_remote_retrieve_body ( wp_remote_get( $msmvpapi_baseUrl + "/sharingpreferences", $args ) );
  return $sharingPreferences;
}

/**
 * Creates a new Contribution item
 * @param object Contribution item
 * @return object Newly created Contribution item
 */
function msmvpapi_postContribution ( $contrib )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ), 'body' =>  $contrib );
  $contrib = wp_remote_retrieve_body ( wp_remote_post( $msmvpapi_baseUrl + "/contributions", $args ) );
  return $contrib;
}

/**
 * Creates a new online identity item
 * @param object $onlineIdentity
 * @return object Newly created OnlineIdentity item
 */
function msmvpapi_postOnlineIdentity ( $onlineIdentity )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ), 'body' =>  $onlineIdentity );
  $onlineIdentity = wp_remote_retrieve_body ( wp_remote_post( $msmvpapi_baseUrl + "/onlineidentities", $args ) );
  return $onlineIdentity;
}

/**
 * Updates a Contribution item
 * @param object $contrib Contribution item
 * @return object Updated Contribution item
 */
function msmvpapi_putContribution ( $contrib )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ), 'body' =>  $contrib );
  $contrib = wp_remote_retrieve_body ( wp_remote_put( $msmvpapi_baseUrl + "/contributions", $args ) );
  return $contrib;
}

/**
 * Updates a OnlineIdentity item
 * @param object $onlineIdentity
 * @return object Updated OnlineIdentity item
 */
function msmvpapi_putOnlineIdentity ( $onlineIdentity )
{
  $args = array ( 'headers' => msmvpapi_httpHeaders ( ), 'body' =>  $onlineIdentity );
  $onlineIdentity = wp_remote_retrieve_body ( wp_remote_put( $msmvpapi_baseUrl + "/onlineidentities", $args ) );
  return $onlineIdentity;
}

/**
 * Create HTTP request Header with credenttials
 * @return object HTTPHeader
 */
function msmvpapi_httpHeaders ( )
{
  $headers = array (
    'Ocp-Apim-Subscription-Key' => '{subscription key}',
    'Authorization' => '{access token}' );
  return $headers;
}

?>
