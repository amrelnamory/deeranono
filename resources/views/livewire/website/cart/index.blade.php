@if (\Cart::count() > 0)

    <div class="col-sm-12 table-responsive-xs">
        <table class="table cart-table text-center">
            <thead>
                <tr class="table-head">
                    <th scope="col">@lang('site.image')</th>
                    <th scope="col">@lang('site.product_name')</th>
                    <th scope="col">@lang('site.price')</th>
                    <th scope="col">@lang('site.quantity')</th>
                    <th scope="col">@lang('site.action')</th>
                    <th scope="col">@lang('site.subtotal')</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($cart as $product)

                    @php
                        $pro = \App\Models\Product::findOrFail($product->id);
                        $image = json_decode($pro->images, true);
                    @endphp
                    <tr>
                        <td>
                            <a href="{{ route('website.singleProduct', $product->id) }}"><img
                                    src="{{ $pro->image_path . '/' . $image[0] }}" alt="{{ $product->name }}"></a>
                        </td>
                        <td><a href="{{ route('website.singleProduct', $product->id) }}">{{ $product->name }} -
                                 {{ $product->options->color }} - {{ $product->options->size }}  </a>
                            <div class="mobile-cart-content row">
                                <div class="col">
                                    <div class="qty-box">
                                        {{-- <div class="input-group">
                                            <input type="number" wire:model="quantity.{{ $product->id }}"
                                                class="form-control input-number" value="{{ $product->qty }}">
                                        </div> --}}

                                        <h2 class="td-color">{{ $product->qty }}
                                        </h2>
                                    </div>
                                </div>
                                <div class="col">
                                    <h2 class="td-color">{{ number_format($product->price, 2) }}
                                        @lang('site.currency')</h2>
                                </div>
                                <div class="col">
                                    <h2 class="td-color"><a href="#" class="icon"><i
                                                class="ti-close"></i></a>
                                    </h2>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h2>{{ number_format($product->price, 2) }} @lang('site.currency')</h2>
                        </td>
                        <td>
                            <h2 class="td-color">{{ $product->qty }}
                            </h2>
                        </td>
                        <td><a href="javascript:void(0);" wire:click.prevent="removeItem({{ $product->id }})"
                                class="icon"><i class="ti-close"></i></a></td>
                        <td>
                            <h2 class="td-color">{{ number_format($product->price * $product->qty, 2) }}
                                @lang('site.currency')</h2>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="table-responsive-md">
            <table class="table cart-table ">
                <tfoot>
                    <tr>
                        <td>@lang('site.subtotal') :</td>
                        <td>
                            <h2>{{ number_format(\Cart::subtotal(), 2) }} @lang('site.currency')</h2>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@else
    <div class="alert alert-warning">@lang('site.cart_empty')</div>

@endif
