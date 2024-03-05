@extends('layouts.admin')

@section('title', __('role.roles'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Roles</h3>
            <div class="card-tools">
                <a
                    href="{{ route('admin.role.create') }}"
                    class="btn btn-sm btn-primary"
                >
                    {{ __('common.create') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table-striped table" id="roleTable">
                <thead>
                    <tr>
                        <th>{{ __('common.name') }}</th>
                        <th>{{ __('common.created') }}</th>
                        <th>{{ __('common.action') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>
                                <a
                                    href="{{ route('admin.role.edit', encrypt($role->id)) }}"
                                    class="btn btn-sm btn-primary mr-4"
                                >
                                    {{ __('common.edit') }}
                                </a>
                            </td>
                            <td>
                                <form
                                    action="{{ route('admin.role.destroy', encrypt($role->id)) }}"
                                    method="POST"
                                    onsubmit="return confirm('{{ addslashes(__('common.confirm_delete')) }}')"
                                >
                                    @method('DELETE')
                                    @csrf
                                    @if ($role->name != 'admin')
                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                        >
                                            {{ __('common.delete') }}
                                        </button>
                                    @endif
                                </form>
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
            $('#roleTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
            });
        });
    </script>
@endsection
