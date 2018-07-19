@extends('layouts.app')

@section('content')
    <div class="well">
        <h1>National Pokedex</h1>
        <table align='center' cellspacing='3'>
            <tr>
                <th>ID</th>
                <th>Icon</th>
                <th>Name</th>
            </tr>
            @if(count($monsters) > 1)
                @foreach($monsters as $monster)
                    <tr class='clickable-row' data-href='/monsters/{{$monster->id}}'>
                        <td>{{$monster->id}}</td>
                        <td><img src='/storage/images/icons/{{$monster->id}}.png' alt='{{$monster->name}}' title='{{$monster->name}}'></td>
                        <td><a href='/monsters/{{$monster->id}}'>{{$monster->name}}</a></td>
                    </tr>              
                @endforeach
            @else
                <p>No Pokemon Found</p>
            @endif
        </table>
    </div>
    
@endsection
