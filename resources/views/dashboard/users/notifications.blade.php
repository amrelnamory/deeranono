@extends('layouts.dashboard.app')

@section('title')
    @lang('site.users')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                {{-- <div class="col-sm-12 text-center">
                 <button class="btn btn-warning btn-lg">@Lang('site.users') ({{ $users->count() }})</button>
            </div> --}}
                <!-- /.col -->
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">@Lang('site.dashboard')</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">@Lang('site.users')</a>
                        </li>
                        <li class="breadcrumb-item active">@Lang('site.notifications')</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            {{-- @if (auth()->user()->hasPermission('create_users'))
        <a href="{{ route('dashboard.users.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>
            @lang('site.add_new_employee')</a>
        @endif --}}
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">اشعارات {{ $user->name }}</h3>
                        </div>
                        <div class="card-body table-responsive p-3">
                            <!-- /.card-header -->
                            @if ($user->notifications->count() > 0)
                                <table class="table table-bordered text-center mb-4 big_font">

                                    <tbody>
                                        @foreach ($user->notifications as $notification)
                                            <tr>
                                                <td class="align-middle">{{ $loop->index + 1 }}</td>


                                                @if ($notification->unread())
                                                    <td class="align-middle">

                                                        @if ($notification->type == 'App\Notifications\AddImagesDone')
                                                            <a onclick="markNotificationAsRead('{{ $notification->id }}');"
                                                                class="text-success text-bold"
                                                                href="{{ route('dashboard.purchases.showImages', $notification->data['images_done']['purchase_item_id']) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-globe mr-2"></i>
                                                                <span class="float-right text-muted text-sm"> </span>
                                                                {{ $notification->data['user']['name'] }} : أضاف الصور
                                                                المنجزة للمنتج
                                                                {{ $notification->data['product']['name'] }}
                                                                {{ $notification->data['product']['digital_code'] }} <br>

                                                            </a>
                                                            <small
                                                                class="text-muted pr-4">{{ \Carbon\Carbon::Parse($notification->data['images_done']['created_at'])->diffForHumans() }}</small>
                                                        @endif

                                                        @if ($notification->type == 'App\Notifications\AddImagesNote')
                                                            <a onclick="markNotificationAsRead('{{ $notification->id }}');"
                                                                class="text-success text-bold"
                                                                href="{{ route('dashboard.purchases.showNotes', $notification->data['images_note']['images_done_id']) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-globe mr-2"></i>
                                                                <span class="float-right text-muted text-sm"> </span>
                                                                {{ $notification->data['user']['name'] }} : أضاف ملاحظة
                                                                للمنتج
                                                                {{ $notification->data['product']['name'] }}
                                                                {{ $notification->data['product']['digital_code'] }} <br>

                                                            </a>
                                                            <small
                                                                class="text-muted pr-4">{{ \Carbon\Carbon::Parse($notification->data['images_note']['created_at'])->diffForHumans() }}</small>
                                                        @endif

                                                        @if ($notification->type == 'App\Notifications\AddClient')
                                                            <a onclick="markNotificationAsRead('{{ $notification->id }}');"
                                                                class="text-success text-bold"
                                                                href="{{ route('dashboard.clients.show', $notification->data['client']['id']) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-globe mr-2"></i>
                                                                <span class="float-right text-muted text-sm"> </span>
                                                                {{ $notification->data['user']['name'] }} : : <span
                                                                    class="text-dark"> أضاف العميل
                                                                    {{ $notification->data['client']['name'] }}
                                                                    <span> <br>
                                                                        <small
                                                                            class="text-muted pr-4">{{ \Carbon\Carbon::Parse($notification->data['client']['created_at'])->diffForHumans() }}</small>
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                        @endif

                                                        @if ($notification->type == 'App\Notifications\AddProductDefect')
                                                            <a onclick="markNotificationAsRead('{{ $notification->id }}');"
                                                                class="text-success text-bold"
                                                                href="{{ route('dashboard.products.show', $notification->data['product']['id']) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-globe mr-2"></i>
                                                                <span class="float-right text-muted text-sm"> </span>
                                                                {{ $notification->data['user']['name'] }} : : <span
                                                                    class="text-dark"> أضاف عيب للمنتج
                                                                    {{ $notification->data['product']['name'] }}
                                                                    {{ $notification->data['product']['digital_code'] }}
                                                                    <span> <br>
                                                                        <small
                                                                            class="text-muted pr-4">{{ \Carbon\Carbon::Parse($notification->data['product_defect']['created_at'])->diffForHumans() }}</small>
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                        @endif
                                                    </td>
                                                @else
                                                    <td class="align-middle" style="background: #B2E0F1;">
                                                        @if ($notification->type == 'App\Notifications\AddImagesDone')
                                                            <a onclick="markNotificationAsRead('{{ $notification->id }}');"
                                                                class="text-dark text-bold"
                                                                href="{{ route('dashboard.purchases.showImages', $notification->data['images_done']['purchase_item_id']) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-globe mr-2"></i>
                                                                <span class="float-right text-muted text-sm"> </span>
                                                                {{ $notification->data['user']['name'] }} :
                                                                {{ $notification->data['user']['name'] }} : أضاف الصور
                                                                المنجزة للمنتج
                                                                {{ $notification->data['product']['name'] }}
                                                                {{ $notification->data['product']['digital_code'] }} <br>

                                                            </a>
                                                            <small
                                                                class="text-muted pr-4">{{ \Carbon\Carbon::Parse($notification->data['images_done']['created_at'])->diffForHumans() }}</small>
                                                        @endif

                                                        @if ($notification->type == 'App\Notifications\AddImagesNote')
                                                            <a onclick="markNotificationAsRead('{{ $notification->id }}');"
                                                                class="text-dark text-bold"
                                                                href="{{ route('dashboard.purchases.showNotes', $notification->data['images_note']['images_done_id']) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-globe mr-2"></i>
                                                                <span class="float-right text-muted text-sm"> </span>
                                                                {{ $notification->data['user']['name'] }} : أضاف ملاحظة
                                                                للمنتج
                                                                {{ $notification->data['product']['name'] }}
                                                                {{ $notification->data['product']['digital_code'] }} <br>

                                                            </a>
                                                            <small
                                                                class="text-muted pr-4">{{ \Carbon\Carbon::Parse($notification->data['images_note']['created_at'])->diffForHumans() }}</small>
                                                        @endif

                                                        @if ($notification->type == 'App\Notifications\AddClient')
                                                            <a onclick="markNotificationAsRead('{{ $notification->id }}');"
                                                                class="text-dark text-bold"
                                                                href="{{ route('dashboard.clients.show', $notification->data['client']['id']) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-globe mr-2"></i>
                                                                <span class="float-right text-muted text-sm"> </span>
                                                                {{ $notification->data['user']['name'] }} : : <span
                                                                    class="text-dark"> أضاف العميل
                                                                    {{ $notification->data['client']['name'] }}
                                                                    <span> <br>
                                                                        <small
                                                                            class="text-muted pr-4">{{ \Carbon\Carbon::Parse($notification->data['client']['created_at'])->diffForHumans() }}</small>
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                        @endif

                                                        @if ($notification->type == 'App\Notifications\AddProductDefect')
                                                            <a onclick="markNotificationAsRead('{{ $notification->id }}');"
                                                                class="text-dark text-bold"
                                                                href="{{ route('dashboard.products.show', $notification->data['product']['id']) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-globe mr-2"></i>
                                                                <span class="float-right text-muted text-sm"> </span>
                                                                {{ $notification->data['user']['name'] }} : : <span
                                                                    class="text-dark"> أضاف عيب للمنتج
                                                                    {{ $notification->data['product']['name'] }}
                                                                    {{ $notification->data['product']['digital_code'] }}
                                                                    <span> <br>
                                                                        <small
                                                                            class="text-muted pr-4">{{ \Carbon\Carbon::Parse($notification->data['product_defect']['created_at'])->diffForHumans() }}</small>
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                        @endif


                                                @endif
                                                </td>

                                                <td class="align-middle">
                                                    @if ($notification->read_at != null)
                                                        <span style="background-color: #B2E0F1;" class="p-1">مقروء</span>
                                                        <br> <br>
                                                        <span
                                                            style="direction: ltr !important;">{{ $notification->read_at->format('Y-m-d') }}</span>
                                                        <br>
                                                        <span class="text-gray"
                                                            style="direction: ltr !important;">{{ $notification->read_at->format('H:i A') }}</span>

                                                    @else
                                                        <span class="bg-success p-1">غير مقروء</span>
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
