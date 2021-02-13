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
<style>
 .cp{cursor: pointer;}

</style>

<script>

$(document).ready(function() {
    $('#summernote').summernote({
      
      //  placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        buttons: {
            hello: emojiList
        },  
        toolbar: [
            ['mybutton', ['hello']],
       //   ['style', ['style']],
         ['font', ['bold', 'underline', 'clear']],
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
    <form method="post">
        <textarea id="summernote" name="editordata"></textarea>
    </form>
    <div style="display:none;">
     <ul class="attribute d-none" style="cursor: pointer;">
        <li data-value="||First.Namełł">First Name</li>
        <li data-value="{Last Name}">Last Name</li>
    </ul>

    </div>
  
    <script>    
    var emojiList = function (context) {
        var ui = $.summernote.ui;
      
        var event = ui.buttonGroup([
            ui.button({
                contents: 'Placeholders <i class="fa fa-caret-down" aria-hidden="true"></i><span class="caret"></span>',
                tooltip: 'When you insert',
                data: {
                    toggle: 'dropdown'
                }
            }),
            ui.dropdown({
                className: 'drop-default summernote-list cp',
                contents: $('.attribute').html(),
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
    
    
    </script>  
</body>
</html>