@extends('layouts.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить сообщение
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Редактирование сообщений </h3>
                @include('admin.error')
            </div>
        <div class="col-md-6">
            <div class="form-group">
                <form action="{{route('admin.messages.update', $message)}}" method="post"  enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <label for="exampleInputEmail1"> Текст сообщения
                        <input class="form-control" type="text" name="text" autocomplete="off" value="{{old('text') ?? $message->message}}">
                    </label>
                    <button>Изменитьть сообщение</button>

                </form>

            </div>
        </div>
        <!-- /.content -->
    </div>
        </section>
    </div>

    <!-- /.content-wrapper -->
@endsection
