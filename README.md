# topfx-test-by-parul

Demo: Please find video from "topfx test demo by Parul.mp4". link --> https://github.com/ParulAjudiya/topfx-test-by-parul

----------------------------------------------------------------------------------------------------------------------

System/Software Requirement:
PHP 7.2.10, Xampp v3.2.2, SQLite 3.7.6.3, CakePHP 3.6 with Composer

----------------------------------------------------------------------------------------------------------------------

Project Configuration and other details (Assumed mentioned system requirement installed in local) Below,

Project Setup:

   Put two folders(stockIntegration and topFXtestv1) from below link to local directory \xampp\htdocs\
    https://github.com/ParulAjudiya/topfx-test-by-parul

----------------------------------------------------------------------------------------------------------------------


Functional Details:

   1. With this link user can able to see OHLC chart of various stock available in dropdown, 
   
       http://localhost/topFXtestv1/charts
       Now web can open by using below command,
       cake server -H 0.0.0.0 -p 8000
         
       This is render to http://localhost:8000/charts

   2. Left sidebar there is one link "Run to Save Stocks Data", While click on this link, 
       stocks prices will get save from 1st november to till now, and once process will get completed, it will show all logs.
      Below link can scrap and save data in sqlite
      http://localhost:8000/StockPrices/stockIntegration
----------------------------------------------------------------------------------------------------------------------

Technical Details:

   1. StockPriceController cotains this
   
   https://github.com/ParulAjudiya/topfx-test-by-parul/blob/master/topFXtestv1/src/Controller/StockPricesController.php
   
   It will fetch stock data from sqlite database and load OCHL chart.
   Sqlite database configuration available at app.config file.
   
   If database need to change from sqlite to mysql or others then just require modification app.config(app.php) file. Because database table data mapped with cake-php model.
   
   SQLite database created with table stock_prices, It is there at \xampp\htdocs\topFXtestv1\webroot\topFXtestdb.sq3
   
   2. Chart view available here, 
   
   https://github.com/ParulAjudiya/topfx-test-by-parul/blob/master/topFXtestv1/src/Template/Charts/index.ctp
    
   It is display OHLC chart according to stock selected from dropdown. It developed with Bootstrap and AngularJS framework.
   Page is responsive and it compatible with Mobile, Tablet and desktop view.
   
   
   
   3. Stock integration script:
   
   https://github.com/ParulAjudiya/topfx-test-by-parul/blob/master/stockIntegration/script.php
   
   This script will fetch sotck data from API and save in sqlite database, This script is developed in php and can be excute from  shell cron script, shell script or from web.
