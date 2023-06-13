<?php

namespace App\Tests\Admin\Application\User\Find\Validator;

use App\Admin\Application\User\Find\FindUserByEmailQuery;
use App\Admin\Application\User\Find\Validator\FindUserByEmailQueryValidator;
use PHPUnit\Framework\TestCase;

class FindUserByEmailQueryValidatorTest extends TestCase
{

    private FindUserByEmailQueryValidator $findUserByEmailQueryValidator;

    protected function setUp(): void
    {
        $this->findUserByEmailQueryValidator = new FindUserByEmailQueryValidator();
    }

    /**
     * @test
     */
    public function it_should_return_true_when_validation_passes()
    {
        //TODO use symfony validations
        $query = new FindUserByEmailQuery('email@test.com');

        $this->findUserByEmailQueryValidator->__invoke($query);

        self::expectNotToPerformAssertions();
    }

    /**
     * @test
     */
    public function it_should_return_false_when_validation_fails()
    {
        //TODO use symfony validations
        $query = new FindUserByEmailQuery('');

        $this->expectException(\Exception::class);

        $this->findUserByEmailQueryValidator->__invoke($query);
    }

}
