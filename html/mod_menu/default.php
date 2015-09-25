<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
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

$data = '';

foreach ($list as $i => &$item) {
	$data .= getJsonData($item) . ',';
}

$data = rtrim($data, ",");
?>
<script type="text/javascript">
var menu = [
	<?php echo($data); ?>
];
</script>
