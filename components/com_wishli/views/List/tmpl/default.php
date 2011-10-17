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
$Id = JRequest::getVar('id');
$itemId = JRequest::getVar('Itemid');
$totalGifts = count($this->gift);
$totalBuyers = count($this->buyer);
?>

<div id="listWrapper">
	<?php if(count($this->list) > 0 && $Id == '' && $this->user->id > 0){ ?>
    <h1>רשימת ה-WISHLI שלך</h1>
    <?php } ?>
	<?php if(count($this->list) > 0){ ?>
	<?php foreach($this->list as $list){ 
	if($list->state == 1){ 
	?>
    <div id="listBlock_<?php echo $list->id; ?>" class="listBlock">
    	<div id="infoBar">
        	<span class="blue">
            	<strong><?php echo $totalGifts; ?></strong><br />
				משאלות
            </span>
            <?php if($totalBuyers > 0) { ?>
        	<span class="purple">
            	<strong><?php echo $totalBuyers; ?></strong><br />
				רכישות
            </span>
            <?php } ?>
        </div>
        <h2><a href="index.php?option=com_wishli&view=list&id=<?php echo $list->id; ?>&Itemid=<?php echo $itemId; ?>"><?php echo $list->title; ?></a></h2>
        <p><?php echo $list->desc; ?></p>
        <span><?php echo JHtml::Date($list->event_date, "d/m/y"); ?></span>
        <div class="buttons">
			<?php if ($Id && count($this->gift) > 0) {?><a href="#" class="openGiftList">הצג רשימת משאלות</a><?php } ?>
            <?php if ($Id && in_array($list->id, $this->access)) {?><a href="#form" class="openGiftForm">הוסף מוצר לרשימה</a><?php } ?>
        </div>
    </div>
    <?php if ($Id) {?>
    <div id="giftsWrapper">
        <ul>
            <?php foreach($this->gift as $gift){ 
            if($gift->state == 1 && $gift->listid == $list->id){
            ?>
            <li id="giftId_<?php if (isset($gift->id)) echo $gift->id; ?>" <?php if($gift->status == 100){ ?>class="fullGift"<?php } ?>>
            	<div id="giftInfo">
                    <h3><?php if (isset($gift->title)) echo $gift->title; ?> <?php if (in_array($list->id, $this->access)) {?><a href="#" class="editGift">ערוך</a><?php } ?></h3>
                    ניתן למצוא בחנות:<a href="<?php echo $gift->link; ?>" target="_blank">לחץ כאן</a>
                    <p><?php if (isset($gift->desc)) echo $gift->desc; ?></p>
                    <p>מחיר: <?php if (isset($gift->price)) echo $gift->price; ?></p>
                    <p>סטטוס: <?php if (isset($gift->status)) echo $gift->status; ?></p>
                </div>
                <?php if (in_array($list->id, $this->access)) {?>
                <form style="display:none;" name="edit_gift<?php if (isset($gift->id)) echo $gift->id; ?>" id="edit_gift<?php if (isset($gift->id)) echo $gift->id; ?>" action="<?php echo $u->toString(); ?>" method="post">
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
                    <a href="#" class="cancel">Cancel</a>
                </form>                
                <?php } ?>                
            </li>
				<?php foreach($this->buyer as $buyer){
                      if($buyer->gift_id == $gift->id){
                 ?>
                <li class="buyer" style="background: #009900">
                <p><?php if (isset($buyer->buyer_name)) echo $buyer->buyer_name; ?></p>
                <p><?php if (isset($buyer->email)) echo $buyer->email; ?></p>
                <p><?php if (isset($buyer->attending)) echo $buyer->attending; ?></p>
                <p><?php if (isset($buyer->percentage)) echo $buyer->percentage; ?></p>
                <p><?php if (isset($buyer->message)) echo $buyer->message; ?></p>
                </li>
                <?php } } ?>
                <?php if($gift->status < 100){ ?>
                <li class="buyerForm" style="background:#003333">
                	<?php if($gift->status > 0){ ?><h3>כנס ברכישה למתנה זו עם <?php if (isset($buyer->buyer_name)) echo $buyer->buyer_name; ?></h3>
                    <?php } else { ?><h3>רכוש מתנה זו או חלק ממנה</h3><?php } ?>
                    <form name="buyGift<?php if (isset($gift->id)) echo $gift->id; ?>" id="buyGift<?php if (isset($gift->id)) echo $gift->id; ?>" action="<?php echo $u->toString(); ?>" method="post">
                        <label>שמך: </label>
                        <input id="buyerName" name="jbuyer[name]" type="text" value="<?php //if (isset($gift->title)) echo $gift->title; ?>"  /><br />
                        <label>כתובת מייל: </label>
                        <input id="buyerMail" name="jbuyer[email]" type="text" value="<?php //if (isset($gift->link)) echo $gift->link; ?>" /><br />
                        <label>מגיע לאירוע: </label>
                        <input id="buyerAttending1" name="jbuyer[attending]" type="radio" value="1" /> כן
                        <input id="buyerAttending0" name="jbuyer[attending]" type="radio" value="0" /> לא<br />
                        <label>הערות \ ברכה: </label>
                        <textarea id="buyerMessage" name="jbuyer[message]" ><?php //if (isset($gift->desc)) echo $gift->desc; ?></textarea><br />
                        <label>אחוז קניה: </label>
                        <input id="buyerPrice" name="jbuyer[percentage]" type="text" value="<?php //if (isset($gift->price)) echo $gift->price; ?>" /><br />
                        <input id="gift_id" name="jbuyer[gift_id]" type="hidden" value="<?php echo $gift->id; ?>"  />
                        <input id="list_id" name="jbuyer[list_id]" type="hidden" value="<?php echo $list->id; ?>"  />
                        <input type="submit" name="submit" value="סמן רכישה"  />
                    </form>
                </li>
				<?php }} ?>
            <?php } ?>
        </ul>
    </div>
    <?php if (in_array($list->id, $this->access)) {?>
    <div id="newGift" style="display:none"><a name="form" id="form"></a>
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
            <input id="listid" name="jform[listid]" type="hidden" value="<?php echo $list->id; ?>"  />
            <input type="submit" name="submit" value="add new gift"  />
        </form>
    </div>
    <?php } } ?>
    <?php
	//endif state
	}
	//endforeach
	}   
	//endif 
	} 	
	?>
    <?php if (count($this->list) == 0 && $Id == '' && $this->user->id > 0) {?>
    צור WISHLI עכשיו
    <?php  }  ?>
    <?php if ($Id == '' && $this->user->id == 0) {?>
    none found<br />
	create acount<br />
	craate wishli
    <?php  }  ?>
</div>
