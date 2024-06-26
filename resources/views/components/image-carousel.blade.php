<div x-data="{
    slide: 0,
    interval: null,
    intervalDuration: {{ $intervalDuration ?? 3000 }},
    totalSlides: {{ count($images) }} - 1,
    next() {
        this.restartInterval()
        this.slide = (this.slide === this.totalSlides) ? 0 : this.slide + 1
    },
    prev() {
        this.restartInterval()
        this.slide = (this.slide === 0) ? this.totalSlides : this.slide - 1
    },
    restartInterval() {
        if (this.interval) {
            clearInterval(this.interval)
        }
        this.interval = setInterval(() => {
            this.slide = (this.slide === this.totalSlides) ? 0 : this.slide + 1
        }, 5000)
    },
    init() {
        this.restartInterval()
    }
}" class="relative">
    <section class="overflow-hidden rounded-md shadow">
        <template x-for="(image, index) in {{ json_encode($images) }}" :key="index">
            <div x-show="slide === index" class="transition-opacity duration-500"
                :class="{ 'opacity-100': slide === index, 'opacity-0': slide !== index }">
                <section class="w-full h-full relative">
                    <picture class="rounded overflow-hidden object-cover w-full aspect-square ">
                        <source :srcset="image.url" type="image/webp">
                        <img :src="image.url" :alt="image.alt" class="w-full">
                    </picture>
                    {{-- Text --}}
                    <template x-if="image.message">
                        <section
                            class="bg-gothic-50/70 px-4 py-2 absolute bottom-0 text-base md:text-lg backdrop-blur-sm">
                            <p x-text="image.message"></p>
                        </section>
                    </template>
                </section>

            </div>
        </template>
    </section>

    <button @click="prev()"
        class="absolute left-0 top-1/2 transform -translate-y-1/2 text-white/60 enabled:hover:text-white enabled:hover:bg-white/30 enabled:hover:backdrop-blur-[1px] px-4 py-2  h-full"
        :disabled="slide === 0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
            stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
    </button>

    <button @click="next()"
        class="absolute right-0 top-1/2 transform -translate-y-1/2 text-white/60 enabled:hover:text-white enabled:hover:bg-white/30 enabled:hover:backdrop-blur-[1px] px-4 py-2  h-full"
        :disabled="slide === totalSlides">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
    </button>


</div>
