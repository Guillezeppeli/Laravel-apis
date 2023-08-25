<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function testCommentsTableMigration()
    {
        // Run the migration
        $this->artisan('migrate');

        // Verify that the table "comments" exists in the database
        $this->assertTrue(Schema::hasTable('comments'));

        // Verify that the columns exist in the "comments" table
        $this->assertTrue(Schema::hasColumns('comments', [
            'id', 'content', 'user_id', 'status', 'recipe_id',  'created_at', 'updated_at'
        ]));
    }
}
