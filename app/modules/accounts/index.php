<div class="jumbotron">
  <div class="row">
    <div class="col-lg-9 ">
      <h1 class="display-7">Accounts</h1>
    </div>
  </div>
  <hr class="my-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="btn-toolbar mb-2 mb-md-0">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#accountsModal" id="btn-add-account">Add Account</button>
    </div>
  </div>
  <div class="col-lg-12">
    <table id="accounts" class="display table" style="width:100%">
      <thead class="thead-dark">
        <tr>
          <th>Id</th>
          <th>Username/ Email Address</th>
          <th>Password</th>
          <th>Auth Id</th>
          <th>Auth Password</th>
          <th>Domains Count</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Id</th>
          <th>Username/ Email Address</th>
          <th> Password</th>
          <th>Auth Id</th>
          <th>Auth Password</th>
          <th>Domains Count</th>
          <th>Actions</th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="accountsModal" tabindex="-1" role="dialog" aria-labelledby="accountssModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="POST" class="was-validated" id="accounts_form" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="domainsModalLabel">New Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="authid">Username/Email Address:</label>
              <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
              <label for="authid">Password:</label>
              <input type="text" class="form-control" id="password" placeholder="Enter password" name="password" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
              <label for="authid">Auth Id:</label>
              <input type="text" class="form-control" id="authid" placeholder="Enter auth id" name="auth_id" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
              <label for="authpassword">Auth Password:</label>
              <input type="text" class="form-control" id="authpassword" placeholder="Enter auth password" name="auth_password" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id" id="id" />
            <input type="hidden" name="operation" id="operation" />
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
          </div>
        </div>
      </form>
    </div>
  </div>


    <!-- Modal -->
    <div class="modal fade" id="accountViewModal" tabindex="-1" role="dialog" aria-labelledby="accountssModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="POST" class="was-validated" id="accounts_view_form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="domainsModalLabel">Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="authid">Username/Email Address:</label>
              <input type="text" class="form-control" id="accountusername" placeholder="Username" name="accountusername" readonly >
            </div>
            <div class="form-group">
              <label for="authid">Password:</label>
              <input type="text" class="form-control" id="accountpassword" placeholder="Password" name="accountpassword" readonly>
            </div>
            <div class="form-group">
              <label for="authid">Auth Id:</label>
              <input type="text" class="form-control" id="accountauthid" placeholder="Auth Id" name="accountauthid" readonly>
            </div>
            <div class="form-group">
              <label for="authpassword">Auth Password:</label>
              <input type="text" class="form-control" id="accountauthpassword" placeholder="Auth Password" name="accountauthpassword" readonly>
            </div>
            <div class="form-group">
              <label for="authpassword">Account Balance:</label>
              <input type="text" class="form-control" id="accountbalance" placeholder="Account Balance" name="accountbalance" readonly>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
      function showHideAuthPassword() {
        var myButton = document.getElementsByName('dynamicAuthPass');
        var myInput = document.getElementsByName('viewAuthPass');
        myButton.forEach(function (element, index) {
            element.onclick = function () {
                'use strict';

                if (myInput[index].type == 'password') {
                    myInput[index].setAttribute('type', 'text');
                    element.firstChild.textContent = 'Hide';
                    element.firstChild.className = "";

                } else {
                    myInput[index].setAttribute('type', 'password');
                    element.firstChild.textContent = '';
                    element.firstChild.className = "fa fa-eye";
                }
            }
        })
    }


    function showHidePassword() {
        var myButton = document.getElementsByName('dynamicPass');
        var myInput = document.getElementsByName('viewPass');
        myButton.forEach(function (element, index) {
            element.onclick = function () {
                'use strict';

                if (myInput[index].type == 'password') {
                    myInput[index].setAttribute('type', 'text');
                    element.firstChild.textContent = 'Hide';
                    element.firstChild.className = "";

                } else {
                    myInput[index].setAttribute('type', 'password');
                    element.firstChild.textContent = '';
                    element.firstChild.className = "fa fa-eye";
                }
            }
        })
    }
</script>