<section class="content">
    <div class="d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $title }}
                    </h3>
                    <div class="card-tools">
                        <a
                            href="{{ route('admin.permission.index') }}"
                            class="btn btn-sm btn-dark"
                        >
                            {{ __('common.back') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ $formAction }}" method="POST">
                        @csrf
                        @isset($method)
                            @method($method)
                        @endisset

                        <input
                            type="hidden"
                            name="id"
                            value="{{ $permission->id ?? old('id') }}"
                        />

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        {{ __('common.name') }}
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        id="name"
                                        required=""
                                        value="{{ $permission->name ?? old('name') }}"
                                    />
                                    @error('name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                    <div class="invalid-feedback">
                                        {{ __('permission.required') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="float-right">
                                <button class="btn btn-primary" type="submit">
                                    {{ __('common.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
