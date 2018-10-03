<?php
// src/Model/Entity/Article.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class StockPrice extends Entity
{
    public $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}