<table class="table table-hover table-bordered mb-0 align-middle">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Logo</th>
        <th>Owner</th>
        <th>Control</th>
        <th>Created At</th>
    </tr>
    </thead>
    <tbody>
    @forelse($brands as $brand)
        <tr>
            <td>{{ $brand->id }}</td>
            <td>{{ ucfirst($brand->title) }}</td>
            <td>
                <img src="{{ asset("storage/logo/".$brand->logo) }}" width="50" class="rounded-circle" alt="">
            </td>
            <td>{{ $brand->user->name }}</td>
            <td>
                <a href="{{ route('home.brand.edit',$brand->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </td>
            <td>
                <p class="small mb-0">
                    <i class="fas fa-clock"></i>
                    {{ $brand->created_at->format("h : i a") }}
                </p>
                <p class="small mb-0">
                    <i class="fas fa-calendar"></i>
                    {{ $brand->created_at->format("d m Y") }}
                </p>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5">There is no Brand Yet</td>
        </tr>
    @endforelse
    </tbody>
</table>
