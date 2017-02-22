<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateGameTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    function a_user_can_create_a_game()
    {
        // $this->disableProtectionHandling();
        //Arrange
        $user = factory(\App\Models\User::class)->create();

        //Act
        $response = $this->json('POST', 'api/game', [
            'user_id' => $user->id
        ]);

        //Assert
        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                "data" => [
                    'moderator',
                    'key',
                ]
            ]);
    }

    /** @test */
    function a_valid_user_is_required_to_create_game()
    {
        //Arrange
        //no user

        //Act
        $response = $this->json('POST', 'api/game', [
            'user_id' => 0
        ]);

        $response->assertStatus(422);
        $this->assertArrayHasKey('user_id', $response->decodeResponseJson());

        // dd($response->decodeResponseJson());


    }

}
