

    <div class="row check-out">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <div class="field-label">@lang('site.name')</div>
            <input type="text" wire:model="name" placeholder="@lang('site.name')">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <div class="field-label">@lang('site.phone')</div>
            <input type="text" wire:model="phone" placeholder="@lang('site.phone')">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <div class="field-label">@lang('site.address')</div>
            <input type="text" wire:model="address" placeholder="@lang('site.address')">
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <div class="field-label">@lang('site.email')</div>
            <input type="text" wire:model="email" placeholder="@lang('site.email')">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-start">
            <button wire:loading.remove wire:click.prevent="store" type="submit"
                class="btn-solid btn">@lang('site.send')</button>

            <button wire:loading wire:target="store" type="submit" class="btn-solid btn"><i
                    class="fa fa-spinner fa-spin text-2xl"></i></button>

        </div>
    </div>

