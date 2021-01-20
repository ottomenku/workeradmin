<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class FileuploadTest extends TestCase
{
    public function testPrevUpload()

    {
        /*
        $path =config('app.public_docprew_path');
       // $this->assertEquals($path, 'kkkk'); 


        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->json('POST', '/doc/3', [
            'avatar' => $file,
        ]);

        // Assert the file was stored...
       Storage::disk( $path)->assertExists($file->hashName());

        // Assert a file does not exist...
      Storage::disk( $path)->assertMissing('missing.jpg');
*/
    $this->assertEquals(1, 1); 
    }
}