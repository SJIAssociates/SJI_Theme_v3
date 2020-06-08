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
      <h2>{{ $block->header }}</h2>
      <div class='flex flex-wrap'>
        <div class='w-full lg:w-2/5'>
          {!! $block->content !!}
        </div>
        <div class='w-full lg:w-3/5 pl-24'>
          {!! $block->right_column !!}
        </div>
      </div>
    </div>
  </div>
</section>
