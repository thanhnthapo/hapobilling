<table class="table table-bordered tablesorter table-hover text-center">
    <thead>
    <tr>
        <th>Name <i class="fa fa-sort"></i></th>
        <th>Avatar</th>
        <th>Birthday <i class="fa fa-sort"></i></th>
        <th>Email</th>
        <th>Department</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td><strong>{{ $user->name }}</strong></td>
            <td><img class="img-thumbnail img-user"
                     src="{{ asset('storage/'.$user->avatar) }}" alt=""></td>
            <td>{{ $user->dob }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @foreach($departments as $department_name)
                    @if($department_name->id == $user->department_id)
                        {{ $department_name->name }}
                    @endif
                @endforeach
            </td>
            <td>{{ $user->status }}</td>
            <td class="action">
                <button type="submit" class="btn btn-info"><a
                        href="{{ route('user.show',['id'=>$user->id]) }}"><i class="fa fa-eye"></i></a>
                </button>
                <button type="submit" class="btn btn-warning"><a
                        href="{{ route('user.edit',['id'=>$user->id]) }}"><i class="fa fa-edit"></i></a>
                </button>
                <form method="POST" action="{{ route('user.destroy', [$user->id]) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" type="submit" title="Delete"
                            onclick="return confirm('Bạn có chắc chắng muốn xóa {{ $user->name }} ?')">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </thead>
</table>

{{ $users->render() }}
