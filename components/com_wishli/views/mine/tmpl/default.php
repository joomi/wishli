<?php
/**
 * @version     1.0.0
 * @package     com_wishli
 * @copyright   Copyright (C) 2011. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// no direct access
defined('_JEXEC') or die;
$itemId = JRequest::getVar('Itemid');

?>

<div id="listWrapper">
	<?php if(count($this->list) > 0){ ?>
    <h1>רשימת ה-WISHLI שלך</h1>
    <?php } ?>
	<?php if(count($this->list) > 0){ ?>
	<?php foreach($this->list as $list){ 
	if($list->state == 1){ 
	?>
    <div id="listBlock_<?php echo $list->id; ?>" class="listBlock">
        <h2><a href="index.php?option=com_wishli&view=list&id=<?php echo $list->id; ?>&Itemid=<?php echo $itemId; ?>"><?php echo $list->title; ?></a></h2>
        <p><?php echo $list->desc; ?></p>
        <span><?php echo JHtml::Date($list->event_date, "d/m/y"); ?></span>
    </div>
    <hr />
    <?php
	
	//endif state
	}
	//endforeach
	}   
	//endif 
	} 	
	?>
    <?php if (count($this->list) == 0) {?>
    צור WISHLI עכשיו
    <?php  }  ?>
</div>
