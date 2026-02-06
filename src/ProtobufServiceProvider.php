<?php

declare(strict_types=1);

namespace RabbitEvents\Protobuf;

use Illuminate\Support\ServiceProvider;
use RabbitEvents\Foundation\Serialization\SerializerRegistry;
use RabbitEvents\Protobuf\Serialization\ProtobufSerializer;

class ProtobufServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->afterResolving(SerializerRegistry::class, function (SerializerRegistry $registry) {
            $registry->register(new ProtobufSerializer());
        });
    }
}
