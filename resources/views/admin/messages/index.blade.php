@extends('layouts.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        @if(session('delete'))
            <div class="alert alert-success">
                {{ session('delete') }}
            </div>
        @endif


        <section class="content-header">
            <h1>
                Сообщения
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

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
                            <th>ID Сообщение</th>
                            <th>Сообщение</th>
                            <th>Имя пользователя который написал сообщение</th>
                            <th>Локальное время написания сообщения</th>
                            <th>Локальная тайм зона</th>
                            <th>Показать  сообщение</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>{{$message->id}}</td>
                                <td>{{$message->message}}</td>
                                <td>{{$message->user->name}}</td>
                                <td>{{$message->localTime}}</td>
                                <td>{{$message->timezone}}</td>
                                <td>
                                    <a href="{{route('admin.messages.show', $message->id)}}" class="fa fa-pencil">Show message</a>

                                </td>
                            </tr>
                        @endforeach
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
