<!-- pdf gomb -->
<div id="editor"></div>

&nbsp;
<div class="col-xs-2">
<button id="cmd"  class='btn btn-primary' >PDF Letöltés</button>
</div>
&nbsp;
<div class="col-xs-2">
<button class='btn btn-primary'>Nyomtatás</button>
</div>
<!-- pdf gomb -->

<!-- pdf script -->
<script>
var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('#cmd').click(function () {   
    doc.fromHTML($('#naptar').html(), 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    });
    doc.save('sample-file.pdf');
});

$('.print-button').on('click', function() {  
    //window.print(); 
    var DocumentContainer = document.getElementById('naptar');
    var WindowObject = window.open('', "PrintWindow", "width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes");
    WindowObject.document.writeln(DocumentContainer.innerHTML);
    WindowObject.document.close();
    WindowObject.focus();
    WindowObject.print();
    WindowObject.close();
    return false; // why false?
  });

</script>

