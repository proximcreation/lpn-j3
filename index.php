<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;
$sitename = $app->get('sitename');
$tmpl = $this->baseurl . '/templates/' . $this->template;

// STOP INCLUDING GARBAGE IN MY TEMPLATE !!!!
foreach ($doc->_scripts as $script => $value)
{
    if (preg_match('/media\/jui/i', $script))
      unset($doc->_scripts[$script]);
}

// Add Stylesheets
require "php/lessc.inc.php";
$less = new lessc;
$less->checkedCompile( dirname(__FILE__) . "/less/site.less", dirname(__FILE__) . "/css/site.css");
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/site.css');



?>
<!DOCTYPE html>
<html
	xmlns="http://www.w3.org/1999/xhtml"
	xml:lang="<?php echo $this->language; ?>"
	lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"
	ng-app="app">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Language" content="fr-FR" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

		<jdoc:include type="head" />

		<!-- FAVICON TODO -->
		<!-- <link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/images/favicons/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/images/favicons/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
		<link rel="manifest" href="/images/favicons/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/images/favicons/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff"> -->

		<!--[if lt IE 9]>
			<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
		<![endif]-->
	</head>

	<body class="site" ng-controller="MainCtrl">

		<header style="background-image : url({{config.banner}})">
			<a class="logo centered-hv" href="<?php echo $this->baseurl.'/'; ?>">
				<img ng-src="<?php echo $this->baseurl.'/'; ?>{{config.logo}}" alt=""/>
			</a>
		</header>
		<div class="nav-stuffs">
			<div
				class="searchForm"
				ng-class="{'visible':searchForm.visible}"
				ng-include="'<?php echo $tmpl; ?>/html/angular-views/search-form.html'"></div>
			<nav
				ng-class="{'visible':menu.visible}"
				ng-if="menu!==undefined"
				ng-include="'<?php echo $tmpl; ?>/html/angular-views/menu.html'"></nav>
		</div>
		<div class="content-wrapper">
			<div class="navigation left">
				<jdoc:include type="modules" name="position-1" style="none" />
			</div>
			<main id="content" role="main">
				<div class="main-modules">
					<jdoc:include type="modules" name="main" style="none" />
				</div>

				<div class="wrapper featured" ng-if="featured!==undefined" ng-include="'<?php echo $tmpl; ?>/html/angular-views/featured.html'"></div>
				<div class="wrapper category" ng-if="category!==undefined" ng-include="'<?php echo $tmpl; ?>/html/angular-views/category.html'"></div>
				<div class="wrapper article" ng-if="article!==undefined" ng-include="'<?php echo $tmpl; ?>/html/angular-views/article.html'"></div>
            <div class="wrapper search" ng-if="tag!==undefined" ng-include="'<?php echo $tmpl; ?>/html/angular-views/tag.html'"></div>
				<div class="wrapper search" ng-if="searchForm.results!==undefined" ng-include="'<?php echo $tmpl; ?>/html/angular-views/search.html'"></div>
				<div class="wrapper contact" ng-if="contact!==undefined" ng-include="'<?php echo $tmpl; ?>/html/angular-views/contact.html'"></div>
			</main>
			<div class="right">
				<jdoc:include type="modules" name="position-2" style="none" />
			</div>
		</div>
		<footer>
			<div class="footer-content" ng-include="'<?php echo $tmpl; ?>/html/angular-views/footer.html'"></div>
         <p class="copyright">&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?></p>
			<jdoc:include type="modules" name="footer" style="none" />
		</footer>

		<!-- DATA LOAD -->
		<!-- component is a data loader in this template -->
		<!-- position where put all the modules that load data instead of page parts (for example the menus) -->
		<jdoc:include type="modules" name="data-loader" style="none" />
		<jdoc:include type="component" />


		<script type="text/javascript">
			var tmplPath = '<?php echo $tmpl; ?>';
         var basePath = '<?php echo $this->baseurl.'/'; ?>';
		</script>
		<!-- JS FRAMEWORK LOAD -->
		<script src="<?php echo $tmpl . '/js/lib/jquery.min.js'; ?>"></script>
		<script src="<?php echo $tmpl . '/js/lib/angular.min.js'; ?>"></script>
		<script src="<?php echo $tmpl . '/js/lib/angular-sanitize.min.js'; ?>"></script>
		<script src="<?php echo $tmpl . '/js/lib/lodash.compat.min.js'; ?>"></script>
		<script src="<?php echo $tmpl . '/js/lib/lpn-utils.js'; ?>"></script>
		<script src="<?php echo $tmpl . '/js/lib/moment-with-locales.min.js'; ?>"></script>

		<script src="<?php echo $tmpl . '/js/app/app.js'; ?>"></script>
		<script src="<?php echo $tmpl . '/js/app/controllers.js'; ?>"></script>
		<script src="<?php echo $tmpl . '/js/app/directives.js'; ?>"></script>
		<script src="<?php echo $tmpl . '/js/app/filters.js'; ?>"></script>
      <script src="<?php echo $tmpl . '/js/app/layout.js'; ?>"></script>
	</body>
</html>
