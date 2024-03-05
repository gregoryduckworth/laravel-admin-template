<div class="card card-primary">
    <div class="card-header">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('profile.update_password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('profile.update_password_text') }}
        </p>
    </div>

    <div class="card-body">
        <form
            method="post"
            action="{{ route('password.update') }}"
            class="mt-6 space-y-6"
        >
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="current_password" class="form-label">
                    {{ __('profile.current_password') }}
                </label>
                <input
                    id="current_password"
                    name="current_password"
                    type="password"
                    class="form-control"
                    autocomplete="current-password"
                />
                @error('current_password', 'updatePassword')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">
                    {{ __('profile.new_password') }}
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control"
                    autocomplete="new-password"
                />
                @error('password', 'updatePassword')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">
                    {{ __('profile.confirm_password') }}
                </label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="form-control"
                    autocomplete="new-password"
                />
                @error('password_confirmation', 'updatePassword')
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
