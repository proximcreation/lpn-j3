<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note that there are certain parts of this layout used only when there is exactly one tag.
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

$item = json_encode($this->item);
$items = json_encode($this->items);
?>
<script type="text/javascript">
var tag = <?php echo($item)?>;
var items = <?php echo($items)?>;
</script>
