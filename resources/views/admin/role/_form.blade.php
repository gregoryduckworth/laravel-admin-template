<section class="content">
    <div class="d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <div class="card-tools">
                        <a
                            href="{{ route('admin.role.index') }}"
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
                            value="{{ $role->id ?? old('id') }}"
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
                                        value="{{ $role->name ?? old('name') }}"
                                    />
                                    @error('name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                    <div class="invalid-feedback">
                                        {{ __('role.required') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="permissions" class="form-label">
                                        {{ __('permission.permissions') }}
                                    </label>
                                    <div>
                                        @foreach ($permissions as $permission)
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="permissions[]"
                                                    value="{{ encrypt($permission->id) }}"
                                                    {{ isset($role) && $role->permissions->contains('id', $permission->id) ? 'checked' : (in_array($permission->id, old('permissions', [])) ? 'checked' : '') }}
                                                />
                                                <label class="form-check-label">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('permissions')
                                        <span>{{ $message }}</span>
                                    @enderror
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
