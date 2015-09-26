<?php

namespace app\models;

class Communities extends \lithium\data\Model  {

	const MAX_PER_USER = 1;
	
	public static function getByUserId ($userid) {
		return self::find('all', array(
			'conditions' => array('uid' => $userid)
		))->to('array');
	}
	
	/**
	 * Creates a community with the specified 'userid' as the owning User. A user
	 * can only create and own 'MAX_PER_USER' communities. Rules for joining
	 * communities are defined in UserCommunities.
	 *
	 * @condition user may not already own more than MAX_PER_USER communities.
	 * @condition specified name must not be taken, community names are unique.
	 */ 
	public static function make ( $userid, $name ) {
		$ownedByUser = self::getByUserId( $userid );
		if( count($ownedByUser) < self::MAX_PER_USER ) {
			$community = self::find( 'first', array(
				'conditions' => array( 'name' => $name )
			));
			if( !$community ) {
				$community = self::create( array( 'name' => $name, 'uid' => $userid ) );
				$community->save();
				return $community->id;
			}
		}
		return -1;
	}
	
	public static function disband ($communityid) {
		$comm = self::find('first', array(
			'conditions' => array('id' => $communityid)
		));
		return ($comm) ? $comm->delete() : false;
	}
}