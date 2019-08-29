<?php

namespace Tests\Unit\Http\Resources;

use App\Message;
use Tests\TestCase;
use App\Http\Resources\MessagesResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessagesResourceTest extends TestCase
{
    use RefreshDatabase;
    /** @test*/
    public function a_messages_resource_must_have_the_necessary_fields()
    {
        $message = factory(Message::class)->create();
        
        $messageResourceTest = MessagesResource::make($message)->resolve();

        // dd($messageResourceTest);
        $this->assertArrayHasKey(
            'id', 
            $messageResourceTest
        );

        $this->assertArrayHasKey(
            'name', 
            $messageResourceTest
        );

        $this->assertArrayHasKey(
            'body', 
            $messageResourceTest
        );
        
        $this->assertArrayHasKey(
            'created_at', 
            $messageResourceTest
        );
    }
}
