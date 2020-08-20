namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Repository\StockRepository;

class MailerCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:mailer';

    protected function configure()
    {
        $this
                // the short description shown while running "php bin/console list"
                ->setDescription('Envoi un mail si le stock de produits est bas')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp('Je ne peu pas être plus clair')


    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       $output->writeln([
               'Mailer stock',
               '============',
               '',
           ]);






        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }
}