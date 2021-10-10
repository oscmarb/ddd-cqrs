<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model;

use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Tests\Test;

final class ModelTest extends Test
{
    public function test_should_return_expected_model_data(): void
    {
        $id = Uuid::rawUuid();
        $model = ModelMock::create($id);

        self::assertEquals($model, $model->clone());
        self::assertEquals(\json_encode($model->toPrimitives(), JSON_THROW_ON_ERROR), $model->toJson());
        self::assertEquals($model, ModelMock::fromJson($model->toJson()));
        self::assertEquals($model, ModelMock::fromPrimitives($model->toPrimitives()));
        self::assertTrue($model->equals($model));
        self::assertFalse($model->equals(ModelMock::create()));
    }

    public function test_should_detect_model_changes(): void
    {
        $this->assertTrue(ModelMock::create()->update(Uuid::rawUuid(), Uuid::rawUuid(), []));
    }

    public function test_should_not_detect_model_changes(): void
    {
        $id = Uuid::rawUuid();
        $name = Uuid::rawUuid();

        $this->assertFalse(ModelMock::create($id, $name)->update($id, $name, []));
    }

    public function test_should_detect_model_changes_ignoring_attributes(): void
    {
        $this->assertTrue(ModelMock::create()->update(Uuid::rawUuid(), Uuid::rawUuid(), [ModelMock::NAME]));
    }

    public function test_should_not_detect_model_changes_ignoring_attributes(): void
    {
        $id = Uuid::rawUuid();

        $this->assertFalse(ModelMock::create($id)->update($id, Uuid::rawUuid(), [ModelMock::NAME]));
    }
}