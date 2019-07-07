import tinymce from 'tinymce/tinymce';

import 'tinymce/themes/silver';

import 'tinymce/plugins/advlist';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/lists'
import 'tinymce/plugins/link'
import 'tinymce/plugins/image'
import 'tinymce/plugins/charmap'
import 'tinymce/plugins/print'
import 'tinymce/plugins/preview'
import 'tinymce/plugins/anchor'
import 'tinymce/plugins/searchreplace'
import 'tinymce/plugins/visualblocks'
import 'tinymce/plugins/code'
import 'tinymce/plugins/fullscreen'
import 'tinymce/plugins/paste'
import 'tinymce/plugins/wordcount'
import 'tinymce/plugins/textcolor'
import 'tinymce/plugins/table'
import 'tinymce/plugins/media'
import 'tinymce/plugins/contextmenu'
import 'tinymce/plugins/paste'
import 'tinymce/plugins/insertdatetime'

console.log('ho');
(function() {
    console.log('gga');
    tinymce.init({
        selector: '.ez-field-edit--eztinymcehtmlblock textarea',
        plugins: [
            "advlist autolink lists link image charmap print preview anchor wordcount",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    })
})();
