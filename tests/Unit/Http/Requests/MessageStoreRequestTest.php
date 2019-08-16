<?php

namespace Tests\Unit\Http\Requests;

use Tests\TestCase;
use App\Http\Requests\MessageStoreRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageStoreRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @var \App\Http\Requests\MessageStoreRequest */
    private $rules;

    public function setUp(): void
    {
        parent::setUp();

        /** ['name' => [ 0 => 'required', 1 => 'string', 3 => 'max:255']]  */
        $this->rules = (new MessageStoreRequest())->rules();  
    }

    /** @test 
     *  Para pasar el test, el orden importa, el mismo orden que esta en $rulesName debe estar en MessageStoreRequest
    */
    public function validate_that_the_name_field_has_all_the_rules()
    {
        $rulesName = [
            0 => 'required',
            1 => 'max:255',
            2 => 'string'
        ];

        foreach ($rulesName as $key => $rule) {
            $this->assertEquals($rule, $this->rules['name'][$key]);
        }
    }

    /** @test */
    public function validate_that_the_email_field_has_all_the_rules()
    {
        $rulesEmail = [
            0 => 'required',
            1 => 'max:255',
            2 => 'email'
        ];

        foreach ($rulesEmail as $key => $rule) {
            $this->assertEquals($rule, $this->rules['email'][$key]);
        }
    }

    /** @test */
    public function validate_that_the_phone_field_has_all_the_rules()
    {
        $rulesPhone = [
            0 => 'required'
        ];

        foreach ($rulesPhone as $key => $rule) {
            $this->assertEquals($rule, $this->rules['phone'][$key]);
        }
    }

    /** @test */
    public function validate_that_the_body_field_has_all_the_rules()
    {
        $rulesBody = [
             0 => 'required'
        ];
 
        foreach ($rulesBody as $key => $rule) {
             $this->assertEquals($rule, $this->rules['body'][$key]);
        }
    }
}
