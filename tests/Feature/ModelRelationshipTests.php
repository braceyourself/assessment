<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Journal;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModelRelationshipTests extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->user = User::first());
    }

    /** @test */ // a user has stores
    public function a_user_has_stores()
    {
        $this->assertNotEmpty($this->user->stores);
        $this->assertInstanceOf(Store::class, $this->user->stores->first());
    }

    /** @test */ // a brand has stores
    public function a_brand_has_stores()
    {
        $brand = Brand::first();

        $this->assertNotEmpty($brand->stores);
        $this->assertInstanceOf(Store::class, $brand->stores->first());
    }

    /** @test */ // a store has journal entries
    public function a_store_has_journal_entries()
    {
        $store = Store::first();

        $this->assertNotEmpty($store->journals);
        $this->assertInstanceOf(Journal::class, $store->journals->first());
    }

    /** @test */ // a store has a brand
    public function a_store_has_a_brand()
    {
        $store = Store::first();

        $this->assertInstanceOf(Brand::class, $store->brand);
    }

    /** @test */ // a journal belongs to store
    public function a_journal_belongs_to_store()
    {
        $j = Journal::first();

        $this->assertInstanceOf(Store::class, $j->store);
    }

    /** @test */ // a user can add stores to their account
    public function a_user_can_add_stores_to_their_account()
    {
        $user = User::factory()->create();

        $user->addStores(Store::factory()->create());
        $user->addStores(Store::factory()->count(2)->create());

        $this->assertCount(3, $user->stores()->get());
    }

    /** @test */ // a user can get a list of their store's brands
    public function a_user_can_get_a_list_of_their_store_s_brands()
    {
        $brands = $this->user->store_brands;

        $this->assertInstanceOf(Brand::class, $brands->first());

    }
}
