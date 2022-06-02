<div class="form-row row">
    <div class="col-md-6">
        <label>@lang('site.name')</label>
        <input type="text" class="form-control" placeholder="@lang('site.name')" wire:model="name">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label>@lang('site.phone')</label>
        <input type="text" class="form-control" wire:model="phone" placeholder="@lang('site.phone')">
        @error('phone')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label>@lang('site.email')</label>
        <input type="text" class="form-control" wire:model="email" placeholder="@lang('site.email')">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label>@lang('site.subject')</label>
        <input type="text" class="form-control" wire:model="subject" placeholder="@lang('site.subject')">
        @error('subject')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">         
        <label>@lang('site.human')</label>
        <input type="text" class="form-control" wire:model="human" placeholder="{{$captchaQuestion}}">
        @error('human')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <label for="review">@lang('site.message')</label>
        <textarea class="form-control" placeholder="@lang('site.message')" wire:model="message" rows="6"></textarea>
        @error('message')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <button wire:click.prevent="store" type="submit" class="btn-solid btn">@lang('site.send')</button>
    </div>
</div>
