<script setup>
// section: TestimonySection
import { NCarousel } from 'naive-ui';
const { t } = useI18n()

const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
const { websiteInfo } = useInfo()
const { tr, res, rHtml } = useGlobal()

// Get unique widget
const uniqueWidget = getUniqueWidgetData('testimony_section')

// Get duplicable widgets
const duplicableWidgets = getDuplicableWidgetsData('testim_section_item')
function star(nb) {
    var total = 0
    if (nb > 5) {
        total = 5
    } else {
        total = nb
    }
    return total
}
</script>

<template>
    <section>
        <!-- Put your section template code here -->
        <section class="testimonial section__space pos__rel over__hi bg__img"
            data-background="/assets/images/testimonial/dot-map.png">
            <div class="container">
                <div class="testimonial__area">
                    <div class="section__header">
                        <h5 class="neutral-top">{{ tr(uniqueWidget?.subtitle) }}</h5>
                        <h2>{{ tr(uniqueWidget?.title) }}</h2>
                        <p class="neutral-bottom" v-html="rHtml(uniqueWidget.text)" />
                    </div>
                    <n-carousel show-arrow autoplay :slides-per-view="1" :space-between="20" :loop="true" draggable>
                        <template v-for="(tm, index) in duplicableWidgets" :key="index">
                            <div class="item">
                                <div class="testimonial__item__wrapper">
                                    <div class="testimonial__support">
                                        <div class="testimonial__item bg__img"
                                            data-background="/assets/images/testimonial/quote.png">
                                            <div v-if="tm?.star > 0" class="testimonial__author__ratings">
                                                <template v-for="(st, inde) in star(tm?.star)" :key="inde">
                                                    <i class="fa-solid fa-star"></i>
                                                </template>
                                            </div>

                                            <p class="tertiary" v-html="rHtml(tm?.text)" />
                                            <div class="testimonial__author">
                                                <div class="testimonial__author__info">
                                                    <div class="avatar__wrapper">
                                                        <img v-if="tm?.image" :src="res(tm?.image)" alt="{{tm}}" />
                                                        <img v-else src="/assets/images/testimonial/avatar.png"
                                                            alt="Allan Murphy" />
                                                    </div>
                                                    <div>
                                                        <h5>{{ tm?.name }} </h5>
                                                        <p class="neutral-bottom">{{ tr(tm?.state) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <!--template #arrow="{ prev, next }">
                            <div class="custom-arrow">
                                <button type="button" class="custom-arrow--left" @click="prev">
                                    <n-icon>
                                        <ArrowBack />
                                    </n-icon>
                                </button>
                                <button type="button" class="custom-arrow--right" @click="next">
                                    <n-icon>
                                        <ArrowForward />
                                    </n-icon>
                                </button>
                            </div>
                        </template>
                        <template #dots="{ total, currentIndex, to }">
                            <ul class="custom-dots">
                                <li v-for="index of total" :key="index"
                                    :class="{ ['is-active']: currentIndex === index - 1 }" @click="to(index - 1)" />
                            </ul>
                        </template-->
                    </n-carousel>
                </div>
            </div>
        </section>


    </section>
</template>
<style scoped>
.n-carousel .n-carousel__arrow {
    background-color: red;
    color: white;
}
.testimonial__item {
    border-radius: 10px;
}
.testimonial__item__wrapper {
    border-radius: 10px;
    display: flex;
    justify-content: center;
}

.item {

    width: 100%;
    height: auto;
    /*object-fit: cover;*/
}

.custom-arrow {
    display: flex;
    position: absolute;
    bottom: 25px;
    right: 10px;
}

.custom-arrow button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    margin-right: 12px;
    color: #fff;
    background-color: rgba(255, 255, 255, 0.1);
    border-width: 0;
    border-radius: 8px;
    transition: background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
}

.custom-arrow button:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.custom-arrow button:active {
    transform: scale(0.95);
    transform-origin: center;
}

.custom-dots {
    display: flex;
    margin: 0;
    padding: 0;
    position: absolute;
    bottom: 20px;
    left: 20px;
}

.custom-dots li {
    display: inline-block;
    width: 12px;
    height: 4px;
    margin: 0 3px;
    border-radius: 4px;
    background-color: rgba(255, 255, 255, 0.4);
    transition: width 0.3s, background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
}

/*.custom-dots li.is-active {
    width: 40px;
    background: #fff;
}
button .custom-arrow--right{
    background-color: red;
    color: white;
}
button .custom-arrow--left{
    background-color: red;
    color: white;
}*/
</style>