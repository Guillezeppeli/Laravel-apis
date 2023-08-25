<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RecipesTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function testRecipesTableMigration()
    {
        // Run the migration
        $this->artisan('migrate');

        // Verify that the table "recipes" exists in the database
        $this->assertTrue(Schema::hasTable('recipes'));

        // Verify that the columns exist in the "recipes" table
        $this->assertTrue(Schema::hasColumns('recipes', [
            'id', 'title', 'description', 'ingredients', 'preparation_steps', 'cooking_time', 'category_id', 'status', 'created_at', 'updated_at', 'image'
        ]));
    }
}
