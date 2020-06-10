@extends('layouts.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

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
                            <th>Имя</th>
                            <th>E-mail</th>
                            <th>Аватар</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->profile)
                                    <img src="/storage/{{$user->profile->image}}" alt="" class="img-responsive" width="150">
                                        @endif
                                </td>
                                <td><a href="{{route('admin.users.edit', $user->id)}}" class="fa fa-pencil">edit</a>
                                    <!--<form action="{{route('admin.users.destroy',$user->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button  onclick="return confirm('are you sure?')" type="submit" class="delete">Delete</button>
                                    </form>-->
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
