<?php
namespace EnquisaBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class ProcessCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('enquisa:procesar')
            ->setDescription('Procesar un lote de enquisas')
            ->addArgument(
                'restaurante',
                InputArgument::OPTIONAL,
                'De que restaurante son as enquisas?'
            )
            ->addArgument(
                'ficheiro',
                InputArgument::OPTIONAL,
                'Ficheiro PDF do que se procesan as enquisas?'
            );

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $restaurante = $input->getArgument('restaurante');

        $em = $this->getContainer()->get('doctrine')->getManager();
        $restaurantes = $em->getRepository('EnquisaBundle:Restaurante')->findAll();


        if(empty($restaurante)) {
            /*
            $helper = $this->getHelper('question');
            $question = new ChoiceQuestion(
                'Escolle un restaurante',
                $this->restaurantesToArray($restaurantes),
                0
            );
            $question->setErrorMessage('O restaurante %s non está recollido no sistema.');

            $restaurante = $helper->ask($input, $output, $question);
            $output->writeln('Restaurante: ' . $restaurante);
            */

            $helper = $this->getHelper('question');
            $question = new Question('Nome do restaurante: ');
            $question->setAutocompleterValues($this->restaurantesToArray($restaurantes));

            $restaurante = $helper->ask($input, $output, $question);
        }

        $output->writeln($restaurante);
    }

    private function restaurantesToArray($restaurantes)
    {
        $resultado = array();

        foreach($restaurantes as $restaurante) {
            //$resultado[$restaurante->getId()] = $restaurante->getNome();
            $resultado[] = $restaurante->getNome();
        }

        return $resultado;
    }
}