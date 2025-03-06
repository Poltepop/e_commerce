<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testStoragePublic(){
        $filesystem = Storage::disk('public');
        $filesystem->put('file.txt', 'test file storage');

        $content = $filesystem->get('file.txt');
        self::assertEquals('test file storage', $content);
    }
}
