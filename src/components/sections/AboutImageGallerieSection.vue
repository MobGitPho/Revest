<script setup>
  // section: AboutImageGallerieSection
  import { NCarousel } from 'naive-ui'

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('about')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
var ga = ref()
  const gallerie = (gal) => {
    if(gal){
        ga.value =  JSON.parse(gal)
    }else{
        ga.value = []
    }
    return ga
  }
</script>

<template>
  <div v-if="gallerie(uniqueWidget?.galerie)" class="image__gallery section__space">
    <div class="image__gallery__area">
      <n-carousel
        :show-dots="false"
        autoplay
        :slides-per-view="3"
        :space-between="20"
        loop="true"
        draggable>
        <template v-for="(al,i) in ga" :key="i">
          <div class="gallery__single">
            <a href="">
              <img :src="res(al)" style="width: 414px;height: 262px; object-fit: cover;" alt="Proect Image" />
            </a>
          </div>
        </template>
        <!--div class="gallery__single">
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
        </div-->
      </n-carousel>
    </div>
  </div>
</template>
