<?php

/**
 * Tests for the PayInvoiceHelperConfig class.
 *
 * @package     Payinvoice.UnitTest 
 * @since       1.1.0
 * @author 		Gaurav Jain
 * 
 * @runInSeparateProcess
 */

// XITODO : defines.php of component also
require_once JPATH_SITE.'/components/com_payinvoice/payinvoice/helpers/config.php';
class PayInvoiceHelperConfigTest extends TestCase
{	
	public function casesGet()
	{
		return array(
				array(	'test_single', 	
						'single', 
						'"Single" value is expected.'),
				
				array(	'test_multiple', 
						array('multiple_1', 'multiple_2'), 
						'Array of multiple value expected.'),
						
				array(	'not_in_xml', 
						'not_in_xml', 
						'Match not found'),
				
				array(	null, 
						array('test_single' => 'single', 'test_multiple' => array('multiple_1', 'multiple_2'), 'not_in_xml' => 'not_in_xml', 'default' => 'default'), 
						'Whole config is expected.'),
						
				array(	'default', 
						'default', 
						'Default value "default" is expected.'),
				
				array(	'any_other', 
						'', 
						'Empty value is expected as it is not part of config'),
		);	
	}
	
	/**
	 * @dataProvider casesGet	 
	 */
	function testGet($input, $output, $message)
	{
		$model_mock 	= $this->getMock('PayInvoiceModelConfig', 		array('loadRecords'));
		$modelform_mock = $this->getMock('PayInvoiceModelFormConfig', 	array('getForm'));
				
		$obj[1] = (object)array('config_id' => 1, 'key' => 'test_single',   'value' => 'single');
		$obj[2] = (object)array('config_id' => 2, 'key' => 'test_multiple', 'value' => json_encode(array('multiple_1', 'multiple_2')));
		$obj[3] = (object)array('config_id' => 3, 'key' => 'not_in_xml', 	'value' => 'not_in_xml');
		
		$model_mock->expects($this->any())
             		->method('loadRecords')
             		->will($this->returnValue($obj));
             		
        $form = JForm::getInstance('PayInvoiceHelperConfigTest', dirname(__FILE__).'/data/'.__CLASS__.'/config.xml');

        $modelform_mock->expects($this->any())
             			->method('getForm')
             			->will($this->returnValue($form));

         $obj = new PayInvoiceHelperConfig();
         
         $this->assertEquals($output, $obj->get($input, $model_mock, $modelform_mock), $message);
	}	
}