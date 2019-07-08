module.exports = (Encore) => {
    Encore.copyFiles({
        from: './node_modules/tinymce/skins',
        to: 'skins/[path][name].[ext]'
    })
}
