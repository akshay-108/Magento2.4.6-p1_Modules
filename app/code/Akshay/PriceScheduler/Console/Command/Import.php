<?php
namespace Akshay\PriceScheduler\Console\Command;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Akshay\PriceScheduler\Model\ProductUploader;
use Akshay\PriceScheduler\Helper\Data; 

class Import extends Command
{    
   
    public function __construct(Data $helper)
    {
        $this->helper = $helper;
        parent::__construct();
    }
    protected function configure()
   {
       $this->setName('product:special_price_scheduler');
       $this->setDescription('Export product data');
       
       parent::configure();
   }
   protected function execute(InputInterface $input, OutputInterface $output)
   {
       $output->writeln(sprintf('<comment>Processing...</comment>'));
       $this->helper->Uploader();
       $output->writeln(sprintf('<comment>Done</comment>'));
       return 0;
   }
}