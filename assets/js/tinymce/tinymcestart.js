tinymce.init({
    selector: "textarea#e1m1",
    theme: "modern",
    width: 1124,
    height: 400,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media noneditable nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern jbimages importcss"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
    language : 'cs',
    image_advtab: true,
    media_alt_source: true, 
    relative_urls:false,
    noneditable_editable_class: "mceEditable",
    content_css: ["/assets/vendor/bootstrap/css/bootstrap.css","/assets/css/skins/default.css","/assets/css/theme.css","/assets/vendor/font-awesome/css/font-awesome.css","/assets/css/theme-elements.css","/assets/css/theme-blog.css"]
   
 }); 
