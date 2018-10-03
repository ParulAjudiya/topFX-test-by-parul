<?php
// src/Model/Table/StocksTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class StockPricesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
	
}