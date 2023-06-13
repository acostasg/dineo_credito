<?php

namespace App\Admin\Application\User\Create\Validator;

use App\Admin\Application\User\Create\CreateUserCommand;

class CreateUserCommandValidator
{
    /**
     * @param CreateUserCommand $command
     * @return void
     * @throws \Exception
     */
    public function __invoke(CreateUserCommand $command): void
    {
        $errors = [];
        //TODO use symfony validations

        if (empty($command->getName())) {
            $errors['name'] = 'Name is required';
        }

        if (empty($command->getLastName())) {
            $errors['lastName'] = 'Last Name is required';
        }

        if (empty($command->getAge())) {
            $errors['age'] = 'age is required';
        }

        if (empty($command->getEmail())) {
            $errors['email'] = 'Email is required';
        }

        if (empty($command->getCityId())) {
            $errors['cityId'] = 'City Id is required';
        }

        if (!empty($errors)) {
            throw new \Exception('Validation failed', 422);
        }
    }

}