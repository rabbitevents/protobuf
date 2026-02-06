<?php

declare(strict_types=1);

namespace RabbitEvents\Protobuf\Serialization;

use Google\Protobuf\Internal\Message;
use RabbitEvents\Foundation\Contracts\Payload;
use RabbitEvents\Foundation\Contracts\Serializer;
use RabbitEvents\Foundation\Contracts\TransportMessage;

use RabbitEvents\Protobuf\Support\ProtobufPayload;

class ProtobufSerializer implements Serializer
{
    public function serialize(mixed $payload): Payload
    {
        if (!$payload instanceof Message) {
            throw new \InvalidArgumentException('Value must be instance of Google\Protobuf\Internal\Message');
        }

        return new ProtobufPayload($payload);
    }

    public function deserialize(TransportMessage $message): Payload
    {
        $payload = $message->getBody();
        $type = $message->getProperty('type');

        if (class_exists($type) && is_subclass_of($type, Message::class)) {
            $object = new $type();
            $object->mergeFromString($payload);

            return new ProtobufPayload($object);
        }

        throw new \RuntimeException('Generic deserialization for Protobuf is not supported without "type" property with valid class name.');
    }

    public function contentType(): \RabbitEvents\Foundation\Contracts\ContentType
    {
        return new ProtobufContentType();
    }

    public function canSerialize(mixed $payload): bool
    {
        return $payload instanceof Message;
    }
}
