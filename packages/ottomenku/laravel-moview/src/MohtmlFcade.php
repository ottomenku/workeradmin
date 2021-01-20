<?php

namespace Ottomenku\Moview;
use Illuminate\Support\Facades\Facade;

class MoHtmlFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MoHtml';
    }
}
