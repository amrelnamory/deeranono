   <div>
       <div class="form-group">
           <label>@Lang('site.contract_date')</label>
           <input type="date" class="form-control" value="{{ $contract_date }}" wire:model="contract_date">
           @error('contract_date')
               <div class="text-danger text-bold">{{ $message }}</div>
           @enderror
       </div>

       <div class="card card-success">
           <div class="card-header">
               <h3 class="card-title">@lang('site.lessor_data')</h3>
           </div>
           <div class="card-body">
               <div class="row">
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.lessor_name')</label>
                           <input type="text" class="form-control" value="{{ $lessor_name }}"
                               wire:model="lessor_name">
                           @error('lessor_name')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.nat_id')</label>
                           <input type="text" class="form-control" value="{{ $lessor_nat_id }}"
                               wire:model="lessor_nat_id">
                           @error('lessor_nat_id')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.company')</label>
                           <input type="text" class="form-control" value="{{ $lessor_company }}"
                               wire:model="lessor_company">
                           @error('lessor_company')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.commercial_registration_no')</label>
                           <input type="text" class="form-control" value="{{ $lessor_commercial_no }}"
                               wire:model="lessor_commercial_no">
                           @error('lessor_commercial_no')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.unified_no')</label>
                           <input type="text" class="form-control" value="{{ $lessor_unified_no }}"
                               wire:model="lessor_unified_no">
                           @error('lessor_unified_no')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.place')</label>
                           <input type="text" class="form-control" value="{{ $lessor_place }}"
                               wire:model="lessor_place">
                           @error('lessor_place')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.release_date')</label>
                           <input type="date" class="form-control" value="{{ $lessor_release_date }}"
                               wire:model="lessor_release_date">
                           @error('lessor_release_date')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
               </div>
           </div>
           <!-- /.card-body -->
       </div>

       <div class="card card-info">
           <div class="card-header">
               <h3 class="card-title">@lang('site.tenant_data')</h3>
           </div>
           <div class="card-body">
               <div class="row">
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.tenant_name')</label>
                           <select wire:model="client_id" class="form-control custom-select">
                               <option value="">@Lang('site.choose')</option>
                               @foreach ($clients as $client)
                                   <option value="{{ $client->id }}"
                                       {{ $contract->client_id == $client->id ? 'selected' : '' }}>
                                       {{ $client->name }}
                                   </option>
                               @endforeach
                           </select>
                           @error('client_id')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror

                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.company')</label>
                           <input type="text" class="form-control" value="{{ $tenant_company }}"
                               wire:model="tenant_company">
                           @error('tenant_company')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.commercial_registration_no')</label>
                           <input type="text" class="form-control" value="{{ $tenant_commercial_no }}"
                               wire:model="tenant_commercial_no">
                           @error('tenant_commercial_no')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.unified_no')</label>
                           <input type="text" class="form-control" value="{{ $tenant_unified_no }}"
                               wire:model="tenant_unified_no">
                           @error('tenant_unified_no')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.place')</label>
                           <input type="text" class="form-control" value="{{ $tenant_place }}"
                               wire:model="tenant_place">
                           @error('tenant_place')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.release_date')</label>
                           <input type="date" class="form-control" value="{{ $tenant_release_date }}"
                               wire:model="tenant_release_date">
                           @error('tenant_release_date')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
               </div>
           </div>
           <!-- /.card-body -->
       </div>

       <div class="card card-warning">
           <div class="card-header">
               <h3 class="card-title">@lang('site.car_data')</h3>
           </div>
           <div class="card-body">
               @if (session()->has('error'))
                   <div class="alert alert-danger">
                       {{ session('error') }}
                   </div>
               @endif
               <div class="row">
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.car_name')</label>
                           <select wire:model="car_id" class="form-control custom-select">
                               <option value="">@Lang('site.choose')</option>
                               @foreach ($cars as $car)
                                   <option value="{{ $car->id }}"
                                       {{ $contract->car_id == $car->id ? 'selected' : '' }}>
                                       {{ $car->name }}
                                       -
                                       {{ $car->model }} - {{ $car->plate_no }}
                                   </option>
                               @endforeach

                           </select>
                           @error('car_id')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>

                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.counter_no')</label>
                           <input type="text" class="form-control" value="{{ $counter_no }}"
                               wire:model="counter_no">
                           @error('counter_no')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@lang('site.rent_amount')</label>
                           <input type="text" class="form-control" value="{{ $rent_amount }}"
                               wire:model="rent_amount">
                           @error('rent_amount')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">

                       <div class="form-group">
                           <label>@Lang('site.total_amount')</label>
                           <input type="text" class="form-control" value="{{ $total_amount }}"
                               wire:model="total_amount">
                           @error('total_amount')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.rent_start_date')</label>
                           <input type="date" class="form-control" value="{{ $rent_start_date }}"
                               wire:model="rent_start_date">
                           @error('rent_start_date')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.rent_end_date')</label>

                           <input type="date" class="form-control" wire:model="rent_end_date"
                               value="{{ $rent_end_date }}">

                           @error('rent_end_date')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>

                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label for="customFile">@Lang('site.contract_type')</label>
                           <select wire:model="contract_type" class="form-control custom-select">
                               <option value="">@Lang('site.choose')</option>

                               <option value="full_insurance"
                                   {{ $contract->contract_type == 'full_insurance' ? 'selected' : '' }}>
                                   @lang('site.full_insurance')
                               </option>
                               <option value="third_party_insurance"
                                   {{ $contract->contract_type == 'third_party_insurance' ? 'selected' : '' }}>
                                   @lang('site.third_party_insurance')
                               </option>


                           </select>
                           @error('contract_type')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>

               </div>
           </div>
           <!-- /.card-body -->
       </div>

       <div class="card card-navy">
           <div class="card-header">
               <h3 class="card-title">@lang('site.driver_data')</h3>
           </div>
           <div class="card-body">
               <div class="row">

                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.driver_name')</label>
                           <input type="text" class="form-control" value="{{ $driver_name }}"
                               wire:model="driver_name">
                           @error('driver_name')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.driver_nationality')</label>
                           <input type="text" class="form-control" value="{{ $driver_nationality }}"
                               wire:model="driver_nationality">
                           @error('driver_nationality')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="form-group">
                           <label>@Lang('site.driver_residence_no')</label>
                           <input type="text" class="form-control" value="{{ $driver_residence_no }}"
                               wire:model="driver_residence_no">
                           @error('driver_residence_no')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>

               </div>
           </div>
           <!-- /.card-body -->
       </div>

       <div class="card card-default">
           <div class="card-header">
               <h3 class="card-title">@lang('site.contract_terms')</h3>

               @if ($isDisabled == false)
                   <button wire:click="enable" class="btn btn-sm m-auto btn-info float-right">
                       <i class="fa fa-edit"></i> @Lang('site.edit')
                   </button>
               @else
                   <button wire:click="disable" class="btn btn-sm m-auto btn-danger float-right">
                       <i class="fa fa-times"></i> @Lang('site.close')
                   </button>
               @endif
           </div>
           <div class="card-body">
               <div class="row">

                   <div class="col-md-12"
                       style="{{ $isDisabled == true ? 'display:block' : 'display:none' }} ">
                       <div class="form-group" wire:ignore>
                           <label>@Lang('site.contract_terms')</label>
                           <textarea wire:model="contract_terms" class="form-control ckeditor" id="contract_terms"
                               data-contract_terms="@this">{!! $contract_terms !!}</textarea>
                           @error('contract_terms')
                               <div class="text-danger text-bold">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>

               </div>
           </div>
           <!-- /.card-body -->
       </div>

       <div class="form-group text-center">
           <button wire:loading.remove wire:click.prevent="update" id="submit"
               class="btn btn-lg m-auto text-center btn-primary">
               <i class="fa fa-plus"></i>@Lang('site.save')
           </button>

           <button wire:loading wire:target="update" class="btn btn-lg m-auto text-center btn-primary">
               <i class="fas fa-spinner fa-spin text-2xl"></i>
           </button>
       </div>


   </div>
