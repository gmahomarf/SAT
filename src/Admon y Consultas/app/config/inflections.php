<?php
/* SVN FILE: $Id$ */
/**
 * Custom Inflected Words.
 *
 * This file is used to hold words that are not matched in the normail Inflector::pluralize() and
 * Inflector::singularize()
 *
 * PHP versions 4 and %
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
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 1.0.0.2312
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a key => value array of regex used to match words.
 * If key matches then the value is returned.
 *
 *  $pluralRules = array('/(s)tatus$/i' => '\1\2tatuses', '/^(ox)$/i' => '\1\2en', '/([m|l])ouse$/i' => '\1ice');
 */
	$pluralRules = array(
            '/(c)onsulta$/' => '\\1onsultas',
            '/(e)stacion$/i' => '\\1staciones',
            '/(c)uenca$/i' => '\\1uencas',
            '/(u)suario$/i' => '\\1suarios',
            //'/(p)unto(s)eccion(t)ransversal$/i' => '\\1untos\\2ecciones\\3ransversales',
            //'/(p)unto_(s)eccion_(t)ransversal$/i' => '\\1untos_\\2ecciones_\\3ransversales',
            '/(p)unto_(s)eccion_(t)ransversal/i' => '\\1untos_\\2ecciones_\\3ransversales',
            '/^(s)eccion(t)ransversal$/i' => '\\1ecciones\\2ransversales',
            '/(s)eccion_(t)ransversal$/i' => '\\1ecciones_\\2ransversales',
            '/(r)esponsable$/i' => '\\1esponsables',
            '/^(s)ms(a)lerta$/i' => '\\1ms\\2lertas',
            '/^(s)ms_(a)lerta$/i' => '\\1ms_\\2lertas',
            '/^(l)lamada(a)lerta$/i' => '\\1lamadas\\2lertas',
            '/^(l)lamada_(a)lerta$/i' => '\\1lamadas_\\2lertas',
            '/^(c)orreo(a)lerta$/i' => '\\1orreos\\2lertas',
            '/^(c)orreo_(a)lerta$/i' => '\\1orreos_\\2lertas'
    );
/**
 * This is a key only array of plural words that should not be inflected.
 * Notice the last comma
 *
 * $uninflectedPlural = array('.*[nrlm]ese', '.*deer', '.*fish', '.*measles', '.*ois', '.*pox');
 */
	$uninflectedPlural = array();
/**
 * This is a key => value array of plural irregular words.
 * If key matches then the value is returned.
 *
 *  $irregularPlural = array('atlas' => 'atlases', 'beef' => 'beefs', 'brother' => 'brothers')
 */
	$irregularPlural = array();
/**
 * This is a key => value array of regex used to match words.
 * If key matches then the value is returned.
 *
 *  $singularRules = array('/(s)tatuses$/i' => '\1\2tatus', '/(matr)ices$/i' =>'\1ix','/(vert|ind)ices$/i')
 */
	$singularRules = array(
            '/(c)onsultas$/' => '\\1onsulta',
            '/consulta$/' => 'consulta',
            '/(e)staciones$/i' => '\\1stacion',
            '/(r)esponsables$/i' => '\\1esponsable',
            '/(u)suarios$/i' => '\\1suario',
            '/(p)untos(s)ecciones(t)ransversales$/i' => '\\1unto\\2eccion\\3ransversal',
            '/(p)untos_(s)ecciones_(t)ransversales$/i' => '\\1unto_\\2eccion_\\3ransversal',
            '/^(s)ecciones(t)ransversales$/i' => '\\1eccion\\2ransversal',
            '/^(s)ecciones_(t)ransversales$/i' => '\\1eccion_\\2ransversal',
            '/(c)uencas$/i' => '\\1uenca',
            '/^(s)ms(a)lertas$/i' => '\\1ms\\2lerta',
            '/^(s)ms_(a)lertas$/i' => '\\1ms_\\2lerta',
            '/^(l)lamadas(a)lertas$/i' => '\\1lamada\\2lerta',
            '/^(l)lamadas_(a)lertas$/i' => '\\1lamada_\\2lerta',
            '/^(c)orreos(a)lertas$/i' => '\\1orreo\\2lerta',
            '/^(c)orreos_(a)lertas$/i' => '\\1orreo_\\2lerta'
            
    );

?>