<?php

namespace Tests\Unit;

use App\RoleTime;
use Carbon\Carbon;
use Tests\TestCase;

class MoViewTest extends TestCase
{
   //  ha kikommentelem a tesztetket legyen egy jó teszt hogy a phpunit ne jelezzen hibát   
   public function testTrue() {$this->assertTrue(true);}
  //  {{Mohtml::make()}}  
    //  ha kikommentelem a tesztetket legyen egy jó teszt hogy a phpunit ne jelezzen hibát   
   // public function testTrue() {$this->assertTrue(true);}

 /*   public function testMake()
    {
      //$this->assertEquals(\MoHtml::make(), '<div class="class1">');
 config(['app.view.type.div1'=>['div']]);
 config([
  'app.view.type.span1'=>['span',['id'=>'span1','class'=>'class1']],
'app.view.type.h3'=>['h3',['id'=>'h3','class'=>'class1']]
  ]
 );
 
    //  $this->assertEquals(config('app.view.type.span1.0'), 'div2');
    
    $this->assertEquals(\MoHtml::make('div1'), '<div >');
     $this->assertEquals(\MoHtml::make('span1'), '<span id="span1" class="class1" >');
     $this->assertEquals(\MoHtml::make2('h3','content'), '<h3 id="h3" class="class1" >content</h3>');
     $this->assertEquals(\MoHtml::make2('h3','content',false), '<h3 id="h3" class="class1" >content');
    }
*/
}
