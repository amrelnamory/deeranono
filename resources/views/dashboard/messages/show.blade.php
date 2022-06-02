@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.messages') | {{ $message->name }}
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@Lang('site.messages')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.messages.index') }}">@Lang('site.messages')</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $message->name }}</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $message->name }}</h3>
                        </div>
                        <div class="card-body pt-3 pb-3">
                            <!-- /.card-header -->
                            <div class="container-fluid">

                                <table class="table table-bordered text-center">
                                    <tbody>
                                        <tr>
                                            <th class="align-middle">@Lang('site.name')</th>
                                            <td class="align-middle">{{ $message->name }}</td>
                                        </tr>

                                        <tr>
                                            <th class="align-middle">@Lang('site.phone')</th>
                                            <td class="align-middle">{{ $message->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">@Lang('site.email')</th>
                                            <td class="align-middle">{{ $message->email }}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">@Lang('site.subject')</th>
                                            <td class="align-middle">{{ $message->subject }}</td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">@Lang('site.message')</th>
                                            <td class="align-middle">{!! $message->message !!}</td>
                                        </tr>
 
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
