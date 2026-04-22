<?php

namespace Tests\Feature;

use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UrlShortenTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shorten_url_and_redirects_back_with_short_url(): void
    {
        $response = $this->post('/shorten', [
            'url' => 'https://example.com/some/long/path',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('short_url');

        $this->assertDatabaseCount('urls', 1);

        $url = Url::first();

        $this->assertNotNull($url);
        $this->assertEquals('https://example.com/some/long/path', $url->original_url);
        $this->assertNotEmpty($url->short_code);
        $this->assertTrue(strlen($url->short_code) >= 5);

        $this->assertEquals(url('/') . '/' . $url->short_code, session('short_url'));
    }

    public function test_it_requires_a_valid_url(): void
    {
        $response = $this->from('/')->post('/shorten', [
            'url' => 'not-a-valid-url',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('url');

        $this->assertDatabaseCount('urls', 0);
    }

    public function test_it_redirects_to_original_url_by_short_code(): void
    {
        $url = Url::create([
            'original_url' => 'https://laravel.com/docs',
            'short_code' => 'abcde',
            'visits' => 0,
        ]);

        $response = $this->get('/' . $url->short_code);

        $response->assertRedirect('https://laravel.com/docs');
        $this->assertDatabaseHas('urls', [
            'id' => $url->id,
            'visits' => 1,
        ]);
    }

    public function test_it_returns_404_for_unknown_short_code(): void
    {
        $response = $this->get('/unknown-code');

        $response->assertNotFound();
    }
}
