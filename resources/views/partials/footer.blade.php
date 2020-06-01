<footer class="content-info bg-grey-darkest pt-5 lg:pt-20 text-white">
  <div class="container lg:pb-24">
    <div class='flex flex-wrap justify-between'>
      <div class='w-full lg:w-1/2'>
        @php dynamic_sidebar('footer_left') @endphp
      </div>
      <div class='w-full lg:w-1/4'>
        @php dynamic_sidebar('footer_middle') @endphp
      </div>
      <div class='w-full lg:w-1/4'>
        @php dynamic_sidebar('footer_right') @endphp
      </div>
    </div>
  </div>
  <div class='container'>
    <div class='flex flex-row justify-between pb-3'>
      <span class='copyright'>© {!! date('Y') !!} SJI Associates</span>
      <span class='wbenc'>Women Owned Enterprise</span>
  </div>
</footer>
