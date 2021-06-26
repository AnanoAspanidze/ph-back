$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Preload Begin -> 
(function(){
    function id(v){ return document.getElementById(v); }
    function loadbar() {
        let ovrl = id("af-preloader"),
            img = document.images,
            c = 0,
            tot = img.length;
        if(tot == 0) return doneLoading();

        function imgLoaded(){
            c += 1;
            if(c===tot) return doneLoading();
        }

        function doneLoading(){
            ovrl.style.opacity = 0;						
            setTimeout(function(){
                ovrl.style.display = "none";
            }, 1200);
        }
        for(var i=0; i<tot; i++) {
            let tImg     = new Image();
            tImg.onload  = imgLoaded;
            tImg.onerror = imgLoaded;
            tImg.src     = img[i].src;
        }    
    }
    document.addEventListener('DOMContentLoaded', loadbar, false);
}());
// Preload <-End

// Delete Data Begin -> 
const deleteData = (elementId, method) => {
    alertify.confirm("წაშლა ?", e => {
        if (e) {
            $.ajax({
                type: "post",
                url: method,
                complete:function(data)
                {
                    if( data.responseJSON.type == 422 ){
                        alertify.alert(data.responseJSON.errors, function() {
                            alertify.error(data.responseJSON.errors)
                        }).set({title:"Error"});
                    } else if(data.responseJSON.type == 200) {
                        $('#' + elementId).fadeOut(() => {
                            $('#' + elementId).remove();
                        });
                    }
                }
            }); 
        }else {
            return false;
        }
    }).set({title:""});
}
// Delete Data <-End

// Toggle Data Begin -> 
const toggleData = (element, method) => {
let data = {};
data.status = $(element).is(':checked') ? 1 : 0;
    $.ajax({
        type: "post",
        url: method,
        data: data,
        complete:function(data)
        {
            if( !data.responseJSON.success ){
                alertify.alert(data.responseJSON.message, function() {
                    alertify.error(data.responseJSON.message)
                }).set({title: "Error"});
            }else {
                alertify.alert(data.responseJSON.message, function() {
                    alertify.success(data.responseJSON.message)
                }).set({title:"Success"});
            }
        }
    });
}
// Toggle Data End -> 

// GetPages Data Begin -> 
const getData = (data, method) => {
    return $.ajax({
        type: "post",
        url: method,
        data: data,
    });
}
// GetPages Data End -> 

// Logout Begin ->
$('#logout').click(function(e){
    e.preventDefault();
    alertify.confirm("პროფილიდან გამოსვლა ?", function (e) {
        if(e) 
            document.location.href="/logout";
        else
            return false;
    }).set({title: ""});
});
// Logout  <- End

// Tinymce Begin ->
var editor_config = {
    path_absolute : "/",
    selector: 'textarea.tinymce-editor',
    relative_urls: false,
    height : "350",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table directionality",
      "emoticons template paste textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    file_picker_callback : function(callback, value, meta) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
      if (meta.filetype == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.openUrl({
        url : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no",
        onMessage: (api, message) => {
          callback(message.content);
        }
      });
    }
  };

  tinymce.init(editor_config);

// Tinymce  <- End


// Remove File Begin -> 
const removeItem = (filename, method, event) => {
    event.preventDefault();
    alertify.confirm("ფაილის წაშლა ?", e => {
        if (e) {
            $.ajax({
                type: "post",
                url: method,
                data: {filename: filename},
                complete:function(data)
                {
                    if( data.responseJSON.type == 422 ){
                        alertify.alert(data.responseJSON.errors, function() {
                            alertify.error(data.responseJSON.errors)
                        }).set({title:"Error"});
                    } else if(data.responseJSON.type == 200) {
                        $('#illustration-wrapper').children().remove();
                        $('#illustration-wrapper').append('<img id="output" class="output-img" />');
                    }
                }
            });
        }else {
            return false;
        }
    }).set({title:""});
}
// Remove File <-End