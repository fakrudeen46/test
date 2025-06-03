<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Testimonial;
use App\User; // Correct User model path for this project

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the home page loads successfully for an authenticated user.
     *
     * @return void
     */
    public function test_home_page_loads_successfully_for_authenticated_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/home');
        $response->assertStatus(200);
    }

    /**
     * Test that the home page displays testimonials when they exist for an authenticated user.
     *
     * @return void
     */
    public function test_displays_testimonials_when_they_exist_for_authenticated_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $testimonials = Testimonial::factory()->count(2)->create();

        $response = $this->get('/home');
        $response->assertStatus(200);

        foreach ($testimonials as $testimonial) {
            $response->assertSee($testimonial->name);
            $response->assertSee(substr($testimonial->testimonial_text, 0, 50));
        }

        $response->assertDontSee('No testimonials found.');
    }

    /**
     * Test that the home page displays the "no testimonials" message when none exist for an authenticated user.
     *
     * @return void
     */
    public function test_displays_no_testimonials_message_when_none_exist_for_authenticated_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // RefreshDatabase ensures the testimonials table is empty at the start of this test.
        $response = $this->get('/home');
        $response->assertStatus(200);
        $response->assertSee('No testimonials found.');
    }

    /**
     * Test that testimonials on the authenticated home page link correctly to their detail page.
     *
     * @return void
     */
    public function test_testimonial_links_correctly_to_detail_page_on_home(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $testimonial = Testimonial::factory()->create();

        $response = $this->get('/home');
        $response->assertStatus(200);

        // Check for the specific link URL
        $response->assertSee(url('/testimonial/' . $testimonial->id));
        // $response->assertSeeHtml('<a href="' . url('/testimonial/' . $testimonial->id) . '"'); // assertSeeHtml not available in this Laravel version
    }
}
