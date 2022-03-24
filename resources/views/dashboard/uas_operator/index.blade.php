@extends('layouts.index')
@section('style')
    <style>
        [dir=ltr] .card, [dir=ltr] .card-group {
            margin-bottom: 5rem;
        }

        .table-header {
            background-color: #f6f6f6;
        }

        .table-header th {
            font-weight: 900;
            font-size: 18px;
        }

        .list-item-dropdown:hover {
            color: blue !important;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div
                class="
                  page__heading
                  d-flex
                  flex-column flex-md-row
                  align-items-center
                  justify-content-center justify-content-lg-between
                  text-center text-lg-left
                "
            >
                <h1 class="m-lg-0">UAS Operator</h1>
            </div>
        </div>

        <div class="container-fluid page__container">
            <h4 class="card-header__title mb-3">Manage my UAS Pilot</h4>

            <div class="row card-group-row">
                <div class="col-lg-12 col-md-12 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-header card-header-large bg-white d-flex align-items-center">
                            <h4 class="card-header__title flex m-0">UAS Pilot Listing</h4>
                            <div>
                                <a href="{{ route('uas-operator.create') }}" class="btn btn-primary"
                                   style="font-size: 25px;padding: 0 12px">+</a>
                            </div>
                        </div>
                        <div class="card card-form">
                            <div class="row no-gutters">
                                <div class="col-lg-12 card-form__body">
                                    <div class="table-responsive border-bottom" data-toggle="lists"
                                         data-lists-values='["js-lists-values-employee-name"]'
                                         style="background-color: white">
                                        <form action="{{ route('uas-operator.search') }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="search-form search-form--light m-3"
                                                 style="background-color: white">
                                                <input type="text" class="form-control search" placeholder="Search" name="value">
                                                <button class="btn" type="button" role="button"><i
                                                        class="material-icons">search</i>
                                                </button>
                                            </div>
                                        </form>
                                        <table class="table mb-0 thead-border-top-0">
                                            <thead class="table-header">
                                            <tr>
                                                <th class="table-heads">Name</th>
                                                <th>Email</th>
                                                <th>Contact Mobile</th>
                                                <th>National ID</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>Postcode</th>
                                                <th>Country</th>
                                                <th>1-2Fly ID</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody class="list" id="staff02">
                                            @foreach($uas_operators as $uas_operator)
                                                <tr style="background-color: white">
                                                    <td>
                                                        <span
                                                            class="js-lists-values-employee-name">{{ $uas_operator->user->first_name . ' ' .$uas_operator->user->last_name  }}</span>
                                                    </td>
                                                    <td class="text-muted">{{ substr($uas_operator->user->email, 0, 8) }}</td>
                                                    <td class="text-muted">{{ substr($uas_operator->user->mobile_number,0,5) }}</td>
                                                    <td class="text-muted">{{ $uas_operator->user->national_passport_id }}</td>
                                                    <td class="text-muted">{{ $uas_operator->address}}</td>
                                                    <td class="text-muted">{{ $uas_operator->city }}</td>
                                                    <td class="text-muted">{{ $uas_operator->postcode }}</td>
                                                    <td class="text-muted">{{ $uas_operator->country }}</td>
                                                    <td class="text-muted">{{ $uas_operator->fly_registration_id }}</td>
                                                    <td>
                                                        <div class="dropdown ml-auto">
                                                            <a href="#" data-toggle="dropdown" data-caret="false"
                                                               class="text-muted">
                                                                <i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item list-item-dropdown"
                                                                   href="{{ route('uas-operator.editByUser', $uas_operator->id) }}">Edit</a>
                                                                <a class="dropdown-item list-item-dropdown"
                                                                     onclick="loadDeleteModal({{ $uas_operator->id }})"
                                                                     data-target="#modal-small">
                                                                    Remove</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{route('unmanned-aircraft.destroy' , 0)}}" method="POST"
          id="deleteForm" style="display: none">
        @csrf
        @method('DELETE')
    </form>
@endsection
@section('script')
    <script>

        function loadDeleteModal(id, name) {
            $('#modal-confirm_delete').attr('onclick', `confirmDelete(${id})`);
            $('#deleteRow').modal('show');
        }

        function confirmDelete(id) {
            document.getElementById('deleteForm').action = '/dashboard/uas-operator/pilot/'+id+'/delete';
            document.getElementById('deleteForm').submit();
        }

    </script>
@endsection
@section('modal')
    <div id="deleteRow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete-modal-title"
         aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-title">Remove UAS Operator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> <!-- // END .modal-header -->
                <div class="modal-body">
                    <p>Are you sure you want to remove the UAS Operator?</p>
                </div> <!-- // END .modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary"
                            id="modal-confirm_delete">
                        Remove
                    </button>
                </div> <!-- // END .modal-footer -->
            </div> <!-- // END .modal-content -->
        </div> <!-- // END .modal-dialog -->
    </div> <!-- // END .modal -->
@endsection
