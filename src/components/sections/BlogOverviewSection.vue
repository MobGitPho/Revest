<script setup>
  // section: BlogOverviewSection

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
    <section class="blog__overview section__space">
        <div class="container">
            <div class="blog__overview__area">
                <div class="search__bar">
                    <h2>Articles & Resources</h2>
                    <form action="#" method="post">
                        <div>
                            <input type="text" name="post_search" id="postSearch" placeholder="Search for articles"
                                required="required" />
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <button type="submit" class="button">Search</button>
                    </form>
                </div>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="featured__large__post">
                            <a href="blog-single.html" class="thumbnail">
                                <img src="/assets/images/blog/big-poster.png" alt="Poster" />
                            </a>
                            <div class="blog__content">
                                <h4><a href="blog-single.html">Eight Tips For Launching Your Real Estate
                                        Investing Career</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem
                                    ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                <a href="blog-single.html">Read More <i class="fa-solid fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="featured__post">
                            <div class="featured__post-single">
                                <a href="blog-single.html" class="thumbnail">
                                    <img src="/assets/images/blog/one.png" alt="Blog Post" />
                                </a>
                                <div class="featured__post-single-content">
                                    <h5><a href="blog-single.html">What Is Turn Key
                                            Real Estate
                                            Investing?</a></h5>
                                    <a href="blog-single.html">Read More <i
                                            class="fa-solid fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                            <div class="featured__post-single">
                                <a href="blog-single.html" class="thumbnail">
                                    <img src="/assets/images/blog/two.png" alt="Blog Post" />
                                </a>
                                <div class="featured__post-single-content">
                                    <h5><a href="blog-single.html">Getting Started in
                                            Residential Real
                                            Estate Investing</a></h5>
                                    <a href="blog-single.html">Read More <i
                                            class="fa-solid fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                            <div class="featured__post-single">
                                <a href="blog-single.html" class="thumbnail">
                                    <img src="/assets/images/blog/one.png" alt="Blog Post" />
                                </a>
                                <div class="featured__post-single-content">
                                    <h5><a href="blog-single.html">Resolving the Real
                                            Estate Investing
                                            Fear Factor</a></h5>
                                    <a href="blog-single.html">Read More <i
                                            class="fa-solid fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                            <div class="featured__post-single">
                                <a href="blog-single.html" class="thumbnail">
                                    <img src="/assets/images/blog/three.png" alt="Blog Post" />
                                </a>
                                <div class="featured__post-single-content">
                                    <h5><a href="blog-single.html">How to Make Better
                                            Real Estate
                                            Investments</a></h5>
                                    <a href="blog-single.html">Read More <i
                                            class="fa-solid fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>