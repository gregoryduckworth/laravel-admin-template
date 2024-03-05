@extends('layouts.admin')

@section('title', __('user.users'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('user.users') }}</h3>
            <div class="card-tools">
                <a
                    href="{{ route('admin.user.create') }}"
                    class="btn btn-sm btn-primary"
                >
                    {{ __('common.create') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table-striped table" id="userTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('user.first_name') }}</th>
                        <th>{{ __('user.last_name') }}</th>
                        <th>{{ __('user.email') }}</th>
                        <th>{{ __('common.created') }}</th>
                        <th>{{ __('common.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <a
                                        href="{{ route('admin.user.edit', encrypt($user->id)) }}"
                                        class="btn btn-sm btn-primary mr-4"
                                    >
                                        {{ __('common.edit') }}
                                    </a>
                                    <form
                                        action="{{ route('admin.user.destroy', encrypt($user->id)) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete?')"
                                    >
                                        @method('DELETE')
                                        @csrf
                                        @if ($user->id != Auth::user()->id)
                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                            >
                                                {{ __('common.delete') }}
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('#userTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
            });
        });
    </script>
@endsection
