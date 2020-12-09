<div class="jumbotron">

    <div class="row">
        <div class="col-lg-9 ">
            <h1 class="display-7">Hello, welcome!</h1>
        </div>
        <div class="col-sm clock-div">
            <div class="clock"> 
            <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=medium&timezone=Asia%2FSeoul" width="100%" height="115" frameborder="0" seamless></iframe> </div>
        </div>
    </div>
    <hr class="my-4">
    <div class="container jumbo-cont-width">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header  card-header-index">
                        <h4>Server Status</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 dashboard-div-buttons">
                            <a href="#" class="btn btn-success">Online</a>
                            <button id="btn-sync-all" class="btn btn-primary sync-btn">Sync All Data</button>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 column">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        <p class="panel-title">
                                            All Systems Operational
                                            <small id="last-refreshed" class="pull-right last-refreshed"> Last updated: </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12 column">
                                        <div class="list-group">
                                            <div class="list-group-item">
                                                <h4 class="list-group-item-heading">
                                                    Website and API
                                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Access website and use site API">
                                                        <i class="fa fa-question-circle"></i>
                                                    </a>
                                                </h4>
                                                <p class="list-group-item-text">
                                                    <span class="label label-danger status-web-api"></span>
                                                </p>
                                            </div>
                                            <div class="list-group-item">
                                                <h4 class="list-group-item-heading">
                                                    Cloudns API
                                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Access site using SSH terminal">
                                                        <i class="fa fa-question-circle"></i>
                                                    </a>
                                                </h4>
                                                <p class="list-group-item-text">
                                                    <span class="label label-success status-web-api"></span>
                                                </p>
                                            </div>
                                            <div class="list-group-item">
                                                <h4 class="list-group-item-heading">
                                                    Database Server
                                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Access database server and execute queries">
                                                        <i class="fa fa-question-circle"></i>
                                                    </a>
                                                </h4>
                                                <p class="list-group-item-text">
                                                    <span class="label label-success status-web-api"></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card-footer text-muted">
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="card-deck card-deck-index">
        <div class="card">
            <h1 class="display-2 text-center counters acc-count">1000</h1>
            <div class="card-body">
                <h5 class="card-title">Accounts</h5>
                
                <p class="card-text"><small class="text-muted last-refreshed">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="card">
        <h1 class="display-2 text-center counters domain-count">3000</h1>
            <div class="card-body">
                <h5 class="card-title">Domains</h5>
               
                <p class="card-text"><small class="text-muted last-refreshed">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="card">
        <h1 class="display-2 text-center counters dns-records dns-records-count">6000</h1>
            <div class="card-body">
                <h5 class="card-title">DNS Records</h5>
                
                <p class="card-text"><small class="text-muted last-refreshed">Last updated 3 mins ago</small></p>
            </div>
        </div>
    </div>
</div>



