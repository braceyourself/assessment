<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ModelPermissionTests extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->user = User::first());
    }

    /** @test */ // a user can only see their brands
    public function a_user_can_see_brands()
    {
        // when
        $response = $this->get('/brands');

        // then
        collect($response->json('data'))->each(fn($item) => $this->assertDatabaseHas('brands', $item));
    }

    /** @test */ // a user can view their own stores
    public function a_user_can_view_their_own_stores()
    {
        $res = $this->get('/stores');

        $res->assertSuccessful();
    }

    /** @test */ // a user can not see another users' stores
    public function a_user_can_not_see_another_users_stores()
    {
        $other_user = User::query()->whereKeyNot($this->user->id)->first();

        $res = $this->get("/stores/{$other_user->stores->first()->id}");

        $res->assertForbidden();
    }

    /** @test */ // a user can view the journal entries for their stores
    public function a_user_can_view_the_journal_entries_for_their_stores()
    {
        $res = $this->get("/stores/{$this->user->stores->first()->id}/journal");

        $res->assertSuccessful();
    }

    /** @test */ // users cannot see journal entries of stores they do not own
    public function users_cannot_see_journal_entries_of_stores_they_do_not_own()
    {
        $another_user = User::query()->whereKeyNot($this->user->id)->first();

        $res = $this->get("/stores/{$another_user->stores->first()->id}/journal");

        $res->assertForbidden();
    }
}
