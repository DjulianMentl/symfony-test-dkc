<?php

namespace App\Command;

use App\Kernel;
use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Stopwatch\Stopwatch;

#[AsCommand(name: 'app:export-user')]
class ExportUserCommand extends Command
{
    private ContainerInterface $container;
    private UserRepository $userRepository;

    public function __construct(ContainerInterface $container, UserRepository $userRepository)
    {
        $this->container = $container;
        $this->userRepository = $userRepository;

        parent::__construct();
    }
    protected function configure(): void
    {
        $this
            ->setDescription('Export users');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $controller = $this->container->get('App\Controller\UserController');
        $controller->exportUsers($this->userRepository);

        $output->writeln('Users exported successfully');

        return Command::SUCCESS;
    }
}