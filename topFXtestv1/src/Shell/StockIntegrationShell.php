<?php
namespace App\Shell;
 
use Cake\Console\Shell;

//use App\Controller\Component;
//use Cake\Controller\ComponentRegistry;
//App::uses('Controller', 'StockPrices');

/**
 * StockIntegration shell command.
 */
class StockIntegrationShell extends Shell
{
    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
	 
	 
	public function initialize()
    {
		
        parent::initialize();
		$this->loadModel('StockPrices');
		//$this->stock = new StockPricesController();
		
		//App::import('Component', 'Stocksave');
		//$this->Stocksave = new Stocksave(new ComponentRegistry(), []);
		//$this->Stocksave = new StocksaveComponent();;
    }
	
	
	
	

    public function show()
    {			
		$this->StockPricesModel = ClassRegistry::init('StockPricesModel');
		$this->StockPricesModel->callModel();
   
		/*$stocktype = "AAP";
		// Fetch stock prices from database
		$user = $this->StockPrices->find('all', array(
			'conditions' => array('StockPrices.stock_id' => $stocktype)
		));
       
        $this->out(print_r($user, true)); */
    }
	/*
    public function main()
    {
		$this->loadModel('StockPrices');
		//$uses = array('StockPrices');
		// App::import('Model', 'StockPrices');
		// Fetch stock prices from database
		$stocksdata = $this->StockPrices->find();
		$this->out(print_r($stocksdata, true)); die;
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
			
		print_r($rs_stocks); die;
		
    } */
}