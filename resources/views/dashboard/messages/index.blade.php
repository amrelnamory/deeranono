@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.messages')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark mb-2">@Lang('site.messages')<span class="mr-3 btn btn-success"
                            style="cursor: default; font-weight: bold;">{{ $messages->count() }}</span></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item active">@Lang('site.messages')</li>

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
                            <h3 class="card-title">@Lang('site.messages')</h3>
                        </div>
                        <div class="card-body table-responsive p-3">
                            <!-- /.card-header -->
                            @if ($messages->count() > 0)

                                <table class="table table-bordered text-center data_table mb-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@Lang('site.name')</th>
                                            <th>@Lang('site.phone')</th>
                                            <th>@Lang('site.subject')</th>
                                            <th>@Lang('site.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($messages as $index => $message)
 
                                            <tr>
                                                <td class="align-middle">{{ $index + 1 }}</td>
                                                <td class="align-middle">{{ $message->name }}</td>
                                                <td class="align-middle">{{ $message->phone }}</td>
                                                <td class="align-middle">{{ $message->subject }}</td>
 
                                                <td class="align-middle">

                                                    <a href="{{ route('dashboard.messages.show', $message->id) }}"
                                                        class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i>
                                                        @Lang('site.show_message_details')</a>

                                                     

                                                    @if (auth()->user()->hasPermission('delete_messages'))
                                                        <form
                                                            action="{{ route('dashboard.messages.destroy', $message->id) }}"
                                                            method="post" style="display: inline-block">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            <button type="submit" class="btn btn-danger delete btn-sm"><i
                                                                    class="fa fa-trash"></i>
                                                                @lang('site.delete')</button>
                                                        </form><!-- end of form -->

                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h2>@Lang('site.no_data_found')</h2>
                            @endif
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
