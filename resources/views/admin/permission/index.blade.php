@extends('layouts.admin')

@section('title', __('permission.permission'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('permission.permission') }}</h3>
            <div class="card-tools">
                <a
                    href="{{ route('admin.permission.create') }}"
                    class="btn btn-sm btn-primary"
                >
                    {{ __('common.create') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table-striped table" id="collectionTable">
                <thead>
                    <tr>
                        <th>{{ __('common.name') }}</th>
                        <th>{{ __('common.created') }}</th>
                        <th>{{ __('common.action') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->created_at }}</td>
                            <td>
                                <a
                                    href="{{ route('admin.permission.edit', encrypt($permission->id)) }}"
                                    class="btn btn-sm btn-primary mr-4"
                                >
                                    {{ __('common.edit') }}
                                </a>
                            </td>
                            <td>
                                <form
                                    action="{{ route('admin.permission.destroy', encrypt($permission->id)) }}"
                                    method="POST"
                                    onsubmit="return confirm('{{ addslashes(__('common.confirm_delete')) }}')"
                                >
                                    @method('DELETE')
                                    @csrf
                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                    >
                                        {{ __('common.delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="bg-danger text-center">
                                {{ __('permission.not_created') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('#collectionTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
            });
        });
    </script>
@endsection
