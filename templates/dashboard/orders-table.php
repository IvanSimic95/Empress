<table id="orders" class="table table-hover table-striped display responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th scope="col" data-priority="1">Name</th>
        <th scope="col" data-priority="2">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <tr class="align-middle">
        <td>
          <div class="d-flex align-items-center">
            <div class="avatar avatar-xl">
              <img class="rounded-circle" src="../../assets/img/team/4.jpg" alt="" />
            </div>
            <div class="ms-2">Ricky Antony</div>
          </div>
        </td>
        <td>ricky@example.com</td>
        <td>(201) 200-1851</td>
        <td><span class="badge badge rounded-pill d-block p-2 badge-soft-success">Completed<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
        </td>
      </tr>
      <tr class="align-middle">
        <td>
          <div class="d-flex align-items-center">
            <div class="avatar avatar-xl">
              <img class="rounded-circle" src="../../assets/img/team/13.jpg" alt="" />
            </div>
            <div class="ms-2">Emma Watson</div>
          </div>
        </td>
        <td>emma@example.com</td>
        <td>(212) 228-8403</td>
        <td><span class="badge badge rounded-pill d-block p-2 badge-soft-success">Completed<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
        </td>
      </tr>
      <tr class="align-middle">
        <td>
          <div class="d-flex align-items-center">
            <div class="avatar avatar-xl">
              <div class="avatar-name rounded-circle"><span>RA</span></div>
            </div>
            <div class="ms-2">Rowen Atkinson</div>
          </div>
        </td>
        <td>rown@example.com</td>
        <td>(201) 200-1851</td>
        <td><span class="badge badge rounded-pill d-block p-2 badge-soft-primary">Processing<span class="ms-1 fas fa-redo" data-fa-transform="shrink-2"></span></span>
        </td>
      </tr>
      <tr class="align-middle">
        <td>
          <div class="d-flex align-items-center">
            <div class="avatar avatar-xl">
              <img class="rounded-circle" src="../../assets/img/team/2.jpg" alt="" />
            </div>
            <div class="ms-2">Antony Hopkins</div>
          </div>
        </td>
        <td>antony@example.com</td>
        <td>(901) 324-3127</td>
        <td><span class="badge badge rounded-pill d-block p-2 badge-soft-secondary">On Hold<span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span></span>
        </td>
      </tr>
      <tr class="align-middle">
        <td>
          <div class="d-flex align-items-center">
            <div class="avatar avatar-xl">
              <img class="rounded-circle" src="../../assets/img/team/3.jpg" alt="" />
            </div>
            <div class="ms-2">Jennifer Schramm</div>
          </div>
        </td>
        <td>jennifer@example.com</td>
        <td>(828) 382-9631</td>
        <td><span class="badge badge rounded-pill d-block p-2 badge-soft-warning">Pending<span class="ms-1 fas fa-stream" data-fa-transform="shrink-2"></span></span>
        </td>
      </tr>
    </tbody>
  </table>

<?php
$customCSS = '
<link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
';
$customJS = <<<EOT
<script defer="defer" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script defer="defer" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script>
$(document).ready(function() {
    $('#orders').DataTable( {
        responsive: true
    } );
} );
</script>
EOT;
?>