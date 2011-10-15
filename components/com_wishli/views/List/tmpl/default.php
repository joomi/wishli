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
$u =& JURI::getInstance();
//print_r($this->list);
?>
<?php //print_r( $this->list); ?>
<?php //print_r( $this->gift); ?>
<?php //echo $this->list->title; ?>

<div id="listWrapper">
	<?php foreach($this->list as $list){ 
	if($list->state == 1){ 
	?>
    <div id="listBlock_<?php echo $list->id; ?>" class="listBlock">
        <h2><?php echo $list->title; ?></h2>
        <p><?php echo $list->desc; ?></p>
        <span><?php echo JHtml::Date($list->event_date, "d/m/y"); ?></span>
    </div>
    <div id="giftsWrapper">
        <ul>
            <?php foreach($this->gift as $gift){ 
            if($gift->state == 1 && $gift->id == $list->id){
            ?>
            <li id="giftId_<?php if (isset($gift->id)) echo $gift->id; ?>">
                <h3><?php if (isset($gift->title)) echo $gift->title; ?></h3>
                ניתן למצוא בחנות:<a href="<?php echo $gift->link; ?>" target="_blank">לחץ כאן</a>
                <p><?php if (isset($gift->desc)) echo $gift->desc; ?></p>
                <p>מחיר: <?php if (isset($gift->price)) echo $gift->price; ?></p>
                <p>סטטוס: <?php if (isset($gift->status)) echo $gift->status; ?></p>
                
                <form style="display:none;" name="edit_gift<?php echo $gift->gift_id; ?>" id="edit_gift<?php echo $gift->gift_id; ?>" action="<?php echo $u->toString(); ?>" method="post">
                    <label>name</label>
                    <input id="giftName" name="jform[title]" type="text" value="<?php if (isset($gift->title)) echo $gift->title; ?>"  /><br />
                    <label>link</label>
                    <input id="giftlink" name="jform[link]" type="text" value="<?php if (isset($gift->link)) echo $gift->link; ?>" /><br />
                    <label>description</label>
                    <textarea id="giftName" name="jform[desc]" ><?php if (isset($gift->desc)) echo $gift->desc; ?></textarea><br />
                    <label>price</label>
                    <input id="giftprice" name="jform[price]" type="text" value="<?php if (isset($gift->price)) echo $gift->price; ?>" /><br />
                    <label>image</label>
                    <input id="giftimage" name="jform[image]" type="text" value="<?php if (isset($gift->image)) echo $gift->image; ?>" /><br />
                    <label>budget</label>
                    <input id="giftbudget" name="jform[budget]" type="text" value="<?php if (isset($gift->budget)) echo $gift->budget; ?>" /><br />
                    <input id="gift_id" name="jform[gift_id]" type="hidden" value="<?php echo $gift->id; ?>"  /><br />
                    <input type="submit" name="submit" value="edit gift"  />
                </form>                
            </li>
            <?php } } ?>
        </ul>
    </div>
    <div id="newGift" style="display:none;">
        <form name="new_gift" id="new_gift" action="<?php echo $u->toString(); ?>" method="post">
            <label>name</label>
            <input id="giftName" name="jform[title]" type="text"  /><br />
            <label>link</label>
            <input id="giftlink" name="jform[link]" type="text"  /><br />
            <label>description</label>
            <textarea id="giftName" name="jform[desc]" ></textarea><br />
            <label>price</label>
            <input id="giftprice" name="jform[price]" type="text"  /><br />
            <label>image</label>
            <input id="giftimage" name="jform[image]" type="text"  /><br />
            <label>budget</label>
            <input id="giftbudget" name="jform[budget]" type="text"  /><br />
            <input type="submit" name="submit" value="add new gift"  />
        </form>
    </div>
    <?php }} ?>
</div>
