<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function testFavoritesTableMigration()
    {
        // Run the migration
        $this->artisan('migrate');

        // Verify that the table "favorites" exists in the database
        $this->assertTrue(Schema::hasTable('favorites'));

        // Verify that the columns exist in the "favorites" table
        $this->assertTrue(Schema::hasColumns('favorites', [
            'id', 'user_id', 'recipe_id', 'status', 'created_at', 'updated_at'
        ]));
    }
}
