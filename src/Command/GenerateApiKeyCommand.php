<?php

namespace App\Command;

use App\Service\ApiKeyGenerator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('app:api-key:generate')]
class GenerateApiKeyCommand extends Command
{
    public function __construct(
        private readonly ApiKeyGenerator $apiKeyGenerator
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $token = $this->apiKeyGenerator->generateToken();
        $this->apiKeyGenerator->createApiKeyFromToken($token);

        $output->writeln($token->getPlainToken());

        return Command::SUCCESS;
    }
}