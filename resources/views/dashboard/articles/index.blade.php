@extends('layouts.dashboard.app')

@section('title')
    @Lang('site.articles')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark mb-2">@Lang('site.articles')<span class="mr-3 btn btn-success"
                            style="cursor: default; font-weight: bold;">{{ $articles->count() }}</span></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.home')</a>
                        </li>
                        <li class="breadcrumb-item active">@Lang('site.articles')</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (auth()->user()->hasPermission('create_articles'))
                <a href="{{ route('dashboard.articles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                    @lang('site.add_article')</a>

            @endif

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
                            <h3 class="card-title">@Lang('site.articles')</h3>
                        </div>
                        <div class="card-body table-responsive p-3">
                            <!-- /.card-header -->
                            @if ($articles->count() > 0)

                                <table class="table table-bordered text-center data_table mb-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@Lang('site.title')</th>
                                            <th>@Lang('site.image')</th>
                                            <th>@Lang('site.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($articles as $index => $article)

                                            @php
                                                $image = json_decode($article->images, true);
                                            @endphp

                                            <tr>
                                                <td class="align-middle">{{ $index + 1 }}</td>
                                                <td class="align-middle">{{ $article->title }}</td>

                                                <td class="align-middle"><img
                                                        src="{{ $article->image_path . '/' . $image[0] }}"
                                                        style="width: 150px;" class="img-thumbnail" alt=""></td>

                                                <td class="align-middle">

                                                    <a href="{{ route('dashboard.articles.show', $article->id) }}"
                                                        class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i>
                                                        @Lang('site.show_article_details')</a>

                                                    @if (auth()->user()->hasPermission('update_articles'))
                                                        <a href="{{ route('dashboard.articles.edit', $article->id) }}"
                                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                            @Lang('site.edit')</a>

                                                    @endif


                                                    @if (auth()->user()->hasPermission('delete_articles'))
                                                        <form
                                                            action="{{ route('dashboard.articles.destroy', $article->id) }}"
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
