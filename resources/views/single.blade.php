@extends('layouts.app')

@section('content')

@include('partials.page-header')

<div class="wrap container" role="document">
  <div class="content flex flex-wrap">
    <main class="main w-full lg:w-3/4 lg:pr-12">
      @while(have_posts()) @php the_post() @endphp
        @include('partials.content-single-'.get_post_type())
      @endwhile
    </main>
    @if (App\display_sidebar())
      <aside class="sidebar w-full lg:w-1/4">
        @include('partials.sidebar')
      </aside>
    @endif
  </div>
</div>
@endsection
