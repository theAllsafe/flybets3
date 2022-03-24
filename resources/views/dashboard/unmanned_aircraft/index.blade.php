@extends('layouts.index')
@section('style')
<style>
    [dir=ltr] .card,
    [dir=ltr] .card-group {
        margin-bottom: 5px;
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
        <div class="
                  page__heading
                  d-flex
                  flex-column flex-md-row
                  align-items-center
                  justify-content-center justify-content-lg-between
                  text-center text-lg-left
                ">
            <h1 class="m-lg-0">Unmanned Aircraft</h1>
        </div>
    </div>

    <div class="container-fluid page__container">
        <h4 class="card-header__title mb-3">Manage my Unmanned Aircraft</h4>

        <div class="row card-group-row">
            <div class="col-lg-12 col-md-12 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="card-header card-header-large bg-white d-flex align-items-center">
                        <h4 class="card-header__title flex m-0">Unmanned Aircraft Listing</h4>
                    </div>
                    <div class="card card-form">
                        <div class="row no-gutters">
                            <div class="col-lg-12 card-form__body">
                                <div class="table-responsive border-bottom" data-toggle="lists" {{--
                                    data-lists-values='["js-lists-values-employee-name"]' --}}
                                    style="background-color: white">
                                    <form action="{{ route('unmanned-aircraft.search') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="search-form search-form--light m-3" style="background-color: white">
                                            <input type="text" class="form-control search" placeholder="Search"
                                                name="value">
                                            <button class="btn" type="submit" role="button"><i
                                                    class="material-icons">search</i>
                                            </button>
                                        </div>
                                    </form>
                                    <table class="table mb-0 thead-border-top-0">
                                        <thead class="table-header">
                                            <tr>
                                                <th class="table-heads">Description</th>
                                                <th>Manufacturer</th>
                                                <th>Model</th>
                                                <th>Airframe</th>
                                                <th>Colour</th>
                                                <th>Markings</th>
                                                <th>MTOW(kg)</th>
                                                {{-- <th>UA Serial No.</th>--}}
                                                {{-- <th>serial_number</th>--}}
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="staff02">
                                        @if($unmanned_aircrafts->count() != 0)
                                            @foreach($unmanned_aircrafts as $unmanned_aircraft)
                                            <tr style="background-color: white">
                                                <td>
                                                    <span class="js-lists-values-employee-name">
                                                        {{ $unmanned_aircraft->description }}</span>
                                                </td>
                                                <td class="text-muted">{{ $unmanned_aircraft->manufacturer_name }}</td>
                                                <td class="text-muted">{{ $unmanned_aircraft->model_name }}</td>
                                                <td class="text-muted">{{ $unmanned_aircraft->airframe }}</td>
                                                <td class="text-muted">{{ $unmanned_aircraft->colour }}</td>
                                                <td class="text-muted">{{ $unmanned_aircraft->markings }}</td>
                                                <td class="text-muted">{{ $unmanned_aircraft->mtow }}</td>
                                                {{-- <td class="text-muted">{{ $unmanned_aircraft->serial_number }}</td>
                                                --}}
                                                <td>
                                                    <div class="dropdown ml-auto">
                                                        <a href="#" data-toggle="dropdown" data-caret="false"
                                                            class="text-muted">
                                                            <i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item list-item-dropdown"
                                                                href="{{ route('unmanned-aircraft.edit', $unmanned_aircraft->id) }}">Edit</a>
                                                            <a class="dropdown-item list-item-dropdown"
                                                               onclick="loadDeleteModal({{ $unmanned_aircraft->id }})"
                                                                data-target="#modal-small">
                                                                Remove</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" style="text-align: center">There is no Unmanned Aircraft to manage.</td>
                                            </tr>
                                        @endif
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
@if($unmanned_aircrafts->count() != 0)

<form action="{{route('unmanned-aircraft.destroy' , $unmanned_aircraft->id)}}" method="POST"
      id="deleteForm" style="display: none">
    @csrf
    @method('DELETE')
</form>
@endif
@endsection
@section('script')
    <script>

        function loadDeleteModal(id, name) {
            $('#modal-confirm_delete').attr('onclick', `confirmDelete(${id})`);
            $('#deleteRow').modal('show');
        }

        function confirmDelete(id) {
            document.getElementById('deleteForm').action = '/dashboard/unmanned-aircraft/'+id;
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
                <h5 class="modal-title" id="delete-modal-title">Remove Unmanned Aircraft</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> <!-- // END .modal-header -->
            <div class="modal-body">
                <p>Are you sure you want to remove the unmanned aircraft?</p>
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
