<div class="jumbotron">
  <div class="row">
    <div class="col-lg-9 ">
      <h1 class="display-7">Domains</h1>
    </div>
  </div>
  <hr class="my-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
    <div class="btn-toolbar mb-2 mb-md-0">
      <button type="button" id="btn-sync-domain" class="btn btn-primary mr-1 buttonload">Sync</button>
      <button type="button" class="btn btn-success btn-new-domain" data-toggle="modal" data-target="#domainsModal">Add Domain</button>
    </div>
  </div>
  <div class="col-lg-12">
    <table id="domains" class="display table" style="width:100%">
      <thead class="thead-dark">
        <tr>
          <th>Id</th>
          <th>Domain name</th>
          <th>Status</th>
          <th>Registered on</th>
          <th>Expires on</th>
          <th>Privacy Protection</th>
          <th>Owner Account/ Email</th>
          <th>Days Remaining</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Id</th>
          <th>Domain name</th>
          <th>Status</th>
          <th>Registered on</th>
          <th>Expires on</th>
          <th>Privacy Protection</th>
          <th>Owner Account/ Email</th>
          <th>Days Remaining</th>
          <th>Actions</th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- Modal -->
  <div class="modal fade  bd-example-modal-xl" id="domainsModal" tabindex="-1" role="dialog" aria-labelledby="domainsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="domainsModalLabel">New Domain</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" class="was-validated" id="domains_form" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="uname">Account:</label>
                  <select id="ajaxData" data-placeholder="select" name="acc_id" class="chosen-select form-control" style="width:100%; background-image: none;" cltabindex="2">

                  </select>
                </div>
                <div class="well">
                  <div class="form-group">
                    <label for="domainname">Domain name:</label>
                    <input type="text" class="form-control" id="dname" placeholder="Enter domain name" name="dname" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="form-group">
                    <label for="tld">TLD:</label>
                    <input type="text" class="form-control" id="tld" placeholder="Enter tld (Ex: com, net, org, etc)" name="tld" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="form-group">
                    <label for="period">Period:</label>
                    <input type="number" class="form-control" id="period" placeholder="Enter registration period in years" name="period" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email address" name="email" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter First and last name of the person" name="name" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter address of the company/person(street, number, etc)" name="address" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="well">

                  <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" id="city" placeholder="Enter city name (Ex: Dallas)" name="city" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="form-group">
                    <label for="state">State:</label>
                    <input type="text" class="form-control" id="state" placeholder="Enter state name (Ex: Texas)" name="state" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="form-group">
                    <label for="zip">Zip:</label>
                    <input type="number" class="form-control" id="zip" placeholder="Enter ZIP code" name="zip" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" class="form-control" id="country" placeholder="Enter 2 letters ONLY country code according to ISO 3166" name="country" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="form-group">
                    <label for="telnocc">Telnocc:</label>
                    <input type="text" class="form-control" id="telnocc" placeholder="Enter phone number calling code. Between 1 and 3 digits." name="telnocc" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="form-group">
                    <label for="telno">Tel no:</label>
                    <input type="text" class="form-control" id="telno" placeholder="Enter phone number" name="telno" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-xl clear-dom-modal" tabindex="-1" role="dialog" aria-labelledby="nameServersModal" id="nameServersModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Name Servers</h5>
        <button type="button" class="close clear-dom-modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table name-server-modal">
          <thead class="thead-light">
            <tr>
              <th scope="col">id</th>
              <th scope="col">name</th>
            </tr>
          </thead>
          <tbody id="name-server-details">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary clear-dom-modal" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>