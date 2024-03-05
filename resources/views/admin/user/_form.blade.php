<section class="content">
    <div class="d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <div class="card-tools">
                        <a
                            href="{{ route('admin.user.index') }}"
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
                            value="{{ $user->id ?? old('id') }}"
                        />

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">
                                        {{ __('user.first_name') }}:*
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="first_name"
                                        required
                                        value="{{ $user->first_name ?? old('first_name') }}"
                                    />
                                    @error('first_name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="last_name" class="form-label">
                                        {{ __('user.last_name') }}:*
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="last_name"
                                        required
                                        value="{{ $user->last_name ?? old('last_name') }}"
                                    />
                                    @error('last_name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        {{ __('user.email') }}:*
                                    </label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        required
                                        value="{{ $user->email ?? old('email') }}"
                                    />
                                    @error('email')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        {{ __('user.password') }}:*
                                    </label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        required
                                    />
                                    @error('password')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="role" class="form-label">
                                        {{ __('role.role') }}:*
                                    </label>
                                    <select
                                        name="role"
                                        id="role"
                                        class="form-control"
                                    >
                                        <option value="" selected disabled>
                                            {{ __('role.select') }}
                                        </option>
                                        @foreach ($roles as $role)
                                            <option
                                                value="{{ $role->name }}"
                                                {{ isset($user->roles) && $user->roles->isNotEmpty() && $user->roles[0]['name'] === $role->name ? 'selected' : '' }}
                                            >
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="float-right">
                                    <button
                                        class="btn btn-primary"
                                        type="submit"
                                    >
                                        {{ __('common.save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
