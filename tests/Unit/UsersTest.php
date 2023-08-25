<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function testUsersTableMigration()
    {
        // Ejecutar la migración
        $this->artisan('migrate');

        // Verificar que la tabla "users" exista en la base de datos
        $this->assertTrue(Schema::hasTable('users'));

        // Verificar que las columnas esperadas existan en la tabla
        $this->assertTrue(Schema::hasColumns('users', [
            'id', 'name', 'email', 'email_verified_at', 'password', 'status', 'remember_token', 'created_at', 'updated_at'
        ]));
    }
}