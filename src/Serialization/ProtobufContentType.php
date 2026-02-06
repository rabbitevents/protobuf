<?php

declare(strict_types=1);

namespace RabbitEvents\Protobuf\Serialization;

use RabbitEvents\Foundation\Contracts\ContentType;

class ProtobufContentType implements ContentType
{
    public function __toString(): string
    {
        return 'application/x-protobuf';
    }

    public function getValue(): string
    {
        return 'application/x-protobuf';
    }
}
