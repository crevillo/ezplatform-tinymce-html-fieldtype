const Encore = require('@symfony/webpack-encore');
const copyWebpackPlugin = require('copy-webpack-plugin');
const path = require('path');

Encore.addPlugin(new copyWebpackPlugin([
    {
        from: path.resolve(__dirname, '../../../../../node_modules/tinymce/skins'),
        to: path.resolve(__dirname, '../../../../../web/assets/ezplatform/build/skins')
    }
]));

module.exports = Encore.getWebpackConfig();
