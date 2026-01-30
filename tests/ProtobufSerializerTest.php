<?php

namespace RabbitEvents\Protobuf\Tests;

use Google\Protobuf\Internal\Message;
use Mockery;
use PHPUnit\Framework\TestCase;
use RabbitEvents\Foundation\Contracts\TransportMessage;

use RabbitEvents\Protobuf\Serialization\ProtobufContentType;
use RabbitEvents\Protobuf\Serialization\ProtobufSerializer;
use RabbitEvents\Protobuf\Support\ProtobufPayload;

class ProtobufSerializerTest extends TestCase
{
    private ProtobufSerializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = new ProtobufSerializer();
    }

    public function testSerialize(): void
    {
        $message = Mockery::mock(Message::class);
        $message->shouldReceive('serializeToString')->andReturn('serialized');

        $payload = $this->serializer->serialize($message);

        self::assertInstanceOf(ProtobufPayload::class, $payload);
        self::assertEquals('serialized', $payload->serialize());
    }

    public function testSerializeThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->serializer->serialize('string');
    }

    public function testDeserialize(): void
    {

        
        $message = Mockery::mock(TransportMessage::class);
        $message->shouldReceive('getBody')->andReturn('serialized');
        $message->shouldReceive('getProperty')->with('type')->andReturn(SimpleMessage::class);

        $result = $this->serializer->deserialize($message);

        self::assertInstanceOf(ProtobufPayload::class, $result);
        self::assertInstanceOf(SimpleMessage::class, $result->value());
    }

    public function testContentType(): void
    {
        $contentType = $this->serializer->contentType();
        self::assertInstanceOf(ProtobufContentType::class, $contentType);
        self::assertEquals('application/x-protobuf', (string)$contentType);
    }
}

class SimpleMessage extends Message
{
    public function mergeFromString($data): void
    {
    }
}
