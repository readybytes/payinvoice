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
<!-- START : Item Table -->				
<h3><?php echo Rb_Text::_('COM_OSI_INVOICE_EDIT_ITEMS' ); ?></h3>
<hr>

<!--  ONE ITEM -->
<div class="row-fluid">
	<div class="span5"> 
		<select data-placeholder="<?php echo Rb_Text::_('COM_OSI_INVOICE_EDIT_SELECT_ITEM');?>">
        	<option value=""></option>
            <option value="item1">Item 1</option>
            <option value="item2">Item 2</option>
            <option value="item3">Item 3</option>
            <option value="item4">Item 4</option>
            <option value="item5">Item 5</option>
            <option value="item6">Item 6</option>
		</select>        
	</div>
	<div class="span2">
		<input type="text" class="input-small" name="" placeholder="<?php echo Rb_Text::_('COM_OSI_INVOICE_EDIT_ITEM_QUANTITY');?>">
	</div>
	<div class="span2">
		<div class="input-prepend">              			
			<span class="add-on">$</span>
			<input type="text" name="" class="input-small" placeholder="<?php echo Rb_Text::_('COM_OSI_INVOICE_EDIT_ITEM_PRICE_PER_UNIT');?>">						
		</div>
	</div>	
	<div class="span2">
		<div class="input-prepend">              			
			<span class="add-on">$</span>
			<input type="text" name="" class="input-small" readonly="readonly">													
		</div>								
	</div>
	<div class="span1"><button class="btn"><i class="icon-remove"></i></button></div>
</div>
<hr/>

<div class="row-fluid">
	<button class="btn btn-small btn-success"><i class="icon-plus"></i><?php echo Rb_Text::_('COM_OSI_INVOICE_EDIT_ADD_ITEM')?></button>
</div>