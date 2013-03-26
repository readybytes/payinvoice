<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		OSI
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
if(!defined( '_JEXEC' )){
	die( 'Restricted access' );
}
?>
<form action="<?php echo $uri; ?>" method="post" id="adminForm" name="adminForm">
	<table class="table table-striped">
		<thead>
			<!-- TABLE HEADER START -->
			<tr>
				<th  width="1%">
					<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" />
				</th>
				
				<th>
					<?php echo OsiHtml::_('grid.sort', "COM_OSI_INVOICE_ID", 'invoice_id', 	$filter_order_Dir, $filter_order);?>
				</th>
				<th><?php echo OsiHtml::_('grid.sort', "COM_OSI_INVOICE_TITLE", 'title', 	$filter_order_Dir, $filter_order);?></th>
				<th><?php echo OsiHtml::_('grid.sort', "COM_OSI_INVOICE_BUYER", 'buyer_id', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo OsiHtml::_('grid.sort', "COM_OSI_INVOICE_ISSUE_DATE", 'issue_date', $filter_order_Dir, $filter_order);?></th>
							
			</tr>
		<!-- TABLE HEADER END -->
		</thead>
		
		<tbody>
		</tbody>
	</table>
</form>

