<footer class="content-info bg-primary pt-5 lg:pt-20 text-white">
  <div class="container lg:pb-24">
    <div class='flex flex-wrap justify-between'>
      <div class='w-full lg:w-1/2'>
        @php dynamic_sidebar('footer_left') @endphp
        <p class='text-grey-500 social-links'>Follow Us:
  				@if(!empty($social->twitter))<a href="{{ $social->twitter }}" 		target="_blank" title="twitter"     class="hover:no-underline" rel='noopener'><i class="fab fa-twitter"></i></a>@endif
  				@if(!empty($social->facebook))<a href="{{ $social->facebook }}" 	target="_blank" title="facebook"    class="hover:no-underline" rel='noopener'><i class="fab fa-facebook-f"></i></a>@endif
  				@if(!empty($social->youtube))<a href="{{ $social->youtube }}" 		target="_blank" title="youtube"     class="hover:no-underline" rel='noopener'><i class="fab fa-youtube"></i></a>@endif
  				@if(!empty($social->instagram))<a href="{{ $social->instagram }}" target="_blank" title="instagram"   class="hover:no-underline" rel='noopener'><i class="fab fa-instagram"></i></a>@endif
  			</p>
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
