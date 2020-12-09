<div class="jumbotron">
  <div class="row">
    <div class="col-lg-9 ">
      <h1 class="display-7">DNS Records</h1>
    </div>
  </div>
  <hr class="my-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="btn-toolbar mb-2 mb-md-0">
      <button type="button" class="btn btn-primary mr-1" id="btn-sync-dnsrecord">Sync</button>
      <button type="button" class="btn btn-success" id="btn-dns-rec-modal" data-toggle="modal" data-target="#dnsRecModal">Add DNS Record</button>
    </div>  
  </div>
  <div class="col-lg-12">
    <table id="dnsrecords-table" class="display table" style="width: 100%;">
      <thead class="thead-dark">
        <tr>
          <!-- <th>Id</th> -->
          <th class="dns-records-th-15">Domains</th>
          <th class="dns-records-th-15">Type</th>
          <th class="dns-records-th-15">Host</th>
          <th class="dns-records-th-15">Record</th>
          <th class="dns-records-th-15">Fail Over</th>
          <th class="dns-records-th-15">TTL</th>
          <th class="dns-records-th-5">Status</th>
          <th class="dns-records-th-5">Actions</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <!-- <th>Id</th> -->
          <th>Domains</th>
          <th>Type</th>
          <th>Host</th>
          <th>Record</th>
          <th>Fail Over</th>
          <th>TTL</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="dnsRecModal" tabindex="-1" role="dialog" aria-labelledby="dnsRecModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="domainsModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="well">
                <form id="dnsrecordsForm" method="POST"  novalidate="novalidate">
                  <div class="form-group">
                    <label for="id" class="control-label">Id</label>
                    <input type="text" class="form-control" id="dns-record-id" name="dns-record-id" value="" placeholder="Record ID. You can see this ID with the method List records">
                    <span class="help-block"></span>
                  </div>
                  <div class="form-group">
                    <label for="host" class="control-label">Host</label>
                    <input type="text" class="form-control" id="host" name="host" value="" placeholder="host / subdomain">
                    <span class="help-block"></span>
                  </div>
                  <div class="form-group">
                    <label for="record" class="control-label">Record</label>
                    <input type="text" class="form-control" id="record" name="record" value="" placeholder="Record you want to add. Example 10.10.10.10 or cname.cloudns.net">
                    <span class="help-block"></span>
                  </div>
                  <div class="form-group">
                  <label for="fail_over" class="control-label">Fail Over</label>
                  <input type="text" class="form-control" id="fail_over" name="fail_over" value="" placeholder="Fail Over">
                  <span class="help-block"></span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="well">
              <div class="form-group">
                  <label for="type">Type:</label>
                  <select data-placeholder="select" name="type" class="chosen-select form-control" id="record-type" style="width:100%; background-image: none;" cltabindex="2">
                  <option value="A">A</option>
                  <option value="AAA">AAA</option>
                  <option value="MX">MX</option>
                  <option value="CNAME">CNAME</option>
                  <option value="TXT">TXT</option>
                  <option value="SPF">SPF </option>
                  <option value="NS">NS</option>
                  <option value="SRV">SRV</option>
                  <option value="WR">WR</option>
                  <option value="ALIAS">ALIAS</option>
                  <option value="RP">RP</option>
                  <option value="SSHFP">SSHFP</option>
                  <option value="NAPTR">NAPTR</option>
                  <option value="CAA">CAA</option>
                  <option value="TLSA">TLSA</option>
                  <option value="DS">DS</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="username" class="control-label">Domain Name</label>
                  <input type="text" class="form-control" id="domain_name" name="domain_name" value="" placeholder="Domain name or reverse zone name you want to assign new record to">
                  <span class="help-block"></span>
                </div>
                <div class="form-group">
                  <label for="ttl" class="control-label">Ttl</label>
                  <input type="text" class="form-control" id="ttl" name="ttl" value="" placeholder="Ttl">
                  <span class="help-block"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="operation" id="operation" />
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-save-record" id="btn-save-record">Save changes</button>
          <button type="button" class="btn btn-danger btn-remove-record">Remove</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>