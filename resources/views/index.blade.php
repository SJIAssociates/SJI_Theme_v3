@extends('layouts.app')


@section('content')
@include('partials.page-header')
<section>
  <div class="container">
    <div class="content flex flex-wrap">
      <main class="main">
        @if (!have_posts())
          <div class="alert alert-warning">
            {{ __('Sorry, no results were found.', 'sage') }}
          </div>
          {!! get_search_form(false) !!}
        @endif

        @while (have_posts()) @php the_post() @endphp
          @include('partials.content-'.get_post_type())
        @endwhile

        {!! get_the_posts_navigation(array(
            'prev_text'                  => __( 'Prev' ),
            'next_text'                  => __( 'Next' ),
            'screen_reader_text' => __( 'Continue Reading' ),
        )) !!}
      </main>
    </div>
  </div>
</section>
@endsection
