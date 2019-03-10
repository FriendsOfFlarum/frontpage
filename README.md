# FrontPage by FriendsOfFlarum

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/fof/frontpage.svg)](https://packagist.org/packages/fof/frontpage)

A [Flarum](http://flarum.org) extension. Push discussions to the front of your Flarum forum index!

![](https://i.imgur.com/kwTp4ad.jpg)

![](https://i.imgur.com/lVCGW5T.jpg)

![](https://i.imgur.com/pPh6Ous.jpg)

![](https://i.imgur.com/rcUDOJ3.jpg)

![](https://i.imgur.com/7ec2f5r.jpg)

![](https://i.imgur.com/g9Z4B7r.jpg)

![](https://i.imgur.com/pbk6JaN.jpg)

### Installation

Use [Bazaar](https://discuss.flarum.org/d/5151-flagrow-bazaar-the-extension-marketplace) or install manually with composer:

```sh
composer require fof/frontpage
```

### Updating

```sh
composer update fof/frontpage
php flarum cache:clear
```

### Features to Add by Fixer112
- [x] ~~Added a "FrontPage" sort order option for discussions marked as "FrontPage"~~
- [ ] Add an option to add FrontPage as the default sort order on the index page.

### Features to Add by Friends of Flarum
- [ ] Add "Push to FrontPage" and "Pull from FrontPage" discussion controls to IndexPage instead of post controls (should behave like the Sticky extension).
- [ ] Refactor to add redraw() functionality to dynamically update the DOM after the push/pulls 
buttons are clicked on so no page refresh will be needed.

### Links

- [Packagist](https://packagist.org/packages/fof/frontpage)
- [GitHub](https://github.com/friendsofflarum/frontpage)
- [Fixer112's flarum-frontpage](https://github.com/fixer112/flarum-frontpage)

An extension by [FriendsOfFlarum](https://github.com/FriendsOfFlarum), revival requested by...a VERY eager client!!
