<?php
namespace EnquisaBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('enquisa:procesar')
            ->setDescription('Procesar un lote de enquisas')
            ->addArgument(
                'restaurante',
                InputArgument::REQUIRED,
                'De que restaurante son as enquisas?'
            )
            ->addArgument(
                'ficheiro',
                InputArgument::REQUIRED,
                'Ficheiro PDF do que se procesan as enquisas?'
            );

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $restaurante = $input->getArgument('restaurante');

        $text = $restaurante;

        $output->writeln($text);
    }
}