<?php

namespace Tests\Feature;

use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListTravelsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A feature test travels list returns paginated data correctly.
     */
    public function test_travels_list_returns_paginated_data_correctly(): void
    {
        // generate fake data
        Travel::factory(20)->create(['is_public' => true]);

        $response = $this->get('/api/v1/travels');

        $response->assertStatus(200);
        $response->assertJsonCount(10,'data');
        $response->assertJsonPath('meta.last_page',2);
    }
    /**
     * A feature test i.e. travels list shows only public records.
     */
    public function test_travels_list_shows_only_public_records(): void
    {
        // generate fake data
        $publicRecord=Travel::factory()->create(['is_public' => true]);
        Travel::factory()->create(['is_public' => false]);

        $response = $this->get('/api/v1/travels');

        $response->assertStatus(200);
        $response->assertJsonCount(1,'data');
        $response->assertJsonPath('data.0.name',$publicRecord->name);
    }
}
