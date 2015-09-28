<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if(!function_exists('getJsonData')){
   function getJsonData($o){
     $var = get_object_vars($o);
     foreach($var as &$value){
        if(is_object($value) && method_exists($value,'getJsonData')){
           $value = $value->getJsonData();
        }
     }
     return json_encode($var);
   }
}

$contacts = json_encode($this->contacts);
$contact = getJsonData($this->contact);
$formActions = '<div class="form-actions"><button class="btn btn-primary validate" type="submit">'.JText::_('COM_CONTACT_CONTACT_SEND').'</button><input type="hidden" name="option" value="com_contact" /><input type="hidden" name="task" value="contact.submit" /><input type="hidden" name="return" value="'.$this->return_page.'" /><input type="hidden" name="id" value="'.$this->contact->slug.'" />'.JHtml::_('form.token').'</div>';
// $pagination = getJsonData($this->pagination);
?>
<script type="text/javascript">
	var contacts = <?php echo($contacts); ?>;
	var contact = <?php echo($contact); ?>;
	contact.form = {
		action: '<?php echo JRoute::_('index.php'); ?>',
		formActions: '<?php echo($formActions);?>'
	};
</script>
