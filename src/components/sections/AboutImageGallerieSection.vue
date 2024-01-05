<script setup>
// section: AboutImageGallerieSection
import { NCarousel } from "naive-ui"

const { t } = useI18n()

const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
const { websiteInfo } = useInfo()
const { tr, res } = useGlobal()

// Get unique widget
const uniqueWidget = getUniqueWidgetData('wid_1')

// Get duplicable widgets
const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
    <section>
        <!-- Put your section template code here -->
        <div class="image__gallery section__space">
            <div class="image__gallery__area">
                <n-carousel  autoplay :slides-per-view="3" :space-between="20" :loop="true" draggable>
                    <div class="gallery__single">
                        <a href="/assets/images/one.png">
                            <img src="/assets/images/one.png" alt="Proect Image" />
                        </a>
                    </div>
                    <div class="gallery__single">
                        <a href="/assets/images/two.png">
                            <img src="/assets/images/two.png" alt="Proect Image" />
                        </a>
                    </div>
                    <div class="gallery__single">
                        <a href="/assets/images/three.png">
                            <img src="/assets/images/three.png" alt="Proect Image" />
                        </a>
                    </div>
                    <div class="gallery__single">
                        <a href="/assets/images/one.png">
                            <img src="/assets/images/one.png" alt="Proect Image" />
                        </a>
                    </div>
                    <div class="gallery__single">
                        <a href="/assets/images/two.png">
                            <img src="/assets/images/two.png" alt="Proect Image" />
                        </a>
                    </div>
                    <div class="gallery__single">
                        <a href="/assets/images/three.png">
                            <img src="/assets/images/three.png" alt="Proect Image" />
                        </a>
                    </div>

                </n-carousel>

            </div>
        </div>
    </section>
</template>