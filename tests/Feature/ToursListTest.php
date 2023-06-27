<?php

namespace Tests\Feature;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ToursListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A feature test tours list by travel slug returns paginated data correctly.
     */
    public function test_tours_list_by_travel_slug_returns_paginated_data_correctly(): void
    {
        // generate fake data
        $travel = Travel::factory(['is_public' => true])->create();
        $tour = Tour::factory(16)->create(['travel_id' => $travel->id]);

        $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours');

        $response->assertStatus(200);
        $response->assertJsonCount(15,'data');
        $response->assertJsonPath('meta.last_page',2);
        $response->assertJsonFragment(['id'=>$tour[0]->id]);
    }
    /**
     * A feature test tour price is shown correctly.
     */
    public function test_tour_price_is_shown_correctly(): void
    {
        // generate fake data
        $travel = Travel::factory(['is_public' => true])->create();
        Tour::factory()->create([
                'travel_id' => $travel->id,
                'price' => 236.78
            ]);

        $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours');

        $response->assertStatus(200);
        $response->assertJsonCount(1,'data');
        $response->assertJsonFragment(['price'=>'236.78']);
    }
}
