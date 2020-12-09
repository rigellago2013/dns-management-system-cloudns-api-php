<nav id="sidebar">
  <div class="p-4 pt-5">
    <!-- <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(assets/images/giphy.gif); background-color: #1d1919"></a> -->
    <ul class="list-unstyled components mb-5">
      <!-- <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
              <li>
                <a href="#">Home 1</a>
              </li>
              <li>
                <a href="#">Home 2</a>
              </li>
              <li>
                <a href="#">Home 3</a>
              </li>
            </ul>
          </li> -->
      <li class="<?php echo (isset($_GET['mod']) && $_GET['mod'] != 'index') ? '' : 'active'; ?>">
        <a class="" href="?mod=index"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Home</a>
      </li>
      <li class="<?php echo (isset($_GET['mod']) && $_GET['mod'] == 'accounts') ? 'active' : ''; ?>">
        <a href="?mod=accounts"><i class="fa fa-users fa-fw" aria-hidden="true"></i>&nbsp; Accounts</a>
      </li>
      <li class="<?php echo (isset($_GET['mod']) && $_GET['mod'] == 'domains') ? 'active' : ''; ?>">
        <a class="" href="?mod=domains"><i class="fa fa-cloud fa-fw" aria-hidden="true"></i>&nbsp; Domains</a>
      </li>
      <li class="<?php echo (isset($_GET['mod']) && $_GET['mod'] == 'dns') ? 'active' : ''; ?>">
        <a href="?mod=dns"><i class="fa fa-server fa-fw" aria-hidden="true"></i>&nbsp; DNS Records</a>
      </li>
      <li class="<?php echo (isset($_GET['mod']) && $_GET['mod'] == 'logs') ? 'active' : ''; ?>">
        <a href="?mod=logs"><i class="fa fa-history fa-fw" aria-hidden="true"></i>&nbsp; Logs</a>
      </li>
    </ul>
  </div>
</nav>