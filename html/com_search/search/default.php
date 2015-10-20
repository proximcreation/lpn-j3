<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
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

$results = json_encode($this->results);
if ($this->error) {
   $errors =  json_encode($this->escape($this->errors));
}
// $searchareas = getJsonData($this->searchareas);
$tmp = [];
foreach ($this->searchareas['search'] as $val => $txt){
   $tmp[$val] = JText::_($txt);
}
?>

<script type="text/javascript">
	searchForm.results = <?php echo($results); ?>;
   <?php if ($this->error) {?>
   searchForm.errors = <?php echo($errors); ?>;
   <?php }?>
   searchForm.origKeyword = '<?php echo $this->escape($this->origkeyword); ?>';
	searchForm.total = <?php echo $this->escape($this->total); ?>;
   searchForm.searchAreas = <?php echo json_encode($tmp); ?>;
</script>
