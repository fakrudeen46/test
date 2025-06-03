<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker; // WithFaker is not strictly needed as Faker is used via factory
use Tests\TestCase;
use App\Models\Testimonial;

class WelcomePageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the welcome page loads successfully.
     *
     * @return void
     */
    public function test_welcome_page_loads_successfully(): void
    {
        // $this->withoutExceptionHandling(); // Option 1: See full exception stack
        $response = $this->get('/');
        if ($response->status() === 500) {
            $response->dump(); // Option 2: Dump response content which might have error details
        }
        $response->assertStatus(200);
    }

    /**
     * Test that the welcome page displays testimonials when they exist.
     *
     * @return void
     */
    public function test_displays_testimonials_when_they_exist(): void
    {
        $testimonials = Testimonial::factory()->count(2)->create();

        $response = $this->get('/');
        $response->assertStatus(200);

        foreach ($testimonials as $testimonial) {
            $response->assertSee($testimonial->name);
            // Assuming Str::limit(..., 150) is used in the blade component
            // A direct assertSee on a snippet might be brittle if the limit changes.
            // A more robust way for snippets might involve checking for a unique part of the text
            // or asserting the presence of the structure that holds the text.
            // For now, checking the name is a good indicator.
            // We can also check for a portion of the text if we are careful.
            $response->assertSee(substr($testimonial->testimonial_text, 0, 50));
        }

        $response->assertDontSee('No testimonials found.');
    }

    /**
     * Test that the welcome page displays the "no testimonials" message when none exist.
     *
     * @return void
     */
    public function test_displays_no_testimonials_message_when_none_exist(): void
    {
        // RefreshDatabase ensures the database is empty at the start of this test.
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('No testimonials found.');
    }

    /**
     * Test that testimonials on the welcome page link correctly to their detail page.
     *
     * @return void
     */
    public function test_testimonial_links_correctly_to_detail_page_on_welcome(): void
    {
        $testimonial = Testimonial::factory()->create();

        $response = $this->get('/');
        $response->assertStatus(200);

        // Check for the specific link URL.
        // Using assertSee with the full URL is generally reliable.
        // To be more precise, one might use assertSeeHtml or assertSeeTextInOrder with parts of the link.
        $response->assertSee(url('/testimonial/' . $testimonial->id));
        // $response->assertSeeHtml('<a href="' . url('/testimonial/' . $testimonial->id) . '"'); // assertSeeHtml not available in this Laravel version
    }
}
