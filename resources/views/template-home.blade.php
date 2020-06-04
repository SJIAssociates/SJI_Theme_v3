{{--
  Template Name: Home Template
--}}

@extends('layouts.app')

@section('content')
<div class="flex bg-white min-h-screen">
    <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
        <div>
            <h2 class="text-3xl font-semibold md:text-6xl animate__animated animate__bounce">Building Brands</h2>
            <p class="mt-2 text-sm text-gray-500 md:text-lg">With over 25 years of expertise in branding, communications, style guides, advertising and more, our creative teams are able to execute compelling creative across all categories and industries.</p>
            <div class="flex justify-center lg:justify-start mt-6">
                <a class="px-4 py-3 bg-gray-900 text-gray-200 text-xs font-semibold rounded hover:bg-gray-800" href="#">Get Started</a>
                <a class="mx-4 px-4 py-3 bg-gray-300 text-gray-900 text-xs font-semibold rounded hover:bg-gray-400" href="#">Learn More</a>
            </div>
        </div>
    </div>
    <div class="hidden lg:block lg:w-1/2" style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
        <div class="h-full object-cover" style="background-image: url(https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80)">
            <div class="h-full bg-black opacity-25"></div>
        </div>
    </div>
</div>
@endsection
