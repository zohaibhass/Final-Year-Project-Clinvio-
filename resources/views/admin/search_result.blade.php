@extends('admin.index')
@section('title', 'search result')
@section('content')

<div class="container mt-5 ">
    <h2 class="text-center">Search Results</h2>
    <table class="table animate__animated animate__zoomIn">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>
                        @if ($search_type == 'departments')
                            {{ $result->Name }}
                        @elseif ($search_type == 'doctors')
                            {{ $result->Name }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



{{-- @foreach ($results as $result)
    <div class="container mt-5">
        @if ($search_type == 'departments')
            <h3>Department: {{ $result->Name }}</h3>
        @elseif ($search_type == 'doctors')
            <h3>Doctor: {{ $result->Name }}</h3>
        @endif
    </div>
@endforeach --}}

@endsection
