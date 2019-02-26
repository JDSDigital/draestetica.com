/* ------------------------------------------------------------------------------
*
*  # CKEditor editor
*
*  Demo JS code for editor_ckeditor.html page
*
* ---------------------------------------------------------------------------- */

document.addEventListener('DOMContentLoaded', function() {

    // Setup
    if (document.querySelector('#blog-article') !== null) {
      CKEDITOR.replace('blog-article', {
        height: 400,
        extraPlugins: 'forms'
      });
    }

    if (document.querySelector('#social-article') !== null) {
      CKEDITOR.replace('social-article', {
        height: 400,
        extraPlugins: 'forms'
      });
    }

    if (document.querySelector('#clinicservices-description') !== null) {
      CKEDITOR.replace('clinicservices-description', {
        height: 400,
        extraPlugins: 'forms'
      });
    }

});
