<?php

namespace app\models\utils;


class Notifications
{
	static $s_valid_commands = array(
		'pwc', 'avch', 'login'
	);
	static $s_valid_statuses = array(
		'success', 'failed', 'nofile'
	);

	static $s_notificationMessages = array(	
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
		'login' => array(
			'login' => array(
				'failed' => 'The login credentials you provided were incorrect.',
			),
		),
	);
	
	/* Styles correspond to classes that are added to HTML elements. Statuses
	 * correspond to types of notifications, and in this dictionary are associated
	 * with template classes. */
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
		$conditions = array(
			'valid_op' => isset($query['op']) && in_array($query['op'], self::$s_valid_commands),
			'valid_status' => isset($query['status']) && in_array($query['status'], self::$s_valid_statuses)
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
				case 'login':
					$notification['enabled'] = true;
					$notification['status'] = $query['status'];
					$notification['text'] = self::$s_notificationMessages['login']['login'][$notification['status']];
					break;
			}
		}
		return $notification;
	}
}