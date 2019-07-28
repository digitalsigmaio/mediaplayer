<?php

namespace Tests\Feature;

use App\Admin;
use App\Album;
use App\Track;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrackTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_delete_track()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $album = factory( Album::class )->create();
        $track = $album->tracks()->create( factory( Track::class )->raw() );

        $this->delete( '/tracks/' . $track->id )->assertStatus( 204 );
    }

    /** @test */
    public function admin_can_restore_deleted_track()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $album = factory( Album::class )->create();
        $track = $album->tracks()->create( factory( Track::class )->make()->toArray() );

        $this->delete( '/tracks/' . $track->id )->assertStatus( 204 );

        $this->patch( '/tracks/trash/' . $track->id )->assertStatus( 200 );
    }

    /** @test */
    public function admin_can_see_trashed_tracks()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $album = factory( Album::class )->create();
        $track = $album->tracks()->create( factory( Track::class )->make()->toArray() );

        $this->delete( '/tracks/' . $track->id )->assertStatus( 204 );

        $this->get( '/tracks/trash')->assertSee( $track->title );
    }

    /** @test */
    public function admin_can_delete_trashed_tracks_forever()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $album = factory( Album::class )->create();
        $track = $album->tracks()->create( factory( Track::class )->make()->toArray() );

        $this->delete( '/tracks/' . $track->id )->assertStatus( 204 );
        $this->delete( '/tracks/trash/' . $track->id )->assertStatus( 204 );
        $this->get( '/tracks/trash')->assertDontSee( $track->title );
    }

    /** @test */
    public function it_can_record_views()
    {
        $album = factory( Album::class )->create();
        $track = $album->tracks()->create( factory( Track::class )->make()->toArray() );

        $this->json('get','/api/tracks/' . $track->id)
            ->assertStatus(200);

        $this->assertDatabaseHas('viewables', ['viewable_type' => get_class($track), 'viewable_id' => $track->id]);
    }
}
