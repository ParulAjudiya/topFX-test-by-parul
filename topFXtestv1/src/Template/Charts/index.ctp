<?php
//use Cake\Cache\Cache;
//use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
$this->layout = false;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to TopFXtest</title>
	
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
   
    <!-- Icons -->
	<?= $this->Html->css('nucleo/css/nucleo.css') ?>
    <?= $this->Html->css('@fortawesome/fontawesome-free/css/all.min.css') ?>
    
    <!-- Argon CSS -->
	<?= $this->Html->css('argon.css') ?>
	<link rel="stylesheet"  type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.css" />
</head>
<body ng-app="stockChart">
    <!-- Sidenav -->
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
										<span class="navbar-toggler-icon"></span>
									</button>
            <!-- Brand -->
            <a class="navbar-brand pt-0" href="/topFXtestv1/charts">
			<?php echo $this->Html->image('brand/blue.png', ['alt' => 'CakePHP', 'class'=>'navbar-brand-img']); ?>
										
										</a>
            <!-- User -->
            <ul class="nav align-items-center d-md-none">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
								<?php echo $this->Html->image('theme/team-1-800x800.jpg', ['alt' => 'Image placeholder']); ?>
								
															</span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>
                        <a href="#" class="dropdown-item">
							<i class="ni ni-single-02"></i>
							<span>My profile</span>
						</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
							<i class="ni ni-user-run"></i>
							<span>Logout</span>
						</a>
                    </div>
                </li>
            </ul>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="./index.html">
							<?php echo $this->Html->image('brand/blue.png'); ?>
																
																</a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
																	<span></span>
																	<span></span>
																</button>
                        </div>
                    </div>
                </div>
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/charts">
							<i class="ni ni-chart-bar-32 text-primary"></i> Stock Price Chart

						</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="StockPrices/stockIntegration" target="_blank">
							<i class="ni ni-collection text-blue"></i> Run to Save Stocks Data

						</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content">
        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white d-none d-lg-inline-block" href="./index.html">Stock Price Chart</a>
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
								<?php echo $this->Html->image('theme/team-4-800x800.jpg', ['alt' => 'Image placeholder']); ?>
									
																		</span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">Parul Ajudiya</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <a href="#" class="dropdown-item">
								<i class="ni ni-single-02"></i>
								<span>My profile</span>
							</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
								<i class="ni ni-user-run"></i>
								<span>Logout</span>
							</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Header -->
        <div class="header bg-gradient-primary pb-2 pt-5 pt-md-8"></div>
        <!-- Page content -->
        <div class="container-fluid mt--7" ng-controller="stockGraphCtrl">
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-body">
                            
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
												<select ng-options="o.name for o in stock_options" ng-model="selectedOption" ng-change="stockQuoteChange(selectedOption);"></select>
											</div>
                                       </div>
                                    </div>
                                </div>
                        </div>
                        
						<div class="card-header border-0">
			<label class="form-control-label">Showing chart for <b ng-bind="selectedOption.name"></b></label>
              <div class="">
				<nvd3 options="options" data="data" class="with-3d-shadow with-transitions"></nvd3>
			  </div>
			</div>
                    </div>
                </div>
			</div>
        </div>
        <!-- Footer -->
        <footer class="footer">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                     
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
	<?php
	echo $this->Html->script('vendor/jquery/dist/jquery.min.js');
	echo $this->Html->script('vendor/bootstrap/dist/js/bootstrap.bundle.min.js');
	echo $this->Html->script('argon.js?v=1.0.0');
	echo $this->Html->script('vendor/angular/angular.min.js');
	echo $this->Html->script('vendor/nvd/d3.min.js');
	echo $this->Html->script('vendor/nvd/nv.d3.min.js');
	echo $this->Html->script('vendor/nvd/angular-nvd3.js');
	echo $this->Html->script('stockChart.js');
	?>
    <!-- Argon JS -->
</body>
</html>