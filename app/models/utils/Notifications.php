<?php

namespace app\models\utils;

class Notifications
{
	/**
	 * Retrieves data for a $notification object based on given query parameters.
	 *	@params
	 *		$query: the query string.
	 *	@returns
	 *		Returns an associative array representing the `notification`.
	 */
	public static function parse ($query)
	{
		$valid_status = array('success', 'failed');
		$conditions = array(
			'operation_is_set' => isset($query['op']),
			'status_is_valid' => isset($query['status']) && in_array($query['status'], $valid_status)
		);
		$notification = array('enabled' => false, 'status' => 'none', 'text' => '');
		
		if ($conditions['status_is_valid'] && $conditions['operation_is_set'])
		{
			switch ($query['op'])
			{
				case 'pwc':
					$notification['enabled'] = true;
					$notification['status'] = $query['status'];
					$notification['text'] = 'Your password change has been processed successfully.';
					break;
				case 'avch':
					$notification['enabled'] = true;
					$notification['status'] = $query['status'];
					if ($notification['status'] == 'success')
						$notification['text'] = 'Your profile avatar has been updated successfully.';
					else
						$notification['text'] = 'There was a problem updating your profile avatar.';
					break;
			}
		}
		return $notification;
	}
}