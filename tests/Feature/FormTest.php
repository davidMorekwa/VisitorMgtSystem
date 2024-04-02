<?php

namespace Tests\Feature;

use App\Livewire\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FormTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function assert_event_handled(){
        Livewire::test(Form::class)
            ->dispatch('redirect_event')
            ->assertSet('test', 'Test');
    }
    /** @test */
    public function assert_redirect(){
        Livewire::test(Form::class)
            ->dispatch('redirect_event')
            ->assertSet('test', 'Test')
            // ->assertSee("THANK YOU!")
            ;
    }
}
