@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
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
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $entry)
                                <tr id="entry{!! $entry->id !!}" >
                                    <td class="entry-name">{!! $entry->name !!}</td>
                                    <td class="entry-phone">{!! $entry->phone !!}</td>
                                    <td class="entry-email">{!! $entry->email !!}</td>
                                    <td class="entry-address">{!! $entry->address !!}</td>
                                    <td class="dropdown">
                                        <a id="drop4" class="btn btn-default" role="button" data-toggle="dropdown" href="#">
                                            Select an action <b class="caret"></b></a>
                                        <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#"  data-toggle="modal" data-target="#myModal" onclick="EntryEditData({!! $entry->id !!})">Edit</a></li>

                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#myModal2" onclick="EntryDeleteData({!! $entry->id !!})">Delete</a></li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <h2 class="text-center">Add a new record</h2>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        {!! Form::open(['url' => '/admin', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-8">
                                {!! Form::text('name','', ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                @if ($errors->has('name'))
                                    </br>
                                    <div class="alert alert-danger">
                                        {!! $errors->first('name') !!}
                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-8">
                                {!! Form::text('phone','', ['class' => 'form-control', 'placeholder' => 'Phone']) !!}
                                @if ($errors->has('phone'))
                                    </br>
                                    <div class="alert alert-danger">
                                        {!! $errors->first('phone') !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                {!! Form::email('email','', ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                                @if ($errors->has('email'))
                                    </br>
                                <div class="alert alert-danger">
                                    {!! $errors->first('email') !!}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-8">
                                {!! Form::text('address','', ['class' => 'form-control', 'placeholder' => 'Address']) !!}
                                @if ($errors->has('address'))
                                    </br>
                                    <div class="alert alert-danger">
                                        {!! $errors->first('address') !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8 text-center">
                                {!! Form::submit('Create', ['class' => 'btn btn-default']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Editor</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/admin','method' => 'put', 'class' => 'form-horizontal', 'id' => 'edit_form', 'role' => 'form']) !!}

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-8">
                            {!! Form::text('edit_name','', ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                            @if ($errors->has('edit_name'))
                                </br>
                                <div class="alert alert-danger">
                                    {!! $errors->first('edit_name') !!}
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-8">
                            {!! Form::text('edit_phone','', ['class' => 'form-control', 'placeholder' => 'Phone']) !!}
                            @if ($errors->has('edit_phone'))
                                </br>
                                <div class="alert alert-danger">
                                    {!! $errors->first('edit_phone') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-8">
                            {!! Form::email('edit_email','', ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                            @if ($errors->has('edit_email'))
                                </br>
                                <div class="alert alert-danger">
                                    {!! $errors->first('edit_email') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-8">
                            {!! Form::text('edit_address','', ['class' => 'form-control', 'placeholder' => 'Address']) !!}
                            @if ($errors->has('edit_address'))
                                </br>
                                <div class="alert alert-danger">
                                    {!! $errors->first('edit_address') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8 text-center">
                            {!! Form::submit('Save changes', ['class' => 'btn btn-default']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModal2Label">Delete</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this entry?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::open(['url' => '/admin', 'method' => 'delete', 'class' => 'form-horizontal', 'id' => 'delete_form', 'role' => 'form', 'style' => 'display: inline-block;']) !!}
                    <button type="submit" class="btn btn-primary">Yes</button>
                    {!! Form::close() !!}
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
        function EntryEditData(id) {
            $("input[name='edit_name']").val($("#entry" + id +">.entry-name").text());
            $("input[name='edit_phone']").val($("#entry" + id +">.entry-phone").text());
            $("input[name='edit_email']").val($("#entry" + id +">.entry-email").text());
            $("input[name='edit_address']").val($("#entry" + id +">.entry-address").text());
            $("#edit_form")[0].action += '/' + id;
        }
        function EntryDeleteData(id) {
            $("#delete_form")[0].action += '/' + id;
        }
    </script>
@endsection
