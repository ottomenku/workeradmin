<!DOCTYPE html> 
<html>
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Page Title</title>
        <style> *{font-family: DejaVu Sans !important;} </style>
    @php
        $dc = new \App\Doctemplate();
        
        $include = 'doc_tmpl.'.$dc->getTemplate($viewpar['id'])->filename ?? $viewpar['include'] ?? '';
    @endphp    
</head>
<body>
@include($include)
</body>
</html>