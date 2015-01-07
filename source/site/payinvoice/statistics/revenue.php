<?php

/**
* @copyright	Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Front-end
* @contact		support+payinvoice@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/** 
 * Revenue Statistics
 * @author Gaurav Jain
 */
class PayInvoiceStatisticsRevenue extends PayInvoiceStatistics
{
	/**
	 * Gets instance of PayInvoiceStatisticsRevenue 
	 * @param string $name
	 * @return PayInvoiceStatisticsRevenue Object
	 */
	static function getInstance($name = '')
	{		
		return parent::getInstance('revenue');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see components/com_payinvoice/payinvoice/base/PayInvoiceStatistics::calculate()
	 */
	public function calculate()
	{
		$sql = "SELECT SUM(`total`) as `total`, DATE(`paid_date`) as `paid_date`
				FROM `#__rb_ecommerce_invoice` 
				WHERE `object_type` = 'PayInvoiceInvoice' AND (DATE(`paid_date`) BETWEEN '".$this->start_time->toSql()."' AND '".$this->end_time->toSql()."') AND `currency` = '".$this->currency."' AND (`status` = ".PayInvoiceInvoice::STATUS_PAID." OR `status` = ".PayInvoiceInvoice::STATUS_REFUNDED.")  
				GROUP BY DATE(`paid_date`)
				";
		
		$db = PayInvoiceFactory::getDbo();
		$db->setQuery($sql);		
		$this->states = new stdClass();
		$this->states->paid = $db->loadObjectList('paid_date');
		
		$sql = "SELECT SUM(`total`) as `total`, DATE(`refund_date`) as `refund_date`
				FROM `#__rb_ecommerce_invoice` 
				WHERE `object_type` = 'PayInvoiceInvoice' AND (DATE(`refund_date`) BETWEEN '".$this->start_time->toSql()."' AND '".$this->end_time->toSql()."') AND `currency` = '".$this->currency."' AND `status` = ".PayInvoiceInvoice::STATUS_REFUNDED."  
				GROUP BY DATE(`refund_date`)
				";
		
		$db = PayInvoiceFactory::getDbo();
		$db->setQuery($sql);
		$this->states->refund = $db->loadObjectList('refund_date');
	}
	
	public function getHtml()
	{
		$data = array();
		$start = $this->start_time->getClone();	
		$max = 0;
		while($start <= $this->end_time){
			$key = $start->format('Y-m-d');
			
			$total = 0;
			if(isset($this->states->paid[$key])){
				$total = $this->states->paid[$key]->total;
			}
			
			if(isset($this->states->refund[$key])){
				$total -= $this->states->refund[$key]->total;
			}
			
			if($total > $max){
				$max = $total;
			}
			
			$data[] = array('x' => $start->toUnix() * 1000, 'y' => $total);
			$start->add(new DateInterval('P1D'));  // add 1 day
		}

		ob_start();
		?>		
		<script>		
			if (typeof(payinvoice.statistics)=='undefined'){
				payinvoice.statistics = {}			
			}

			if (typeof(payinvoice.statistics.total)=='undefined'){
				payinvoice.statistics.total = {}			
			}

			payinvoice.statistics.total = {
				  	getData: function(){
								var sin = <?php echo json_encode($data);?>;
								 
							  	return [
								    {
								      values: sin,
								      key: "<?php echo JText::_('COM_PAYINVOICE_STATISTICS_REVENUE_HEADER');?>",
								      color: "#468847"
								    }
							  	];
					}
			};
				
			nv.addGraph(function() {
			  var chart = nv.models.lineChart()
			  				.forceY([0,<?php echo $max;?>]);

			  chart.xAxis
			      .axisLabel('<?php echo JText::_('COM_PAYINVOICE_STATISTICS_REVENUE__X_AXIS_TITLE');?>')
			      .tickFormat(function(d) { return d3.time.format('%d-%b-%Y')(new Date(d)) })
			      .rotateLabels(-30);

			  chart.yAxis
			      .axisLabel('<?php echo JText::sprintf('COM_PAYINVOICE_STATISTICS_REVENUE_Y_AXIS_TITLE', $this->currency);?>')
			      .tickFormat(d3.format('.02f'));

			  d3.select('#payinvoice_dashboard_statistics_revenue svg')
			      .datum(payinvoice.statistics.total.getData())
			    .transition().duration(500)
			      .call(chart);

			  nv.utils.windowResize(chart.update);

			  return chart;
			});
		</script>		
		
		<div id="payinvoice_dashboard_statistics_revenue">
			<svg></svg>
		</div>
		<?php
		$contents = ob_get_contents();
		ob_end_clean();

		return $contents;
	} 
}
