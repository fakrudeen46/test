<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Testimonial;
use App\User; // Using App\User as per project structure

class TestimonialDetailPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the testimonial detail page loads successfully for an existing testimonial.
     *
     * @return void
     */
    public function test_detail_page_loads_successfully_for_existing_testimonial(): void
    {
        // Authentication is not strictly required for testimonial detail page based on current routes,
        // but testing with it is fine. If guest access is intended and fails,
        // it implies middleware might be unexpectedly applied.
        // $user = User::factory()->create();
        // $this->actingAs($user);

        $testimonial = Testimonial::factory()->create();

        $response = $this->get("/testimonial/{$testimonial->id}");
        $response->assertStatus(200);
        $response->assertSee($testimonial->name);
        $response->assertSee($testimonial->title);
        $response->assertSee($testimonial->testimonial_text); // Full text should be present
        $response->assertSee('Back to Home');
    }

    /**
     * Test that a 404 status is returned for a non-existent testimonial.
     *
     * @return void
     */
    public function test_returns_404_for_non_existent_testimonial(): void
    {
        // $user = User::factory()->create();
        // $this->actingAs($user);

        $response = $this->get('/testimonial/999'); // Assuming 999 does not exist
        $response->assertStatus(404);
    }
}
