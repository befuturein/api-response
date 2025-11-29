<?php

declare(strict_types=1);

namespace BeFuture\ApiResponse\Tests;

use BeFuture\ApiResponse\ApiResponse;
use PHPUnit\Framework\TestCase;

final class ApiResponseTest extends TestCase
{
    public function test_success_response_structure(): void
    {
        $response = ApiResponse::success(['id' => 1], 'OK');

        $this->assertSame(200, $response->getStatusCode());

        $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertTrue($data['success']);
        $this->assertSame('OK', $data['code']);
        $this->assertSame('OK', $data['message']);
        $this->assertSame(['id' => 1], $data['data']);
        $this->assertArrayHasKey('meta', $data);
    }
}