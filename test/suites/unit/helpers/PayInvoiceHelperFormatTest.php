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
require_once JPATH_SITE.'/components/com_payinvoice/payinvoice/helpers/format.php';
class PayInvoiceHelperFormatTest extends TestCase
{
	public function casesDate()
	{		
		return array(
				array(	'YY-MM-DD', 
						null,
						'2013-01-23',
						'2013-01-23 is expected.'),
								
				array(	null, 
						'DD-MM-YY',
						'2013-01-23',
						'2013-01-23 is expected.'),
				
				array(	null, 
						null,
						'2013-01-23',
						'2013-01-23 is expected.'),
						
				array(	'DD-MM-YY', 
						'DD-MM-YY',
						'2013-01-23',
						'2013-01-23 is expected.'),
		);
	}
	
	/**
	 * @dataProvider casesDate	 
	 */
	public function testDate($format, $config_format, $output, $message)
	{		
		$model_mock 	= $this->getMock('PayInvoiceHelperConfig', array('get'));
		$rb_date_mock 	= $this->getMock('Rb_Date', array('toFormat', 'toString'));
		
		// if $format id null then load from configuration 
		if($config_format != null && $format === null){
			// PayInvoiceHelperConfig::get() should be called one time			
			$model_mock->expects($this->exactly(1))
             			->method('get')
             			->will($this->returnValue($config_format));

            $rb_date_mock->expects($this->exactly(1))
             			->method('toFormat')
             			->will($this->returnValue($output));
                     		
            // RB_Date::toString() should not be called
        	$rb_date_mock->expects($this->exactly(0))
        				->method('toString');     		
		}
		// if both format is null
		elseif($config_format === null && $format === null){
			// PayInvoiceHelperConfig::get() should be called one time			
			$model_mock->expects($this->exactly(1))
             			->method('get')
             			->will($this->returnValue(null));

            $rb_date_mock->expects($this->exactly(0))
             			->method('toFormat');
             		
			// RB_Date::toString() should be called 1 time
        	$rb_date_mock->expects($this->exactly(1))
        				->method('toString')
        				->will($this->returnValue($output));
		}
		elseif($format !== null){
			// PayInvoiceHelperConfig::get() should be called one time			
			$model_mock->expects($this->exactly(0))
             		->method('get');             		
             		
            $rb_date_mock->expects($this->exactly(1))
             			->method('toFormat')
             			->will($this->returnValue($output));;
             			
			// RB_Date::toString() should not be called
        	$rb_date_mock->expects($this->exactly(0))
        					->method('toString');   	
		}
				
        $obj = new PayInvoiceHelperFormat();
         
        $this->assertEquals($output, $obj->date($rb_date_mock, $format, $model_mock), $message);
	}	
}