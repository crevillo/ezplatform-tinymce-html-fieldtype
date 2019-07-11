ezplatform-tinymce-html-fieldtype
=================================

This package provides a way to enter html directly in eZ with the help of [TinyMCE Editor](
https://www.tiny.cloud/).

The idea come from some request of our customers, asking us for this possibility. 

While we try to explain that is not the best idea (security issues may come, also if you enter 
html badly look and feel may be corrupted...), we are here in a clear case of "custom want this". 
Period.

While this is already possible using a [TextBlock](https://github.com/ezsystems/ezpublish-kernel/tree/master/eZ/Publish/Core/FieldType/TextBlock) Field (
nobody stops you from copy pasting html code there...), you still need some modifications
in the template so html tags are not "escaped". 

This is why I thought about creating a dedicate fieldtype for this. And while on it, 
as the editors may don't know about html at all, i thought we could add an editor to help 
with this matter. 

## Install

There are some manual steps needed to make the whole thing work. As i'm not a webpack expert
i'm more than open to suggestions here. 

Anyway, here are the steps

 * Add tinymce as dependencie executing
    `yarn add tinymce`
 
 * Require this package with `composer require crevillo/ezplatform-tinymce-html-fieldtype`
 
 * Enable the bundle in your `AppKernel.php` adding `new Crevillo\EzTinyMCEHtmlBundle\CrevilloEzTinyMCEHtmlBundle(),`there. 
   I normally do this just above the `AppBundle`
 
 * clear your caches with `php ./bin/console cache:clear`
 
 * re-compile your assets with `php ./bin/console ezplatform:encore:compile`

## usage

To use it, just create a new content type (or editi an existing one) and add an `eztinymcehtmlblock.name`
field to it (sorry, translations come later, but normally you will see this last in the list of 
available fieldtypes)

Create a content of this type and play with TinyMCE!.

## demo

[![tinymce html fieldtype in action](https://img.youtube.com/vi/m1IJi8rMcmE/0.jpg)](https://www.youtube.com/watch?v=m1IJi8rMcmE)
 
  
## todo

* can the install process be improved?
* translations

## customization

before adding proper settings for config the buttons you want or the plugins there is a quick
way to do this from your bundle. 

 
 * If not already created, create a folder called `Resources/public/js/scripts/fieldType`
 * Copy the `vendor/crevillo/ezplatform-tinymce-html-fieldtype/src/bundle/Resources/public/js/scripts/fieldType/eztinymcehtmlblock.js` to that folder
 * Create a `Resources/encore` folder in one your bundle (let's suppose AppBundle here). 
 * Add a file called `ez.config.manager.js` to this folder and with this content 
 ```javascript
 const path = require('path');
 module.exports = (eZConfig, eZConfigManager) => {
     eZConfigManager.replace({
         eZConfig,
         entryName: 'ezplatform-admin-ui-content-edit-parts-js',
         itemToReplace: path.resolve(__dirname, '../../../../vendor/crevillo/ezplatform-tinymce-html-fieldtype/src/bundle/Resources/public/js/scripts/fieldType/eztinymcehtmlblock.js'),
         newItem: path.resolve(__dirname, '../public/js/scripts/fieldType/eztinymcehtmlblock.js'),
     });
 };
```
We are telling webpack that for that `entryName` replace the file provided with this packabe with the custom one.

Now you only need to modify the `src/AppBundle/Resources/public/js/scripts/fieldType/eztinymcehtmlblock.js`
You can define wich buttons, toolsbars or whatever configuration that tinyMCE supports. 

For every change you want, you will need to recompile your assets with 
`./bin/console ezplatform:encore:compile`

Please note that this configuration will be applied globally to all the fields of this type. 
Improves may come in the future :).

## uploading images from tinymce

From version 0.7.0 it's possible to upload images from the tinymce editor. 
The bundle provides a controller to take care all the operations. 

eZ will create a content of type image as a child of the location with id = 51. 
That's the `Media > Images` folder in a eZ Platform common installation. 

To enable this possibility you MUST modify your `app/config/routing.yml` to load
the routes this bundle provides. 
Example:
```yaml
_ez_tinymce_html_fieldtype_routes:
    resource: '@CrevilloEzTinyMCEHtmlBundle/Resources/config/routing.yml'
``` 

Further more, you can configure the parent location of the images that will be created. 
For that, modify your `app/config/configy.yml` adding this

```yaml
crevillo_ez_tiny_mce_html:
    images_parent_location_id: 51 # media > images folder. change to whatever you want
```

The controller will return the `original` variation of the uploaded image. This will 
be configurable in the future. 

## ideas for the future

* Ability to configure buttons, menus etc.
* Could we use CKEditor here or will it conflict with the alloy editor used in rich text? 
Could we combine them?

## disclaimer

Please take note that this fieldtype does not intend to replace the ezrichtext provided with eZ. 
In fact, with this package you will can to add any kind page but you'll miss all the goodies that
RichText offers. For example, there's no connection with the browse window to select something for linking.
You won't can work with custom tags either. Pure html with everything that implies.  

Anyway, we could think in adding these features. If you want to contribute you're more than
welcome!     
