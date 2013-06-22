<?php

/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package 		PAYINVOICE
* @subpackage	Back-end
* @contact		team@readybytes.in
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
?>	

<?php echo $this->loadTemplate('edit_item');?>
<div class="row-fluid">
	<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm" class="rb-validate-form">	
		<div class="row-fluid">
			<div class="span9"><h2><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_DETAILS' ); ?></h2></div>		
			<?php if($form->getValue('invoice_id')):?>
				<div class="span3">
					<?php echo $statusbutton;?>
				</div>
			<?php endif;?>
		</div><hr>
		
		<div class="row-fluid">
			<div class="span9">		
				<div class="row-fluid">
					<!-- START : Invoice Details -->
					<?php echo $this->loadTemplate('view_invoice_details');?>						
				</div>		
			
		
				<div class="row-fluid">
					<?php $invoiceParams	= $invoice->getParams();?>
					<?php if(!empty($invoiceParams->terms_and_conditions)):?>
					<div class="well well-small">
						<h4 class="muted"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_TERMS_AND_CONDITIONS');?></h4><hr>
						<?php echo $invoiceParams->terms_and_conditions;?>	
					</div>		
					<?php endif;?>
				</div>
				
				<div class="row-fluid">
					<a href="#" onclick="payinvoice.admin.invoice.email.confirm('<?php echo $record_id?>')" class="pull-right btn btn-success"><i class="icon-envelope icon-white"></i>&nbsp;<?php echo Rb_Text::_('PAYINVOCIE_TOOLBAR_EMAIL');?></a>
				</div>
				<div>&nbsp;</div>		
			</div>
			
			
		
			<div class="span3">
				<div class="row-fluid">
					<div class="well well-small">	
						<h4 class="center muted"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_RELATED_DATES')?></h4><hr>
				    	<ul class="horizontal unstyled center">
						    <li class="muted"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_CREATED_ON')." ".$rb_invoice['created_date'];?></li><hr>
						    <li class="muted"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_MODIFIED_ON')." ".$rb_invoice['modified_date'];?></li><hr>
						    <?php if(!empty($rb_invoice['paid_date'])):?>
						    <li class="muted"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_PAID_ON')." ".$rb_invoice['paid_date'];?></li><hr>
						    <?php endif;?>
						    <?php if(!empty($rb_invoice['refund_date'])):?>
						    <li class="muted"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_REFUNDED_ON')." ".$rb_invoice['refund_date'];?></li>
						    <?php endif;?>
				   	 	</ul>
			    	</div>
		    	</div>
		    	
		    	<div class="row-fluid">
		    		<?php if(!empty($rb_invoice['notes'])):?>
					<div class="well well-small">	
					<h4 class="muted"><?php echo Rb_Text::_('COM_PAYINVOICE_INVOICE_NOTES')?></h4><hr>
						<?php echo $rb_invoice['notes'];?>
					</div>
					<?php endif;?>	
		    	</div>
		    	
		    	<div class="row-fluid">
		    		<div class="well well-small">
		    			<?php if(!empty($transactions)):?>
		    			<h4 class="muted"><?php echo Rb_Text::_('Transactions');?></h4><hr>
		    			<?php echo $this->loadTemplate('invoice_transaction');?>	
		    			<?php endif;?>
		    		</div>
	    		</div>
			</div>
	</div>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="1" />	
	</form>
</div>	
<?php
