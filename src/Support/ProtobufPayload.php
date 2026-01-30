<?php

declare(strict_types=1);

namespace RabbitEvents\Protobuf\Support;

use Google\Protobuf\Internal\Message;
use RabbitEvents\Foundation\Contracts\ContentType;
use RabbitEvents\Foundation\Contracts\Payload;
use RabbitEvents\Protobuf\Serialization\ProtobufContentType;


class ProtobufPayload implements Payload
{
    public function __construct(private Message $value)
    {
    }

    public function value(): Message
    {
        return $this->value;
    }

    public function serialize(): string
    {
        return $this->value->serializeToString();
    }

    public function contentType(): ContentType
    {
        return new ProtobufContentType();
    }
}
