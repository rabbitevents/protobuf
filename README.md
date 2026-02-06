# RabbitEvents Protobuf Extension

[![Tests Status](https://github.com/rabbitevents/protobuf/workflows/Unit%20tests/badge.svg)](https://github.com/rabbitevents/protobuf/actions?query=branch%3Amaster+workflow%3A%22Unit+tests%22)
[![Coverage](https://img.shields.io/endpoint?url=https://gist.githubusercontent.com/eugene-nuwber/874a64850291e5e11090dc0fa7b86495/raw/coverage.json)](https://gist.github.com/eugene-nuwber/874a64850291e5e11090dc0fa7b86495)
[![Total Downloads](https://img.shields.io/packagist/dt/rabbitevents/protobuf)](https://packagist.org/packages/rabbitevents/protobuf)
[![Latest Version](https://img.shields.io/packagist/v/rabbitevents/protobuf)](https://packagist.org/packages/rabbitevents/protobuf)
[![License](https://img.shields.io/packagist/l/rabbitevents/protobuf)](https://packagist.org/packages/rabbitevents/protobuf)

This extension provides Protocol Buffers support for RabbitEvents.

## Installation

```bash
composer require rabbitevents/protobuf
```

## Usage

The extension automatically registers `ProtobufSerializer`.

When you publish an event with a Google Protobuf Message object as the payload, strict typing ensures it is handled by the `ProtobufSerializer`.

```php
$message = new MyProtobufMessage();
$message->setSomeField('value');

RabbitEvents::publish('my.event', $message);
```

The system detects the Protobuf message and uses the correct Content-Type (`application/x-protobuf`).

## Examples 
Examples are available in the [./examples](./examples) directory.
