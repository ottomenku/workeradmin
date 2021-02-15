<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style> *{font-family: DejaVu Sans !important;} </style><!-- jók az ékezetes betúi --->
    <!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-hu-HU.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
 .cp{cursor: pointer;}

</style>

<script>

$(document).ready(function() {
    $('#summernote').summernote({
        lang: 'hu-HU', // default: 'en-US'
      //  placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        buttons: {
           worker : workerDataInsert,
           ceg: cegDataInsert
        },  
        toolbar: [
            ['mybutton', ['worker']],
            ['mybutton2', ['ceg']],
       //   ['style', ['style']],
       ['style', ['style','bold', 'italic', 'underline', 'clear']],
       ['font', ['strikethrough', 'superscript', 'subscript']],
       ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
       //   ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
  });

</script>  
</head>
<body>
<div style="margin:5%">   <center><h3>Dokumentum sablon generálás</h3> </center>
    <button onclick="preview()" title="Letöltés" style=" width:20px;font-size: 18px; padding:2px; line-height:0;" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> </button>

    <form method="post" action="http://localhost:8000/m/ad.man.doc.doctemplate/preview" target="_blank">
        <textarea id="summernote" name="editordata"></textarea>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" value="Submit">
    </form>
    <div style="display:none;">
     <ul class="workerattribute d-none" style="cursor: pointer;">
        <li data-value="<<|worker.name|>>">Név</li>
        <li data-value="<<|worker.user.email|>>">Email</li>
    </ul>
    <ul class="cegattribute d-none" style="cursor: pointer;">
        <li data-value="<<|ceg.cegname|>>">cégnév</li>
        <li data-value="<<|ceg.adoszam|>>">Adószám</li>
    </ul>
    </div>

    <script>    
    var workerDataInsert = function (context) {
        var ui = $.summernote.ui;
      
        var event = ui.buttonGroup([
            ui.button({
                contents: 'Dolgozói adatok beszúrása <i class="fa fa-caret-down" aria-hidden="true"></i><span class="caret"></span>',
              //  tooltip: 'When you insert',
                data: {
                    toggle: 'dropdown'
                }
            }),
            ui.dropdown({
                className: 'drop-default summernote-list cp',
                contents: $('.workerattribute').html(),
                callback: function ($dropdown) {                    
                    $dropdown.find('li').each(function () {
                        $(this).click(function () {  
                      $('#summernote').summernote('editor.restoreRange');
                        $('#summernote').summernote('editor.focus');
                           $('#summernote').summernote('editor.insertText', $(this).data('value'));
                       // $('#summernote').summernote('editor.insertText', 'fghsghsghg');

                        });
                    });
                }
            })
        ]);        

        return event.render();    // return button as jquery object
      }
      var cegDataInsert = function (context) {
        var ui = $.summernote.ui;
      
        var event = ui.buttonGroup([
            ui.button({
                contents: 'Cég adatok beszúrása <i class="fa fa-caret-down" aria-hidden="true"></i><span class="caret"></span>',
              //  tooltip: 'When you insert',
                data: {
                    toggle: 'dropdown'
                }
            }),
            ui.dropdown({
                className: 'drop-default summernote-list cp',
                contents: $('.cegattribute').html(),
                callback: function ($dropdown) {                    
                    $dropdown.find('li').each(function () {
                        $(this).click(function () {  
                      $('#summernote').summernote('editor.restoreRange');
                        $('#summernote').summernote('editor.focus');
                           $('#summernote').summernote('editor.insertText', $(this).data('value'));
                       // $('#summernote').summernote('editor.insertText', 'fghsghsghg');

                        });
                    });
                }
            })
        ]);        

        return event.render();    // return button as jquery object
      }
      var preview = function (){
        
        var dataString =  $("#summernote").html();
        
        $.ajax({
          type: "POST",
          url: "/m/ad.man.doc.doctemplate/create",
          data: {
            "html": dataString,
            "_token": "{{ csrf_token() }}"
          },
          success: function(datas) {
            var w = window.open('about:blank');
            w.document.open();
            w.document.write(datas);
            w.document.close();
        },
        error: function(jqXHR) {
            showError("...");
        }
         /* success: function() {
            $('#form').html("<div id='message'></div>");
            $('#message').html("<h2>Message Submitted.</h2>")
            .append("<p>Thank you for contacting me, I will be in touch soon.</p>")
            .hide()
            .fadeIn(1500);
          }*/
        });
        return false;
        
        }
    </script>  
</body>
</html>