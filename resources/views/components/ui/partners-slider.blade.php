<!-- Swiper -->
<div class="relative w-full">
    <div class="swiper-button-next next2 text-green-500"></div>
    <div class="swiper mySwiper">

        <div class="swiper-wrapper">
            @foreach($partners as $partner)
                <div class="swiper-slide">
                    <div class="flex flex-col gap-4 text-center justify-center items-center">
                        <img src="{{$partner['img']}}" class="w-36 h-36 rounded-full border border-green-500" alt="">
                        <p class="font-bold uppercase">{{$partner['name']}}</p>
                        <p class="text-xs">{{$partner['desc']}}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <div class="swiper-button-prev prev2 text-green-500"></div>
</div>


<style>
    .swiper {
        width: 90%;
        height: 100%;
    }

    @media (max-width: 648px) {
        .swiper {
            width: 80%;
        }
    }

    .swiper-wrapper {
        display: flex;
    }

    .swiper-slide {
        /*flex-shrink: 0; !* Убедитесь, что слайды не сжимаются *!*/
        /*width: 100%;    !* Один слайд на всю ширину *!*/
    }
</style>
@push('page-js')
    <!-- Initialize Swiper -->
    <script>
        // import Swiper from "swiper";
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            loop: true,
            initialSlide: 5,
            spaceBetween: 30,
            navigation: {
                nextEl: ".next2",
                prevEl: ".prev2",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1500: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                1600: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                },
            },
        });
    </script>
@endpush
