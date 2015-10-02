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
$params  = $this->item->params;
$phocaPDF = false;
if (JPluginHelper::isEnabled('phocapdf', 'content')) {
   include_once(JPATH_ADMINISTRATOR.'/components/com_phocapdf/helpers/phocapdf.php');
   $phocaPDF = PhocaPDFHelper::getPhocaPDFContentIcon($this->item, $params);
}
$article = getJsonData($this->item);
// $pagination = getJsonData($this->pagination);
?>
<script type="text/javascript">
var article = <?php echo($article); ?>;
var pdfLink = {url : '<?php echo(explode('"',$phocaPDF)[3]); ?>'};
</script>
