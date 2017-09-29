@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Address Book</div>

                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>E-mail</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $entry)
                                <tr>
                                    <td>{!! $entry->name !!}</td>
                                    <td>{!! $entry->phone !!}</td>
                                    <td>{!! $entry->email !!}</td>
                                    <td>{!! $entry->address !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
    $('#example').DataTable();
    } );</script>
@endsection
