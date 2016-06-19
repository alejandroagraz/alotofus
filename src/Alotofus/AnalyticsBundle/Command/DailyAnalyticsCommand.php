<?php

namespace Alotofus\AnalyticsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DailyAnalyticsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('alotofus:analytics:daily')
            ->setDescription('Retrieves required parameters and saves them in the DB')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dailyAnalytic = $this->getContainer()->get('alotofus_analytics.manager.daily')->fetchAndSave();
        $output->writeln('Daily analytics saved successfully');
        $table = new TableHelper();
        $table
            ->setHeaders(array('Analytic','Value'))
            ->setRows(array(
                array('Registered users', $dailyAnalytic->getRegisteredUsers()),
                array('Active users',$dailyAnalytic->getActiveUsers()),
                array('Enroled users', $dailyAnalytic->getEnroledUsers()),
                array('Open offers',$dailyAnalytic->getOpenOffers()),
                array('Registered companies',$dailyAnalytic->getRegisteredCompanies()),
                array('Companies with offers',$dailyAnalytic->getCompaniesWithOffers()),
                array('Average candidates per offers',$dailyAnalytic->getAverageCandidatesPerOffer())
            ));
        $table->render($output);
    }
}
