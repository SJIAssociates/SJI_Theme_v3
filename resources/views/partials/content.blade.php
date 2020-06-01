<article @php post_class('flex flex-wrap flex-row mb-5 border-b border-1 pb-5 lg:pb-10 lg:px-10 lg:mb-10') @endphp>
  <div class='w-full lg:w-1/2 lg:pr-5'>
    {!! the_post_thumbnail()!!}
  </div>
  <div class='w-full lg:w-1/2'>
    <h2 class="entry-title text-4xl mb-0 font-bold leading-tight">
      <a href="{{ get_permalink() }}" class='text-grey-darkest'>{!! get_the_title() !!}</a>
    </h2>
    @include('partials/entry-meta')
    <div class='entry-summary leading-relaxed'>
      @php the_excerpt() @endphp
    </div>
  </div>
</article>
