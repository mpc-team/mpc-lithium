<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\controllers;

use lithium\security\Auth;
use app\models\Permissions;

/**
 * This controller is used for serving static pages by name, which are located in the `/views/pages`
 * folder.
 *
 * A Lithium application's default routing provides for automatically routing and rendering
 * static pages using this controller. The default route (`/`) will render the `home` template, as
 * specified in the `view()` action.
 *
 * Additionally, any other static templates in `/views/pages` can be called by name in the URL. For
 * example, browsing to `/pages/about` will render `/views/pages/about.html.php`, if it exists.
 *
 * Templates can be nested within directories as well, which will automatically be accounted for.
 * For example, browsing to `/pages/about/company` will render
 * `/views/pages/about/company.html.php`.
 */
class PagesController extends \lithium\action\Controller 
{

	public function view() 
	{
		$authorized = Auth::check('default');
		$breadcrumbs = array(
			'path' => array('MPC', 'Home'),
			'link' => array('/', '/')
		);
		$options = array();
		$path = func_get_args();
		
		if (!$path || $path === array('home')) 
		{
			$path = array('home');
			$options['compiler'] = array('fallback' => true);
		}

        $permissions = array(
            'announcements' => array(
                'EDIT' => $authorized && Permissions::is_admin($authorized),
                'CREATE' => $authorized && Permissions::is_admin($authorized),
                'DELETE' => $authorized && Permissions::is_admin($authorized),
            ),
            'events' => array(
                'EDIT' => false,
                'CREATE' => $authorized && Permissions::is_admin($authorized),
                'DELETE' => false,
            ),
        );

		$options['template'] = join('/', $path);
		$this->set(array(
			'authorized' => $authorized,
			'breadcrumbs' => $breadcrumbs,
			'permissions' => $permissions,
		));

		return $this->render($options);
	}
}

?>