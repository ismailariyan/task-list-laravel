@extends('layouts.app')
@section('title','The list of task')
@section('content')

<div>
    @forelse($tasks as $task)
    <div>
        <a href="{{ route('tasks.show',['id' => $task->id ]) }}">
            <h1>{{$task->title}}</h1>
        </a>
    </div>
    @empty
    <div>
        <h1>Nothing</h1>
    </div>
    @endforelse
</div>
@endsection