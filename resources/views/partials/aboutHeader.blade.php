
@if( !empty($block->background_color))
  <section class='{{ $block->section_classes }}'
            style="background-color: {{  $block->background_color  }}"
            id='section-{{$block->index}}'>
@elseif( !empty($block->all_fields['background_image']))
  <section class='{{ $block->section_classes }}'
           style="background-image: url({{  $block->all_fields['background_image']['url'] }}); background-size: {{  $block->all_fields['background_image_size']}}; background-position: center center;"
           id='section-{{$block->index}}'>
@else
  <section class='{{ $block->section_classes }}'
           id='section-{{$block->index}}'>
@endif
  <div class='container'>
    <div class='entry-content lg:w-4/5 mx-auto'>
      @if( !empty($block->header) )
        <h2>{{ $block->header }}</h2>
      @endif
    </div>
  </div>
</section>
