<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
    var $helpers = array('Javascript', 'Html', 'Form');
    var $components = array('Auth', /*'Acl',*/ 'Session');
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->userModel = 'Usuario';
        $this->Auth->fields = array('username' => 'nombre_usuario', 'password' => 'contra');
        $this->Auth->loginAction = array('admin' => false, 'controller' => 'usuarios', 'action' => 'login');
        $this->Auth->loginRedirect = '/';
        $this->Auth->logoutRedirect = '/';
        $this->Auth->loginError = 'Usuario o Contrase&ntilde;a incorrecta. Intente de nuevo.';
        $this->Auth->authError = 'Usted no tiene permiso para acceder a este m&oacute;dulo.';
        $this->Auth->allow('display');
        /*
        $this->Auth->allow('*');
        */
    }
}
?>