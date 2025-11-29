# befuture/api-response

<p align="center">
    <img src="https://img.shields.io/badge/PHP-%3E=8.1-blue" alt="PHP Version">
    <img src="https://img.shields.io/github/actions/workflow/status/befutureinteractive/api-response/tests.yml?label=tests" alt="Tests">
    <img src="https://img.shields.io/badge/Laravel-Package-orange" alt="Laravel Package">
    <img src="https://img.shields.io/badge/License-MIT-green" alt="MIT License">
</p>

A lightweight and standardized API JSON response package for Laravel and standalone PHP projects.

## Features

- Unified JSON response structure for success and error cases
- HTTP status code / internal code / message / data / meta fields
- Auto-discovery support for Laravel
- Standalone PHP usage via factory class
- Fully tested with PHPUnit
- GitHub Actions CI workflow included

## Example JSON Structure

```json
{
  "success": true,
  "code": "OK",
  "message": "Operation completed successfully.",
  "data": {
    "id": 1,
    "name": "Example"
  },
  "meta": {
    "request_id": "abc-123",
    "runtime_ms": 12
  }
}
```

## Installation

```bash
composer require befuture/api-response
```

If the package is not published on Packagist yet, you may load it via VCS repository inside your `composer.json`.

## Laravel Integration

The package supports Laravel auto-discovery.  
If you prefer manual registration:

```php
// config/app.php
'providers' => [
    BeFuture\ApiResponse\ApiResponseServiceProvider::class,
],
```

Optional Facade:

```php
'aliases' => [
    'ApiResponse' => BeFuture\ApiResponse\Facades\ApiResponse::class,
],
```

### Usage

```php
use BeFuture\ApiResponse\ApiResponse;

// Success response
return ApiResponse::success(
    data: ['id' => 1],
    message: 'Success'
);

// Error response
return ApiResponse::error(
    message: 'An error occurred.',
    code: 'UNEXPECTED_ERROR',
    httpStatus: 500
);

// Validation error
return ApiResponse::validationError($validator->errors()->toArray());
```

## Framework-Independent Usage

```php
use BeFuture\ApiResponse\ApiResponseFactory;

$factory = new ApiResponseFactory();

$responseArray = $factory->success(
    data: ['foo' => 'bar'],
    message: 'OK'
);

header('Content-Type: application/json');
http_response_code($responseArray['_status']);
echo json_encode($responseArray['body']);
```

## Running Tests

```bash
composer install
vendor/bin/phpunit
```

## License

This project is licensed under the MIT License.  
See `LICENSE` for details.
