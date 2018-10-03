<?php
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

class StocksCommand extends Command
{
   public function initialize()
   {
       parent::initialize();
       $this->loadModel('StockPrices');
   }

   public function execute(Arguments $args, ConsoleIo $io)
   {
	
		$arr_Stocks = array("AAPL", "MSFT", "JNJ", "INTC", "JPM", "AXP");
		$startDate = '2017-11-01';
		
		$this->StockPrices->deleteAll(
			['StockPrices.stock_is_active' => 1],false 
		);
		
		$io->out("********* Started to fetch and save stock data *********** \n");
		foreach($arr_Stocks as $stockCode){
			$this->fetchAndSave($stockCode, $startDate);
		}
		$io->out("********* Completed to fetch and save stock data... Enjoy!!! And Happy Analysis!!! *********** \n");
	
		$resultJ = json_encode(array("result"=>1));
		$io->out($resultJ);
   }
   
   private function fetchAndSave($stockCode, $startDate){
			$io->out("Started -- Fetch data of ".$stockCode." from API \n ");
			// Select end date as today's date
			$end_date = date("Y-m-d");
			
			// Prepare input paramter for API
			$input_data = array('start_date' => $startDate,
					 'end_date' => $end_date,
					 'order' => 'asc',
					 'api_key' => 'aZCWxBU8Ny_MzbzN7ahN');

			$response = $this->callAPI('GET', 'https://www.quandl.com/api/v3/datasets/EOD/'.$stockCode.'?'.http_build_query($input_data), false);
			$jsonFormattedResponse = json_decode($response, true);
			
			$io->out("Completed -- Fetch data of ".$stockCode." from API \n");
			
			$io->out("Started -- Save data of ".$stockCode." in SQLlite \n");
			foreach($jsonFormattedResponse["dataset"]["data"] as $row){
				$data = [
					'stock_id' => $jsonFormattedResponse["dataset"]["dataset_code"],
					'stock_date' => strtotime($row[0]),
					'stock_open' => $row[1],
					'stock_high' => $row[2],
					'stock_low' => $row[3],
					'stock_close'=>$row[4],
					'stock_volume'=>$row[5],
					'stock_dividend'=>$row[6],
					'stock_split'=>$row[7],
					'stock_adj_open' => $row[8],
					'stock_adj_high'=>$row[9],
					'stock_adj_low'=>$row[10],
					'stock_adj_close'=>$row[11],
					'stock_adj_volume'=>$row[12],
					'stock_is_active' =>1
				];
				$StockPrices = $this->StockPrices->newEntity();
				$this->StockPrices->patchEntity($StockPrices, $data);
				$this->StockPrices->save($StockPrices );
				
				$lastid = $StockPrices->id;
				//echo $lastid;
			}
			$io->out("Completed -- Save data of ".$stockCode." in SQLlite \n");
	}	
}