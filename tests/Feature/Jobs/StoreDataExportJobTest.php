<?php

namespace Tests\Feature\Jobs;

use App\Jobs\StoreDataExportJob;
use App\Mail\StoreExportMail;
use App\Models\Store;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreDataExportJobTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->user = User::factory()->create());

        \Storage::fake();
        \Mail::fake();

        $this->user->addStores(Store::factory()->create());

        $this->job = new StoreDataExportJob(
            $this->store = $this->user->stores->first(),
            $this->email = Factory::create()->safeEmail,
            $this->interval = 'today'
        );
    }
    /** @test */ // the endpoint is available
    public function the_endpoint_is_available()
    {
        $res = $this->post("/stores/{$this->store->id}/export", [
            'email'    => $this->email,
            'interval' => 'today',
        ]);

        $res->assertSuccessful();
    }

    /** @test */ // the job creates a file
    public function the_job_creates_a_file()
    {
        dispatch_sync($this->job);

        $this->assertFileExists(
            \Storage::path($this->job->filename)
        );
    }

    /** @test */ // the job sends an email
    public function the_job_sends_an_email()
    {
        dispatch_sync($this->job);

        \Mail::assertQueued(StoreExportMail::class);
    }
}
