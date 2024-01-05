<script setup>
  // section: VideoIllustrationSection

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
    <div class="video video__two section__space__top">
            <div class="container">
                <div class="video__area">
                    <img src="/assets/images/video-illustration.png" alt="Video Illustration" />
                    <div class="video__btn">
                        <a class="video__popup" href="https://www.youtube.com/watch?v=LCihLrSehCo" target="_blank"
                            title="YouTube video player">
                            <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
  </section>
</template>