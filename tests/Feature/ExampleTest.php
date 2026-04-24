<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_homepage_renders_the_brand_experience(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Paul Mwaikenda')
            ->assertSee('/portal/login')
            ->assertSee('Build extra income without walking away from the work that already feeds you.')
            ->assertSee('90 Days of Income Generating Activities');
    }

    public function test_the_homepage_places_visitor_capture_before_supporting_sections(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSeeInOrder([
                'id="lead-capture"',
                'id="quick-actions"',
                'id="intro-video"',
            ], false);
    }

    public function test_the_portal_login_page_renders(): void
    {
        $response = $this->get('/portal/login');

        $response
            ->assertOk()
            ->assertSee('Portal Login')
            ->assertSee('admin@mwalafyale.com');
    }

    public function test_the_swahili_homepage_renders_the_localized_brand_experience(): void
    {
        $response = $this->get('/sw');

        $response
            ->assertOk()
            ->assertSee('Paul Mwaikenda')
            ->assertSee('Jenga kipato cha ziada bila kuacha kazi inayokutegemeza sasa.')
            ->assertSee('Siku 90 za Shughuli Zinazozalisha Kipato');
    }
}
