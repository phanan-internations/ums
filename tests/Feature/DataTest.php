<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DataTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    public function testGetData()
    {
        $this->get('api/v1/data')->assertJsonStructure([
            'users',
            'groups',
            'memberships',
        ]);
    }
}
