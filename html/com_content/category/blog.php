<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

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

$category = getJsonData($this->category);
$intro_items = json_encode($this->intro_items);
$lead_items = json_encode($this->lead_items);
// $pagination = getJsonData($this->pagination);
?>
<script type="text/javascript">
var category = {
	infos : <?php echo($category); ?>,
	introItems : <?php echo($intro_items); ?>,
	leadItems : <?php echo($lead_items); ?>
};
</script>
