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
            ->assertSee('+255 789 412 904')
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
            ], false)
            ->assertDontSee('md:-mt-10');
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

    public function test_public_section_endpoints_render_clean_section_urls(): void
    {
        $sections = [
            '/request-callback' => 'lead-capture',
            '/quick-actions' => 'quick-actions',
            '/about' => 'about',
            '/audience' => 'audience-fit',
            '/program' => 'featured-program',
            '/offers' => 'offers',
            '/payments' => 'payments',
            '/videos' => 'intro-video',
            '/faq' => 'faq',
            '/start' => 'start-now',
        ];

        foreach ($sections as $path => $anchor) {
            $response = $this->get($path);

            $response
                ->assertOk()
                ->assertSee('id="' . $anchor . '"', false)
                ->assertSee('<link rel="canonical" href="http://localhost' . $path . '">', false);
        }
    }

    public function test_navbar_includes_every_public_section_endpoint(): void
    {
        $response = $this->get('/');

        foreach ([
            '/request-callback',
            '/quick-actions',
            '/about',
            '/audience',
            '/program',
            '/offers',
            '/payments',
            '/videos',
            '/faq',
            '/start',
        ] as $path) {
            $response->assertSee('href="http://localhost' . $path . '"', false);
        }
    }

    public function test_section_tracking_cookie_is_hardened(): void
    {
        $response = $this->get('/offers');

        $cookie = collect($response->headers->getCookies())
            ->first(fn ($cookie) => $cookie->getName() === 'last_visited_section');

        $this->assertNotNull($cookie);
        $this->assertTrue($cookie->isHttpOnly());
        $this->assertSame('strict', strtolower($cookie->getSameSite()));
        $this->assertFalse($cookie->isSecure());
    }

    public function test_swahili_section_endpoints_render_localized_sections(): void
    {
        $response = $this->get('/sw/videos');

        $response
            ->assertOk()
            ->assertSee('id="intro-video"', false)
            ->assertSee('Jenga kipato cha ziada bila kuacha kazi inayokutegemeza sasa.');
    }
}
