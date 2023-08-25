<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function testCategoriesTableMigration()
    {
        // Ejecutar la migración
        $this->artisan('migrate');

        // Verificar que la tabla "categories" exista en la base de datos
        $this->assertTrue(Schema::hasTable('categories'));

        // Verificar que las columnas esperadas existan en la tabla
        $this->assertTrue(Schema::hasColumns('categories', [
            'id', 'name', 'status', 'created_at', 'updated_at'
        ]));
    }
}