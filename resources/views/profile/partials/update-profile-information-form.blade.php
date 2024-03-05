<div class="card card-primary">
    <div class="card-header">
        <h2 class="text-lg">
            {{ __('profile.information') }}
        </h2>
        <p class="mt-1 text-sm">
            {{ __('profile.update_text') }}
        </p>
    </div>

    <div class="card-body">
        <form
            method="post"
            action="{{ route('admin.profile.update') }}"
            class="mt-6 space-y-6"
        >
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="first_name" class="form-label">
                    {{ __('user.first_name') }}
                </label>
                <input
                    id="first_name"
                    name="first_name"
                    type="text"
                    class="form-control"
                    value="{{ old('first_name', $user->first_name) }}"
                    required
                    autofocus
                    autocomplete="first_name"
                    @if(!Auth::user()->hasRole('admin')) readonly disabled @endif
                />
                @error('first_name')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">
                    {{ __('user.last_name') }}
                </label>
                <input
                    id="last_name"
                    name="last_name"
                    type="text"
                    class="form-control"
                    value="{{ old('last_name', $user->last_name) }}"
                    required
                    autofocus
                    autocomplete="last_name"
                    @if(!Auth::user()->hasRole('admin')) readonly disabled @endif
                />
                @error('last_name')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">
                    {{ __('user.email') }}
                </label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="form-control"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                    @if(!Auth::user()->hasRole('admin')) readonly disabled @endif
                />
                @error('email')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="Mode" class="form-label">
                    {{ __('user.mode') }}
                </label>
                <select name="mode" id="Mode" class="form-control">
                    <option
                        {{ $user->mode == 'dark' ? 'selected' : '' }}
                        value="dark"
                    >
                        {{ __('user.mode_dark') }}
                    </option>
                    <option
                        {{ $user->mode == 'light' ? 'selected' : '' }}
                        value="light"
                    >
                        {{ __('user.mode_light') }}
                    </option>
                </select>
                @error('mode')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <button
                    class="btn btn-primary btn-sm float-right"
                    type="submit"
                >
                    {{ __('common.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
