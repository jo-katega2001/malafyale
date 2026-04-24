<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadCaptureTest extends TestCase
{
    use RefreshDatabase;

    public function test_lead_capture_can_be_submitted(): void
    {
        $response = $this->postJson(route('leads.store'), [
            'name' => 'Amina Joseph',
            'email' => 'amina@example.com',
            'interest' => 'Starter Guide',
            'source' => 'website',
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('message', trans('messages.lead.request_received', [], 'en'));

        $this->assertDatabaseHas('leads', [
            'name' => 'Amina Joseph',
            'email' => 'amina@example.com',
            'interest' => 'Starter Guide',
            'source' => 'website',
        ]);
    }

    public function test_lead_capture_requires_valid_fields(): void
    {
        $response = $this->postJson(route('leads.store'), [
            'name' => '',
            'email' => 'not-an-email',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email']);
    }

    public function test_lead_capture_can_be_submitted_without_an_email_address(): void
    {
        $response = $this->postJson(route('leads.store'), [
            'name' => 'Neema Julius',
            'occupation' => 'Teacher',
            'location' => 'Dar es Salaam',
            'phone' => '0712345678',
            'instagram' => 'neema.business',
            'interest' => 'Starter Guide',
            'source' => 'website',
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('message', trans('messages.lead.request_received', [], 'en'));

        $this->assertDatabaseHas('leads', [
            'name' => 'Neema Julius',
            'email' => null,
            'phone' => '0712345678',
            'instagram' => 'neema.business',
        ]);
    }

    public function test_lead_capture_returns_a_swahili_success_message_when_the_session_locale_is_swahili(): void
    {
        $response = $this
            ->withSession(['locale' => 'sw'])
            ->postJson(route('leads.store'), [
                'name' => 'Amina Joseph',
                'email' => 'amina@example.com',
                'interest' => 'Mwongozo wa Kuanza',
                'source' => 'website',
            ]);

        $response
            ->assertCreated()
            ->assertJsonPath('message', trans('messages.lead.request_received', [], 'sw'));
    }
}
