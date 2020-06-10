@extends('layouts.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @if(session('update'))
            <div class="alert alert-success">
                {{ session('update') }}
            </div>
    @endif

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Листинг сущности</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Текс сообщения</th>
                            <th>Когда написано</th>
                            <th>Когда обнавлено</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{$message->id}}</td>
                                <td>{{$message->message}}</td>
                                <td>{{$message->created_at}}</td>
                                <td>{{$message->updated_at}}</td>

                                <td>
                                    <a href="{{route('admin.messages.edit', $message->id)}}" class="fa fa-pencil">Edit message</a>
                                </td>
                                <td>
                                    <form action="{{route('admin.messages.destroy',$message->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button  onclick="return confirm('are you sure?')" type="submit" class="delete">Delete</button>
                                    </form>
                                </td>
                            </tr>

                        <tfoot>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
