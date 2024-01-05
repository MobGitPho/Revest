<script setup>
  // section: BannerBlogSection

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
    <section 
        class="banner blog-banner key-banner banner--secondary clear__top bg__img"
        :style="`background:url('/assets/images/banner/banner-bg.png')`">
        <div class="container">
            <div class="banner__area">
                <h1 class="neutral-top">Blog</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Pages
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Blog
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <img src="/assets/images/banner/blog__thumb.png" alt="Career" class="banner__thumb" />
    </section>
  </section>
</template>