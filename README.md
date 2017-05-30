# CI3 Fire Starter M (ci3-fire-starter-m)

## INTRODUCTION
See - [CI3 Fire Starter] (https://github.com/JasonBaier/ci3-fire-starter)

## WHAT'S NEW

#### Version 3.1.4.001
09/18/2016
* Upgraded to CI 3.1.4

#### Version 3.1.0.002
09/18/2016
* Upgraded to CI 3.1.0
* Removed bootstrap-datepicker are now using < input type="date" >
* Display PHP and DB version in footer
* Fixed the select language for the site in a subdirectory

#### Version 3.2.6.001
05/16/2016

* Replaced CAPTCHA at Recaptcha
* Add Controller Pages 
* Ukrainan translation

#### Version 3.2.6
04/02/2016

* Upgraded to CI 3.0.6

#### Version 3.2.5
03/28/2016

* Upgraded to CI 3.0.5

#### Version 3.2.4
02/29/2016

* Security Updates
    + Limit login requests
    + Improved encryption key (you still should replace it with your own)
    + Set username and password lengths
* Added 'email' form input fields where applicable for better mobile support
* Added new 'schema\_updates' folder in the 'assets' folder - includes SQL for new 'login\_attempt' table

#### Version 3.2.3
01/20/2016

Thanks [klavatron](https://github.com/klavatron "klavatron") for your Russian translation.

* Upgraded to CI 3.0.4
* Included pull requests
    + Russian translation
* Fixed Issue #21 for locating translation folders on Windows (thanks [Everterstraat](https://github.com/Everterstraat "Everterstraat") for finding the source of the problem)

#### Version 3.2.2
12/23/2015

* Added configurable webroot in core.php config file

#### Version 3.2.1
12/22/2015

* Site owner-configurable settings now translatable (requires update to settings table)

#### Version 3.2.0
12/19/2015

* Added language selector
* Users are now assigned a language (requires update to users table)
* Setup English as a fall back when translated language files are missing

#### Version 3.1.7
12/17/2015

* Added pagination config file

#### Version 3.1.6
12/11/2015

Thanks [TowerX](https://github.com/TowerX "TowerX") for your Spanish translation.
Thanks [yinlianwei](https://github.com/yinlianwei "yinlianwei") for your Simplified Chinese translation.

* Included pull requests
    + Spanish translation
    + Simplified Chinese translation

#### Version 3.1.5
11/10/2015

* Moved CAPTCHA font, Bromine, to core theme folder

#### Version 3.1.4
11/09/2015

* Moved the base classes into their own files
* Added [Table of Contents](#toc) to README.md
* Added new section for [Settings](#settings) in README.md

#### Version 3.1.3
11/02/2015

* Upgraded to CI 3.0.3
    + Requires you to now set your base URL in config.php
* Upgraded jQuery to 1.11.3
* Upgraded Font Awesome to 4.4.0

#### Version 3.1.2
08/25/2015

Thanks [DeeJaVu](https://github.com/DeeJaVu "DeeJaVu") for your Turkish and Dutch translations.

* Included pull requests
    + Turkish translation
    + Dutch translation
* Upgraded to CI 3.0.1

#### Version 3.1.1
06/16/2015

Thanks [arif-rh](https://github.com/arif-rh "Arif RH") and [simogeo](https://github.com/simogeo "Simon Georget")
for your contributions.

* Included pull requests
    + Added base\_url to links
    + Improved theme functions
    + Indonesian translation
    + Repeat Password error fix
* Fixed email validation check during account registration
* Links to this Github page in theme footers

#### Version 3.1.0
04/15/2015

* Upgraded to CI 3.0.0

#### Version 3.0.5
03/11/2015

* Upgraded to CI 3.0rc3

#### Version 3.0.4
02/17/2015

* Upgraded to CI 3.0rc2

#### Version 3.0.3
01/31/2015

* Added missing glyphicon halfling fonts
* Added favicon transparency
* Fixed favicon bug in main template files

#### Version 3.0.2
01/31/2015

* Updated site name in footers

#### Version 3.0.1
01/31/2015

* Upgraded to CI 3.0rc

#### Version 3.0.0
01/31/2015

* Started as a whole new repository (retiring former repo)
* Upgraded to CI 3.0dev
* Stripped out HMVC pattern
* Removed database navigation
* Replaced TinyMCE with Summernote WYSIWYG editor
* Lots of code cleanup and other improvements

#### Version 2.0.0
05/06/2014

Too many to list them all, but here are some of the major changes:

* Added database-driven settings administration
* Included TinyMCE WYSIWYG editor
* Included Bootstrap DatePicker and modified to work with Bootstrap 3.x
* Removed separate auth module and merged into user module
* Added user self-registration and forgot password functionality to the user module
* Removed separate login template
* Added database-driven menus with sub-menu capabilities and built-in Bootstrap formatting
* Added a CAPTCHA-protected contact page with an admin tool to view messages
* Enabled CSRF protection on all forms
* Enabled database session handling
* Tons of code cleanup and miscellaneous improvements

#### Version 1.0.1
10/10/2013

* Removed admin template includes
* Made login more secure using salt
* Modified users table to handle the login change
    + password field is now char(128)
    + added salt field char(128)

#### Version 1.0.0
10/08/2013

* Initial version

<a name="forkit"></a>
## FORK IT!

**Please [fork CI3 Fire Starter on Github](https://github.com/JasonBaier/ci3-fire-starter/fork "Fork It")
and help make it better!**
