@if ($paginator->hasPages())
    <div class="row">
        <div class="col-xl-6 col-md-6 col-sm-12">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    @if ($paginator->onFirstPage())

                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <a class="page-link" href="javascript:void(0);">
                                @if (app()->getLocale() == 'ar')
                                    <span aria-hidden="true"><i class="fa fa-chevron-right"
                                            aria-hidden="true"></i></span>
                                @else
                                    <span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                                @endif
                                <span class="sr-only">@lang('pagination.previous')</span>
                            </a>
                        </li>

                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                                aria-label="@lang('pagination.previous')">
                                @if (app()->getLocale() == 'ar')
                                    <span aria-hidden="true"><i class="fa fa-chevron-right"
                                            aria-hidden="true"></i></span>
                                @else
                                    <span aria-hidden="true"><i class="fa fa-chevron-left"
                                            aria-hidden="true"></i></span>
                                @endif

                                <span class="sr-only">@lang('pagination.previous')</span>
                            </a>
                        </li>
                    @endif

                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active"><a class="page-link"
                                            href="javascript:void(0);">{{ $page }}</a></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $url }}">{{ $page }}</a></li>
                                @endif

                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">
                                @if (app()->getLocale() == 'ar')
                                    <span aria-hidden="true"><i class="fa fa-chevron-left"
                                            aria-hidden="true"></i></span>
                                @else
                                    <span aria-hidden="true"><i class="fa fa-chevron-right"
                                            aria-hidden="true"></i></span>
                                @endif

                                <span class="sr-only">@lang('pagination.next')</span>
                            </a>
                        </li>

                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <a class="page-link" href="javascript:void(0);">
                                @if (app()->getLocale() == 'ar')
                                    <span aria-hidden="true"><i class="fa fa-chevron-left"
                                            aria-hidden="true"></i></span>
                                @else
                                    <span aria-hidden="true"><i class="fa fa-chevron-right"
                                            aria-hidden="true"></i></span>
                                @endif
                                <span class="sr-only">@lang('pagination.next')</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </nav>
        </div>
        <div class="col-xl-6 col-md-6 col-sm-12">
            <div class="product-search-count-bottom">
                <h5>
                    @lang('site.showing') {{ ($paginator->currentpage() - 1) * $paginator->perpage() + 1 }} -
                    {{ $paginator->currentpage() * $paginator->perpage() }}
                    @lang('site.of') {{ $paginator->total() }} @lang('site.results')
                </h5>
            </div>
        </div>
    </div>
@endif
