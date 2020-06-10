@extends('layouts.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Имя пользователя
                <small>{{$user->name}}</small>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <form action="{{route('admin.users.update', $user)}}" method="post"  enctype="multipart/form-data">
                @method('patch')
                @csrf
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Бан разбан пользователя </h3>
                    @include('admin.error')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="banned" id="exampleRadios1" value="1" {{ old('banned',$user->banned) == '1' ? 'checked' : '' }} >
                            <label class="form-check-label" for="exampleRadios1">
                                Banned
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="banned" id="exampleRadios2" value="0" {{ old('banned',$user->banned) == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios2">
                                Not banned
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-warning pull-right">Изменить</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
