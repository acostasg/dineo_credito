<?php

namespace App\Tests\Admin\Application\User\Create\Validator;

use App\Admin\Application\User\Create\CreateUserCommand;
use App\Admin\Application\User\Create\Validator\CreateUserCommandValidator;
use PHPUnit\Framework\TestCase;

class CreateUserCommandValidatorTest extends TestCase
{

    private CreateUserCommandValidator $createUserCommandValidator;

    protected function setUp(): void
    {
        $this->createUserCommandValidator = new CreateUserCommandValidator();
    }

    /**
     * @test
     */
    public function it_should_return_true_when_validation_passes()
    {
        //TODO use symfony validations
        $command = new CreateUserCommand(
            'name',
            'lastName',
            20,
            'test@mail.com',
            '3734387d-8629-410f-8bb0-5ebbcfe85299'
        );

        $this->createUserCommandValidator->__invoke($command);

        self::expectNotToPerformAssertions();
    }

    /**
     * @test
     */
    public function it_should_return_false_when_validation_fails()
    {
        //TODO use symfony validations
        $command = new CreateUserCommand(
            '',
            '',
            20,
            'test@mail.com',
            '3734387d-8629-410f-8bb0-5ebbcfe85299'
        );

        $this->expectException(\Exception::class);

        $this->createUserCommandValidator->__invoke($command);
    }

}
