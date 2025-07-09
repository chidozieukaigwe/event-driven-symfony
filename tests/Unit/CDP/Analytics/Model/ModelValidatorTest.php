<?php

namespace App\Tests\Unit\CDP\Analytics\Model;

use App\CDP\Analytics\Model\ModelValidator;
use App\CDP\Analytics\Model\Subscription\Identify\IdentifyModel;
use App\Error\Exception\WebhookException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class ModelValidatorTest extends TestCase
{
    private ModelValidator $unit;

    protected function setUp(): void
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAttributeMapping()
            ->getValidator();

        $this->unit = new ModelValidator($validator);
    }

    public function testInvalidationIdentifyModelFailsValidation(): void
    {
        $model = new IdentifyModel();
        $model->setProduct('');
        $model->setEventDate('12-12-2001');
        $model->setSubscriptionId('12345');
        $model->setEmail('not-an-email');
        $model->setId('some-id');

        try {
            $this->unit->validate($model);
            $this->fail('Expected WebhookException not thrown');
        } catch (WebhookException $exception) {
            $this->assertEquals('Invalid IdentifyModel properties:product, eventDate, email', $exception->getMessage());
        }
    }

    public function testValidationIdentifyModelPassesValidation(): void
    {
        $model = new IdentifyModel();
        $model->setProduct('TechGadget-3000X');
        $model->setEventDate('2025-01-01');
        $model->setSubscriptionId('12345');
        $model->setEmail('email@example.com');
        $model->setId('some-id');

        try {
            $this->unit->validate($model);

            $this->assertTrue(true, 'No WebhookException was thrown');
        } catch (WebhookException $exception) {
            $this->fail('Unexpected WebhookException thrown');
        }
    }
}
