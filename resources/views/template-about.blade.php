{{--
  Template Name: About Template
--}}

@extends('layouts.app')

@section('content')

@include('partials.page-header')
<section class='min-h-screen'>
@if ($flex_generator)

  @foreach ($flex_generator as $block)

    @if ($block->block_type == 'One Column')
      @include('partials.layout.aboutOneColumn')
    @endif

    @if ($block->block_type == 'Two Columns')
      @include('partials.layout.aboutTwoColumn')
    @endif

    @if ($block->block_type == 'Three Columns')
      @include('partials.layout.aboutThreeColumn')
    @endif

    @if ($block->block_type == 'Header')
      @include('partials.layout.aboutHeader')
    @endif
  @endforeach
@endif
</section>
@endsection
