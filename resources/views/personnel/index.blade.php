@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-center">
        <div class="w-100 mb-4 px-5">
            <form method="GET" action="{{ url('personnel/' . $rub . '/' . $srub) }}" class="row g-3 align-items-end" id="filterForm">
                <input type="hidden" name="rub" value="{{ $rub }}">
                <input type="hidden" name="srub" value="{{ $srub }}">
                <div class="col-md-6">
                    <label for="genre_personnel" class="form-label">Genre de personnel</label>
                    <select id="genre_personnel" name="genre_personnel" class="form-select" onchange="document.getElementById('filterForm').submit()">
                        <option value="">-- Genre de personnel --</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ request('genre_personnel') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->libellepers }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="type_personnel" class="form-label">Type de personnel</label>
                    <select id="type_personnel" name="type_personnel" class="form-select" onchange="document.getElementById('filterForm').submit()">
                        <option value="">-- Type de personnel --</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ request('type_personnel') == $type->id ? 'selected' : '' }}>
                                {{ $type->libellepers }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="main-card card">
        <div class="card-header py-0">
            {!! $controler->newFormButton($rub ?? '', $srub ?? '', 'personnel.create') !!}
            <h4 class="card-title">
                {{ __('Liste du personnel') }}
            </h4>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover dataTable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Genre</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        {!! $controler->crudheader($rub ?? '', $srub ?? '') !!}
                    </tr>
                </thead>
                <tbody>
                    @foreach($personnels as $item)
                        <tr>
                            <td>{{ $item->nom }}</td>
                            <td>{{ $item->prenom }}</td>
                            <td>{{ $item->genre_libelle }}</td>
                            <td>{{ $item->type_libelle }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->telephone }}</td>
                            {!! $controler->crudbody($rub ?? '', $srub ?? '', 'route', 'personnel.edit', 'personnel.destroy', $item->id) !!}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
