<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>
  <div class="section-user">
    <h1>Resident Personal Info</h1>

    <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important;">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <!-- <th>Photo</th> -->
          <th>Phone</th>
          <th>Location</th>
          <th>Zip Code</th>
          <th>Gender</th>
          <th>Birthday</th>
        </tr>
      </thead>
      <tbody>
        @if($user)
          <tr>
            <td>{{ $user->firstname . " " . $user->lastname }}</td>
            <td>{{ $user->email }}</td>
            <!-- <td><img src="{{ asset('uploads/') . $user->profile_logo }}" /></td> -->
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->street1 . " " . $user->street2 . " " . $user->city . " " . $user->state }}</td>
            <td>{{ $user->zip_code }}</td>
            <td>{{ App\User::getGender($user->gender) }}</td>
            <td>{{ $user->birthday }}</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>

  <div class="section-representative">
    <h1>Representatives Info</h1>

    <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important;">
      <thead>
        <tr>
          <th>No</th>
          <th>Type</th>
          <th>Name</th>
          <th>Location</th>
          <th>Zip Code</th>
          <th>HOME PHONE</th>
          <th>CELL PHONE</th>
        </tr>
      </thead>
      <tbody>
        @foreach($representatives as $representative)
          <tr>
            <td>{{ $representative->id }}</td>
            <td>{{ App\Representatives::getTypeasstring($representative->representative_type) }}</td>
            <td>{{ $representative->firstname . " " . $representative->lastname }}</td>
            <td>{{ $representative->street1." ".$representative->street2." ".$representative->city." ".$representative->state }}</td>
            <td>{{ $representative->zip_code }}</td>
            <td>{{ $representative->home_phone }}</td>
            <td>{{ $representative->cell_phone }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="section-health-care-center-info">
    <h1>Health Care Center Info</h1>

    <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important;">
      <thead>
        <tr>
          <th>No</th>
          <th>Type</th>
          <th>Name</th>
          <th>Street</th>
          <th>City</th>
          <th>CELL PHONE</th>
          <th>FAX</th>
        </tr>
      </thead>
      <tbody>
        @if($healthcarecenters)
          @foreach($healthcarecenters as $healthcarecenter)
              <tr>
                  <td>{{ $healthcarecenter->id }}</td>
                  <td>{{ App\HealthCareCenters::getTypeasstring($healthcarecenter->health_care_center_type   ) }}</td>
                  <td>{{ $healthcarecenter->firstname . " " . $healthcarecenter->lastname }}</td>
                  <td>{{ $healthcarecenter->street1." ".$healthcarecenter->street2 }}</td>
                  <td>{{ $healthcarecenter->city }}</td>
                  <td>{{ $healthcarecenter->phone }}</td>
                  <td>{{ $healthcarecenter->fax }}</td>
              </tr>
          @endforeach
      @endif
      </tbody>
    </table>
  </div>

  <div class="section-settings">
    <h1>Settings Info</h1>

    <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important;">
      <thead>
        <tr>
          <th>Tab Name</th>
          <th>Field Name</th>
          <th>Field Value</th>
        </tr>
      </thead>
      <tbody>
        @if($resident_settings)
          @foreach($resident_settings as $rs)
            <tr>
              <td>{{ $rs->tabName }}</td>
              <td>{{ $rs->fieldName }}</td>
              <td>{{ $rs->typeName }}</td>
            </tr>
          @endforeach
      @endif
      </tbody>
    </table>
  </div>

  <style type="text/css">
    thead {
      display: table-header-group;
      vertical-align: middle;
      border-color: inherit;
    }

    table {
      border-right-width: 0;
      width: 100%!important;
      border-collapse: initial!important;
      border-spacing: 0!important;
      border-radius: .85rem;
      clear: both;
      margin-top: 6px!important;
      margin-bottom: 6px!important;
      max-width: none!important;
      border-collapse: separate!important;
      border-spacing: 0;
      border: 1px solid #ebedf3;
    }

    tr {
      display: table-row;
      vertical-align: inherit;
      border-color: inherit;
    }

    td, th {
      padding-right: 30px;
      border-left-width: 0;
      cursor: pointer;
      position: relative;
      border-top: 0;
      font-weight: 500;

      font-weight: 400;
      font-size: 1rem;
      vertical-align: middle;
      color: #3f4254;
      -webkit-transition: color .15s ease,background-color .15s ease,border-color .15s ease,-webkit-box-shadow .15s ease;
      transition: color .15s ease,background-color .15s ease,border-color .15s ease,-webkit-box-shadow .15s ease;
      transition: color .15s ease,background-color .15s ease,border-color .15s ease,box-shadow .15s ease;
      transition: color .15s ease,background-color .15s ease,border-color .15s ease,box-shadow .15s ease,-webkit-box-shadow .15s ease;
      outline: 0!important;
      padding: 1rem 1rem;
      border-bottom: 2px solid #ebedf3;
      border-bottom-width: 1px;
      border: 1px solid #ebedf3;
    }

    tbody {
      display: table-row-group;
      vertical-align: middle;
      border-color: inherit;
    }
  </style>
</body>
</html>