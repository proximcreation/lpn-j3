# lpn-j3
Joomla! 3 template AngularJS friendly. (But not Joomla!-templater-beginner friendly :D)

## Infos
It’s just a first test af template for using AngularJS. It’s far form being clean but ... well it will be !

## Featured
### Contents displayed
 - display a unique main-menu, put your main-menu in the "data-loader" position
 - display a search module, put your search module in the "data-loader" position
 - display featured page
 - display category as a blog page
 - display single article page
At the moment all the rest works as Joomla! normal elements (use the positions)

### /!\ STYLE → REALLY BASIC
It just generates raw and simple html structured page, it’s up to you ! (put your styles in site.less)
I’ve put some greyscales colors + the main menu hidding to the left of the screen.

### Embeded things
 - js
   - angularjs
   - angular-sanitize (to disply html)
   - + an angular app starter (with app / empty controller / directives / filter)
   - lodash
   - momentjs
   - jquery
   - lpn-utils.js : string.latinize() and string.slug-it() to convert a accentuated string into something usable :)
 - php
   - lessphp from leafo.net
 - less/css
   - fontAwesome
   - reset.less from alsacreation.fr if my memories are good.
   - after-reset.less (a sort of personal bootstrap... very simple, but not perfect)

## Install
as always in Joomla! :
 - Manage extensions > install from file (lpn-j3.zip)
 - Make "lpn-j3" your default template
 
## ATTENTION
Basically it’s designed for Joomla!3, but I think it’s really easy to transpose to at least Joomla!2.5.

