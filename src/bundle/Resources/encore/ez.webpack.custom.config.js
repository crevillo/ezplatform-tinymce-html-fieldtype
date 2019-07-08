const Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('web/assets/ezplatform/build')
  .setPublicPath('/assets/ezplatform/build')
  .copyFiles(
    {
      from: './node_modules/tinymce/skins/',
      to: './skins/[path][name].[ext]'
    }
);

customConfig = Encore.getWebpackConfig();

customConfig.name = 'tinymcehtml-fieldtype';

module.exports = customConfig;
