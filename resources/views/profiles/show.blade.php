@extends('layouts.app') @section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="page-header">
        <h1> {{$profileUser->name}}
        </h1>
      </div>
      @foreach($activities as $date => $activity)
      <h3 class="page-header">
        {{$date}}
      </h3>
      @foreach($activity as $activ) @if(view()->exists("profiles.activities.{$activ->type}")) @include("profiles.activities.{$activ->type}")
      @endif @endforeach @endforeach {{-- {{$activity->links()}} --}}
    </div>
  </div>

</div>
@endsection