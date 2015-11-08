<?php

namespace app\models\utils;


class Notifications
{
	/* Messages that can be helpful to the User to notify them of
	 * what the outcome of an operation was (success, failure, etc.). */
	static $s_notificationMessages = array(
	
		// Profile Notifications (by command code).
		'profile' => array(
		
			// Password change operation.
			'pwc' => array(
				'success' => 'Your password change has been processed successfully.',
			),
			
			// Avatar change operation.
			'avch' => array(
				'success' => 'Your profile avatar has been updated successfully.',
				'nofile' => 'Cannot update profile avatar without an image file.',
				'failed' => 'Could not update profile avatar.',
			),
		),
	);
	
	/* Styles correspond to classes that are applied to HTML elements. 
	 * The statuses correspond to types of notifications, and in this 
	 * dictionary are associated with template classes. */
	static $s_notificationStyles = array(	
	
		// Success.
		'success' => 'alert alert-success',
		
		// Failure.
		'failed' => 'alert alert-danger',
		
		// No File.
		'nofile' => 'alert alert-warning',
	);

	/**
	 * Retrieves data for a $notification object based on given query parameters.
	 *	@params
	 *		$query: the query string.
	 *	@returns
	 *		Returns an associative array representing the `notification`.
	 */
	public static function parse ($query)
	{
		$valid_status = array('success', 'failed', 'nofile');
		$valid_ops = array('pwc', 'avch');
		$conditions = array(
			'valid_op' => isset($query['op']) && in_array($query['op'], $valid_ops),
			'valid_status' => isset($query['status']) && in_array($query['status'], $valid_status)
		);
		$notification = array('enabled' => false, 'status' => 'none', 'text' => '');
		
		if ($conditions['valid_status'] && $conditions['valid_op'])
		{
			switch ($query['op'])
			{
				case 'pwc':
					$notification['enabled'] = true;
					$notification['status'] = $query['status'];
					$notification['text'] = self::$s_notificationMessages['profile']['pwc'][$notification['status']];
					break;
				case 'avch':
					$notification['enabled'] = true;
					$notification['status'] = $query['status'];
					$notification['text'] = self::$s_notificationMessages['profile']['avch'][$notification['status']];
					break;
			}
		}
		return $notification;
	}
}