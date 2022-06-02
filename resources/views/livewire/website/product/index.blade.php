 <form wire:submit.prevent="addToCart({{ $product->id }})">
     <div class="addeffect-section product-description border-product">

         <h6 class="product-title size-text">@lang('site.select_color')</h6>

         <div class="color">
             <ul>
                 @foreach (json_decode($product->color, true) as $key => $color)
                     <li>

                         <input type="radio" wire:model="color" id="color{{ $key }}"
                             value="{{ $color['value'] }}">
                         <label for="color{{ $key }}">{{ $color['value'] }}</label>

                     </li>
                 @endforeach
             </ul>
             @error('color')
                 <div class="text-danger">{{ $message }}</div>
             @enderror
         </div>

         @if ($product->size != null)
             <h6 class="product-title size-text">@lang('site.select_size')</h6>

             <div class="size-box">
                 <ul>

                     <input type="hidden" wire:model="size_field">


                     @foreach (json_decode($product->size, true) as $key => $size)
                         <input type="radio" wire:model="size" id="size{{ $key }}"
                             value="{{ $size['value'] }}">
                         <label for="size{{ $key }}">{{ $size['value'] }}</label>
                     @endforeach
                 </ul>
                 @error('size')
                     <div class="text-danger">{{ $message }}</div>
                 @enderror
             </div>
         @endif

         <h6 class="product-title">@lang('site.quantity')</h6>
         <div class="qty-box">
             <div class="form-group">

                 <select wire:model="quantity" class="form-control">
                     <option value="">@lang('site.choose')</option>
                     @for ($i = 1; $i <= $product->quantity; $i++)
                         <option value="{{ $i }}">{{ $i }}</option>
                     @endfor
                 </select>
             </div>
         </div>
         @error('quantity')
             <div class="text-danger">{{ $message }}</div>
         @enderror
     </div>
     <div class="product-buttons">
         <button id="cartEffect" class="btn btn-solid hover-solid btn-animation" type="submit">
             <i class="fa fa-shopping-cart me-1" aria-hidden="true"></i>
             @lang('site.add_to_cart')
         </button>
     </div>
 </form>
