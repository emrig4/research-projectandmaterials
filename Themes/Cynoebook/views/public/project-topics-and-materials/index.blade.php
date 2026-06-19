@extends('public.layout')
@push('meta')
    <meta name="description" content="{{ setting('meta_description_homepage') }}"/>
    <meta name="keywords" content="{{ setting('meta_keywords_homepage') }}">

@endpush
@section('title', setting('site_name'))

@push('styles')
 <style type="text/css">
     .owl-carousel .owl-item img {
        display: block;
        -webkit-transform-style: preserve-3d;
    }
 </style>
 <script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "BlogPosting",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://projectandmaterials.com/"
  },
  "headline": "projecttopics and materials download for final year students in nigeria",
  "image": [
    "https://projectandmaterials.com/photos/1x1/photo.jpg",
    "https://projectandmaterials.com/photos/4x3/photo.jpg",
    "https://projectandmaterials.com/photos/16x9/photo.jpg"
   ],
  "datePublished": "2015-02-05T08:00:00+08:00",
  "dateModified": "2015-02-05T09:20:00+08:00",
  "author": {
    "@type": "Person",
    "name": "Emri Solution"
  },
   "publisher": {
    "@type": "Organization",
    "name": "projectandmaterials",
    "logo": {
      "@type": "ImageObject",
      "url": "https://projectandmaterials.com/logo.jpg"
    }
  },
  "description": "Writing final year project topics, term/serminar and masters' thesis/dissertations has become a nightmare for students of higher learning, this should not be the case, projectandmaterials reduce the burden by providing free and relevant resources and materials. It has been observed that students who use our services and resources always perform well with no stress. Our aim is to provide reference tools use for quick and more comprehensive understanding of your final year project work."
}
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131354369-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-131354369-3');
</script>
 
 <link rel="canonical" href="https://www.projectandmaterials.com/" />
 
@endpush

@section('content')
    
    @if (cynoebook_layout() === 'default')
        <!-- include('public.home.sections.slider') -->
        <div class="clearfix"></div>
    @elseif (cynoebook_layout() === 'slider_layout')
        @if(!is_null($slider))
        @include('public.home.sections.slider')
        <div class="clearfix"></div>
        @endif
    @endif

    @include('public.include.notification')
    
    @if (setting('cynoebook_home_ad1_section_enabled'))
     @include('public.home.sections.advertisement',['ad'=>$homeAdvertisement1])
    @endif

    <div class="shadow-divider"></div>

    <!-- services -->
    <div class="container">
        @include('public.home.sections.services', ['featuredServices' => $featuredServices])
    </div>

    <!-- Divider line-->
    <!-- <div class="section progress-bars section-padding" style="padding: 5px 0;"></div> -->

    <div class="shadow-divider"></div>
    
    <!-- featured categories -->
    <div class="section section-padding ">
        <div class="container">
            @include('public.home.sections.featured_categories', ['featuredCategories' => $featuredCategories] )
        </div>
    </div>


    <!-- CTA -->
    <div class="">
        @include('public.home.sections.cta')
    </div>


    {{-- @if (setting('cynoebook_features_section_enabled'))
        @include('public.home.sections.features')
    @endif --}}

    <!-- featured ebook -->
    @if (setting('cynoebook_featured_ebooks_carousel_section_enabled') && $carouselEbooks->count() > 2)
        @include('public.home.sections.featured_ebooks', [
            'title' => setting('cynoebook_featured_ebooks_section_title'),
            'ebooks' => $carouselEbooks
        ])
    @endif

     <!-- recent books --> <!-- Divider line-->
    <div class="line-divider1" style="padding: 5px 0;"></div>
    @if (setting('cynoebook_recent_ebooks_section_enabled') && $recentEbooks->count() > 2)
        @include('public.home.sections.recent_ebooks', [
            'title' => setting('cynoebook_recent_ebooks_section_title'),
            'ebooks' => $recentEbooks
        ])
    @endif

      <!-- popular books --> <!-- Divider line-->
    <div class="line-divider1" style="padding: 5px 0;"></div>
    @if (setting('cynoebook_category_tabs_section_enabled')  && $popularEbooks->count() > 2 )
        @include('public.home.sections.popular_ebooks', [
            'title' => setting('cynoebook_popular_ebooks_section_title'),
            'ebooks' => $popularEbooks
        ])
    @endif

   
     <!-- Divider line-->
    <div class="section progress-bars section-padding" style="padding: 5px 0;"></div>
    
    @if (setting('cynoebook_popular_ebooks_carousel_section_enabled'))
        <!-- include('public.home.sections.ebook_carousel', [
            'title' => setting('cynoebook_popular_ebooks_section_title'),
            'ebooks' => $popularEbooks
        ]) -->
    @endif
    
   <!--  @if (setting('cynoebook_banner_section_1_enabled'))
        include('public.home.sections.banner_section_1')
    @endif -->
    
    <!-- @if (setting('cynoebook_authors_section_enabled'))
        include('public.home.sections.authors_section')
    @endif -->
    
    @if (setting('cynoebook_home_ad2_section_enabled'))
        @include('public.home.sections.advertisement',['ad'=>$homeAdvertisement2])
    @endif

    <!-- Blog -->
    @include('public.home.sections.blog')
    

    <!-- Testimonil -->
    <div class="">
        <!-- include('public.home.sections.testimonials2') -->
    </div>

    
    @if (setting('cynoebook_banner_section_2_enabled'))
        @include('public.home.sections.banner_section_2')
    @endif
    
    @if (setting('cynoebook_category_tabs_section_enabled'))
        <!-- include('public.home.sections.category_tabs') -->
    @endif
    
    @if (setting('cynoebook_home_ad3_section_enabled'))
        @include('public.home.sections.advertisement',['ad'=>$homeAdvertisement3])
    @endif
    
    @if (setting('cynoebook_users_section_enabled'))
        @include('public.home.sections.users_section')
    @endif

@endsection
