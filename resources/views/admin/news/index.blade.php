@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Yangiliklar</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yangi yangilik
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Rasm</th>
                        <th>Sarlavha</th>
                        <th>Holati</th>
                        <th>Sana</th>
                        <th>Amallar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <img src="{{ $item->image_url }}" width="50" height="50" class="img-thumbnail">
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>
                            <span class="badge bg-{{ $item->is_published ? 'success' : 'warning' }}">
                                {{ $item->is_published ? 'Aktiv' : 'Noaktiv' }}
                            </span>
                        </td>
                        <td>{{ $item->published_date->format('d.m.Y') }}</td>
                        <td>
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('O\'chirilsinmi?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection