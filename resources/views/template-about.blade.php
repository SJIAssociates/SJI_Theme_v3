{{--
  Template Name: About Template
--}}

@extends('layouts.app')

@section('content')
<div class="wrap container" role="document">
  <div class="content">
    <main class="main">
    @while(have_posts()) @php the_post() @endphp
      @include('partials.content-page')
    @endwhile
    </main>
    @if (App\display_sidebar())
      <aside class="sidebar">
        @include('partials.sidebar')
      </aside>
    @endif
  </div>
</div>
@endsection
