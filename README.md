# RabbitEvents Protobuf Extension

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
