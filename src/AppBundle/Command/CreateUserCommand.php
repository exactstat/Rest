<?php
/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 03.12.17 15:15
 */

namespace AppBundle\Command;

use AppBundle\AppEvents;
use AppBundle\Entity\User;
use FOS\UserBundle\Event\TransferEvent;
use FOS\UserBundle\Model\UserManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateUserCommand
 * @package AppBundle\Command
 * @author Nazar Salo <salo.nazar@gmail.com>
 */
class CreateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('user:create')
            ->setDescription('Creates a new user')
            ->addOption('username', null, InputOption::VALUE_REQUIRED)
            ->addOption('email', null, InputOption::VALUE_REQUIRED)
            ->addOption('password', null, InputOption::VALUE_REQUIRED)
            ->setHelp(
                <<<EOT
                            The <info>%command.name%</info>command creates a new user.

  <info>php %command.full_name% [--grant=...] </info>
EOT
            );
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getOption('username');
        $email = $input->getOption('email');
        $password = $input->getOption('password');

        /** @var UserManager $userManager */
        $userManager = $this->getContainer()->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->getContainer()->get('event_dispatcher');
        /** @var User $user */
        $user = $userManager->createUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setEnabled(true);

        $dispatcher->dispatch(AppEvents::USER_REGISTERED, new TransferEvent($user));

        $userManager->updateUser($user);

        $output->writeln(
            sprintf(
                "User: <info>%s</info>\nemail: <info>%s</info>",
                $username,
                $email
            )
        );
    }
}