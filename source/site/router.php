<?php
/**
* @copyright	Copyright (C) 2009 - 2015 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}

/**
 * 
 * Joomla Invoke to transform an array of URL parameters ($query) into an array of segments.
 * {Encoding Payinvoice Urls}
 * @param Array $query array of URL parameters
 * 
 * @author Neelam Soni
 * @since  1.0
 * 
 * @return Array of segments
 */
function payinvoiceBuildRoute(&$query)
{
	$segments = array();
	
	/* @var $Payinvoice_router PayinvoiceRouter */
	$payinvoice_router = PayinvoiceRouter::getInstance();
	
	$segments = $payinvoice_router->build($query);
	
	return $segments;
}

/**
 * 
 * Joomla invoke to transform an array of segments back into an array of URL parameters.
 * {Decoding payinvoice Urls}
 * @param $segments 
 * 
 * @author Neelam Soni
 * @since  1.0
 * 
 * @return Array of url parameter
 */
function payinvoiceParseRoute($segments) 
{
	$query = Array();
	
	/* @var $payinvoice_router payinvoiceRouter */
	$payinvoice_router = PayinvoiceRouter::getInstance();
	
	$query = $payinvoice_router->parse($segments);
	
	return $query;
}

class PayinvoiceRouter extends Rb_Router
{

	protected $_component	= 'com_payinvoice';	
	
	protected static $routes = 
		        		Array (
		        			//Dashboard {view}/{task}
		        			'dashboard/display'			=>	Array(),
		        		
		        			//Invoice {view}/{task}
		        			'invoice/display'					=>	Array('invoice_id' , 'key'),
		        			'invoice/complete'					=>	Array('invoice_id')
		        		);
		        		
	/**
	 * 
	 * Enter description here ...
	 * @param $name
	 * @param $prefix
	 */
	public static function getInstance($prefix = 'payinvoice')
    {
    	return parent::getInstance($prefix);
    }
    
	 
   /**
    * (non-PHPdoc)
    * @see plugins/system/rbsl/rb/rb/Rb_Router::_routes()
    */   
	protected function _routes($key)
    {
        if ( false == isset(self::$routes[$key]) ){
            return array();
        }

        return self::$routes[$key];
    }

	/**
     * 
     * Invoke to check key exist in route or not
     * @param String $key
     */
    protected function hasRouteKey($key)
    {
    	return isset(self::$routes[$key]);
    }
    
	/**
     * (non-PHPdoc)
     * @see plugins/system/rbsl/rb/rb/Rb_Router::_slugify()
     */
	protected function _slugify($query, $var)
    {
    	switch ($var) {
    		case 'invoice_id' :
    			return $query[$var];
    		
    		case 'key' :
    			return $query[$var];
    		
    		default:
    			return $query[$var];
    		
    	}
    }
    
	/**
     * (non-PHPdoc)
     * @see plugins/system/rbsl/rb/rb/Rb_Router::_deSlugify()
     */
	protected function _deSlugify($var, &$segments, $parts)
    {
    	switch ($var) {
    		case 'invoice_id' :
    			return array_shift($segments); 			
    			
    		case 'key' :
    			return array_shift($segments);

    		default:
    			return parent::_deSlugify($var, array_shift($segments), $parts );
    		
    	}

    }

}