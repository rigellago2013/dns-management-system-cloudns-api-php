<div class="jumbotron">
    <div class="row">
        <div class="col-lg-9 ">
            <h1 class="display-7">Logs</h1>
        </div>
    </div>
    <hr class="my-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0 d-inline">
            <div class="form-group" id="log-picker">
                <label for="">Clear logs: </label>
                <select class="dd-clear-logs" id="dd-clear-logs" style="width: 150px;">
                    <option>All</option>
                    <option>For today</option>
                    <option>Date range</option>
                </select>
                <div id="date-picker-log" class="d-inline"></div>
                <button type="button" class="btn btn-danger btn-xs" id="btn-clear-log">Clear logs</button>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <table id="logs-table" class="table display" style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Table Name</th>
                    <th>Request Method</th>
                    <th>Data</th>
                    <th>Recorded On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Table Name</th>
                    <th>Request Method</th>
                    <th>Data</th>
                    <th>Recorded On</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-xl" id="logsModal" tabindex="-1" role="dialog" aria-labelledby="logsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logsModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="well">
                                <form id="logsForm" novalidate="novalidate">
                                    <div class="form-group">
                                        <label for="id" class="control-label">Id</label>
                                        <input type="text" class="form-control" id="log-id" name="log-id" value="" placeholder="Id" readonly>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="data" class="control-label">Data</label>
                                        <!-- <textarea rows="4" cols="50" name="data" id="data" > -->
                                        <textarea class="form-control" rows="5" id="data" readonly></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="recorded_on" class="control-label">Recorded on</label>
                                        <input type="text" class="form-control" id="recorded_on" name="recorded_on" value="" placeholder="Recorded on" readonly>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="request_method" class="control-label">Request Method</label>
                                        <input type="text" class="form-control" id="request_method" name="request_method" value="" placeholder="Request Method" readonly>
                                        <span class="help-block"></span>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="well">
                                <div class="form-group">
                                    <label for="type" class="control-label">Table name</label>
                                    <input type="text" class="form-control" id="table_name" name="table_name" value="" placeholder="Table name" readonly>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>