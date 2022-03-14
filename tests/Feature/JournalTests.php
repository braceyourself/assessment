<?php

namespace Tests\Feature;

use App\Models\Journal;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JournalTests extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->user = User::factory()->create());
    }

    /** @test */ // an interval can be passed to the journal index endpoint
    public function an_interval_can_be_passed_to_the_journal_index_endpoint()
    {
        // given
        $this->user->addStores(
            $store = Store::factory()->has(
                Journal::factory([
                    'created_at' => today()
                ])->count(100)
            )->create()
        );

        // when
        $response = $this->get("/stores/$store->id/journal?interval=today");

        // then
        $response->assertJson([
            'total' => $store->journal()->since('today')->count()
        ]);
    }
}
