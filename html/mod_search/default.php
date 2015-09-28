<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Including fallback code for the placeholder attribute in the search field.
// JHtml::_('jquery.framework');
// JHtml::_('script', 'system/html5fallback.js', false, true);
?>
<script type="text/javascript">
var searchForm = {
	action: '<?php echo JRoute::_('index.php'); ?>',
	Itemid: '<?php echo $mitemid; ?>',
	label: '<?php echo $label; ?>',
	placeholder: '<?php echo $text; ?>',
	buttonTxt: '<?php echo $button_text; ?>'
};
</script>
