<?php
namespace App\Controller;
class StockPricesController extends AppController
{
    public function getStockPrice($stocktype)
    {
		$this->layout="ajax";
		
		// Fetch stock prices from database
		$stocksdata = $this->StockPrices->find('all', array(
			'conditions' => array('StockPrices.stock_id' => $stocktype)
		));
		
		// Frame values for charts
		$rs_stocks = array();
		foreach ($stocksdata as $rs){
			$row_price = array(
				"date" =>$rs->stock_date,
				"open" => $rs->stock_open,
				"high" => $rs->stock_high,
				"low" => $rs->stock_low,
				"close" => $rs->stock_close,
				"volume" =>$rs->stock_volume,
				"adjusted" => $rs->stock_adj_volume
			);
			$rs_stocks[] = $row_price;
		}
						
		$resultJ = json_encode($rs_stocks);
		$this->response->type('json');
        $this->response->body($resultJ);
		return $this->response;
    }
	
	public function stockIntegration(){
		$this->layout="ajax";
		$arr_Stocks = array("AAPL", "MSFT", "JNJ", "INTC", "JPM", "AXP");
		//$arr_Stocks = array("AAPL");
		$startDate = '2017-11-01';
		
		$this->StockPrices->deleteAll(
			['StockPrices.stock_is_active' => 1],false 
		);
		
		echo "********* Started to fetch and save stock data *********** <br/>";
		foreach($arr_Stocks as $stockCode){
			$this->fetchAndSave($stockCode, $startDate);
		}
		echo "********* Completed to fetch and save stock data... Enjoy!!! And Happy Analysis!!! ***********";
	
		$resultJ = json_encode(array("result"=>1));
		echo  $resultJ; die;
	}
	
	public function fetchAndSave($stockCode, $startDate){
			echo "Started -- Fetch data of ".$stockCode." from API <br/>";
			// Select end date as today's date
			$end_date = date("Y-m-d");
			
			// Prepare input paramter for API
			$input_data = array('start_date' => $startDate,
					 'end_date' => $end_date,
					 'order' => 'asc',
					 'api_key' => 'aZCWxBU8Ny_MzbzN7ahN');

			$response = $this->callAPI('GET', 'https://www.quandl.com/api/v3/datasets/EOD/'.$stockCode.'?'.http_build_query($input_data), false);
			$jsonFormattedResponse = json_decode($response, true);
			
			echo "Completed -- Fetch data of ".$stockCode." from API <br/>";
			
			echo "Started -- Save data of ".$stockCode." in SQLlite <br/>";
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
			echo "Completed -- Save data of ".$stockCode." in SQLlite <br/>";
	}	

	public function callAPI($method, $url, $data){
		   
		   $curl = curl_init();
		   switch ($method){
			  case "POST":
				 curl_setopt($curl, CURLOPT_POST, 1);
				 if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				 break;
			  case "PUT":
				 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
				 if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
				 break;
			  default:
				 if ($data)
					$url = sprintf("%s?%s", $url, http_build_query($data));
		   }
		   // OPTIONS:
		   curl_setopt($curl, CURLOPT_URL, $url);
		   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			  'APIKEY: 111111111111111111111',
			  'Content-Type: application/json',
		   ));
		   
		   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		   // EXECUTE:
		   $result = curl_exec($curl);
		   if(!$result){die("Connection Failure");}
		   curl_close($curl);
		   
		   return $result;
		}


}