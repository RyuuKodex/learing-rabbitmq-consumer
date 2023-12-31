<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Entity\User;
use App\Infrastructure\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
final readonly class CreateUserHandler
{
    public function __construct(private UserRepositoryInterface $repository) {}

    public function __invoke(CreateUser $command): void
    {
        $user = new User(Uuid::v4(), $command->getFirstName(), $command->getSurname(), $command->getEmail());

        $this->repository->save($user);
    }
}
