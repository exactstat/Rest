<?php

/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 30.11.17 21:00
 */

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateClientCommand
 * @package Proofpilot\AppBundle\Command
 * @author Nazar Salo <salo.nazar@gmail.com>
 */
class CreateClientCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('oauth-client:create')
            ->setDescription('Creates a new client')
            ->addOption('grant', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY)
            ->addArgument(
                'hosts',
                InputArgument::OPTIONAL,
                'Set host'
            )
            ->setHelp(
                <<<EOT
                            The <info>%command.name%</info>command creates a new client.

  <info>php %command.full_name% [--grant=...] </info>
EOT
            );
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $hosts = $input->getArgument('hosts');
        $hosts = $hosts ?? 'api.money.loc';
        $client->setRedirectUris([$hosts]);

        $client->setAllowedGrantTypes($input->getOption('grant'));

        $clientManager->updateClient($client);

        $output->writeln(
            sprintf(
                "Id: <info>%s</info>\nSecret: <info>%s</info>",
                $client->getPublicId(),
                $client->getSecret()
            )
        );
    }
}