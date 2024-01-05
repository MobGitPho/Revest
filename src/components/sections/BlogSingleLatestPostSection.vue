<script setup>
  // section: BlogSingleLatestPostSection

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
    <section class="latest__post__features section__space bg__img">
        <div class="container">
            <div class="latest__post__features__area wow fadeInUp">
                <div class="title__with__cta">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-8">
                            <h2>Latest Posts</h2>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-start text-lg-end">
                                <a href="blog.html" class="button button--secondary button--effect">Browse All
                                    Posts</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row altr">
                    <div class="col-md-6 col-xl-4">
                        <div class="featured__large__post">
                            <a href="blog-single.html" class="thumbnail">
                                <img src="/assets/images/blog/latest-one.png" alt="Poster" />
                            </a>
                            <div class="blog__content">
                                <h5><a href="blog-single.html">Learn the Benefits of Rental
                                        Property Investing</a></h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                <a href="blog-single.html">Read More <i class="fa-solid fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="featured__large__post">
                            <a href="blog-single.html" class="thumbnail">
                                <img src="/assets/images/blog/latest__two.png" alt="Poster" />
                            </a>
                            <div class="blog__content">
                                <h5><a href="blog-single.html">A Short Guide on Rental
                                        Property Investment</a></h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                <a href="blog-single.html">Read More <i class="fa-solid fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="featured__large__post">
                            <a href="blog-single.html" class="thumbnail">
                                <img src="/assets/images/blog/latest-three.png" alt="Poster" />
                            </a>
                            <div class="blog__content">
                                <h5><a href="blog-single.html">Learn the Benefits of Rental
                                        Property Investing</a></h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                <a href="blog-single.html">Read More <i class="fa-solid fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>