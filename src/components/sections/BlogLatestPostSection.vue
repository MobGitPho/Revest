<script setup>
  // section: BlogLatestPostSection

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
    <section class="latest__post section__space">
        <div class="container">
            <div class="latest__post__area">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="left__wrap">
                            <div class="filter__bar">
                                <h3>Latest Posts</h3>
                                <div class="filter__bar__tabs">
                                    <a href="javascript:void(0)" class="filter__bar__tab button button--effect" data-target="all">All</a>
                                    <a href="javascript:void(0)" class="filter__bar__tab button button--effect button--secondary"
                                        data-target="articles">Articles</a>
                                    <a href="javascript:void(0)" class="filter__bar__tab button button--effect button--secondary"
                                        data-target="news">News</a>
                                    <a href="javascript:void(0)" class="filter__bar__tab button button--effect button--secondary"
                                        data-target="resources">Resources</a>
                                </div>
                            </div>
                            <div class="row latest__blog__shuffle">
                                <div class="col-md-6 latest__blog__item" data-groups='["all","resources"]'>
                                    <div class="featured__large__post">
                                        <a href="blog-single.html" class="thumbnail">
                                            <img src="/assets/images/blog/latest-one.png" alt="Poster" />
                                        </a>
                                        <div class="blog__content">
                                            <h5><a href="blog-single.html">Learn the Benefits of Rental
                                                    Property Investing</a></h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                            <a href="blog-single.html">Read More <i
                                                    class="fa-solid fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 latest__blog__item " data-groups='["all","news"]'>
                                    <div class="featured__large__post">
                                        <a href="blog-single.html" class="thumbnail">
                                            <img src="/assets/images/blog/latest__two.png" alt="Poster" />
                                        </a>
                                        <div class="blog__content">
                                            <h5><a href="blog-single.html">A Short Guide on Rental
                                                    Property Investment</a></h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                            <a href="blog-single.html">Read More <i
                                                    class="fa-solid fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 latest__blog__item" data-groups='["all","articles"]'>
                                    <div class="featured__large__post">
                                        <a href="blog-single.html" class="thumbnail">
                                            <img src="/assets/images/blog/latest-three.png" alt="Poster" />
                                        </a>
                                        <div class="blog__content">
                                            <h5><a href="blog-single.html">Getting Started in Residential
                                                    Real Estate Investing</a></h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                            <a href="blog-single.html">Read More <i
                                                    class="fa-solid fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 latest__blog__item" data-groups='["all","news"]'>
                                    <div class="featured__large__post">
                                        <a href="blog-single.html" class="thumbnail">
                                            <img src="/assets/images/blog/latest-four.png" alt="Poster" />
                                        </a>
                                        <div class="blog__content">
                                            <h5><a href="blog-single.html">Five Key Principles to Real
                                                    Estate Investment </a></h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                            <a href="blog-single.html">Read More <i
                                                    class="fa-solid fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 latest__blog__item" data-groups='["all","resources"]'>
                                    <div class="featured__large__post">
                                        <a href="blog-single.html" class="thumbnail">
                                            <img src="/assets/images/blog/latest__five.png" alt="Poster" />
                                        </a>
                                        <div class="blog__content">
                                            <h5><a href="blog-single.html">Tips For Commercial Real
                                                    Estate Investment </a></h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                            <a href="blog-single.html">Read More <i
                                                    class="fa-solid fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 latest__blog__item" data-groups='["all","articles"]'>
                                    <div class="featured__large__post">
                                        <a href="blog-single.html" class="thumbnail">
                                            <img src="/assets/images/blog/latest-six.png" alt="Poster" />
                                        </a>
                                        <div class="blog__content">
                                            <h5><a href="blog-single.html">How to Choose Real Estate
                                                    Investment Property</a></h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                            <a href="blog-single.html">Read More <i
                                                    class="fa-solid fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 latest__blog__item" data-groups='["all","resources"]'>
                                    <div class="featured__large__post">
                                        <a href="blog-single.html" class="thumbnail">
                                            <img src="/assets/images/blog/latest-three.png" alt="Poster" />
                                        </a>
                                        <div class="blog__content">
                                            <h5><a href="blog-single.html">How to Choose Real Estate
                                                    Investment Property</a></h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                            <a href="blog-single.html">Read More <i
                                                    class="fa-solid fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 latest__blog__item" data-groups='["all","news"]'>
                                    <div class="featured__large__post">
                                        <a href="blog-single.html" class="thumbnail">
                                            <img src="/assets/images/blog/latest-eight.png" alt="Poster" />
                                        </a>
                                        <div class="blog__content">
                                            <h5><a href="blog-single.html">How to Choose Real Estate
                                                    Investment Property</a></h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                            <a href="blog-single.html">Read More <i
                                                    class="fa-solid fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">
                                            <i class="fa-solid fa-arrow-left-long"></i>
                                        </a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">01</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">02</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">03</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="right__wrap">
                            <div class="blog__newsletter">
                                <img src="/assets/images/blog/newsletter.png" alt="Newsletter" />
                                <h4>Subscribe to our
                                    newsletter</h4>
                                <p>Lorem ipsum dolor sit amet dolor consectetur adipiscing elit</p>
                                <form action="#" method="post">
                                    <div class="input">
                                        <input type="email" name="sub_email" id="subEmail"
                                            placeholder="Enter Your Email" />
                                    </div>
                                    <button type="submit" class="button button--effect">Subscribe</button>
                                </form>
                            </div>
                            <div class="blog__popular">
                                <h5 class="neutral-top">Popular Articles</h5>
                                <div class="blog__popular__single">
                                    <a href="blog-single.html" class="thumbnail">
                                        <img src="/assets/images/blog/popular-one.png" alt="Popular One" />
                                    </a>
                                    <div class="blog__popular__single-content">
                                        <h6><a href="blog-single.html">3-Step Rental
                                                Property Investing
                                                Strategy </a></h6>
                                        <a href="blog-single.html">Read More <i
                                                class="fa-solid fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                                <div class="blog__popular__single">
                                    <a href="blog-single.html" class="thumbnail">
                                        <img src="/assets/images/blog/popular-two.png" alt="Popular One" />
                                    </a>
                                    <div class="blog__popular__single-content">
                                        <h6><a href="blog-single.html">Learn the Benefits of
                                                Rental Property
                                                Investing</a></h6>
                                        <a href="blog-single.html">Read More <i
                                                class="fa-solid fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                                <div class="blog__popular__single">
                                    <a href="blog-single.html" class="thumbnail">
                                        <img src="/assets/images/blog/popular-one.png" alt="Popular One" />
                                    </a>
                                    <div class="blog__popular__single-content">
                                        <h6><a href="blog-single.html">A Short Guide on
                                                Rental Property
                                                Investment </a></h6>
                                        <a href="blog-single.html">Read More <i
                                                class="fa-solid fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="blog__popular">
                                <h5 class="neutral-top">Read More</h5>
                                <div class="blog__popular__single">
                                    <div class="categories">
                                        <h6>
                                            <a href="blog-single.html">– Exited projects</a>
                                        </h6>
                                        <h6>
                                            <a href="blog-single.html">(07)</a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="blog__popular__single">
                                    <div class="categories">
                                        <h6>
                                            <a href="blog-single.html">– How to</a>
                                        </h6>
                                        <h6>
                                            <a href="blog-single.html">(04)</a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="blog__popular__single">
                                    <div class="categories">
                                        <h6>
                                            <a href="blog-single.html">– Insider updates</a>
                                        </h6>
                                        <h6>
                                            <a href="blog-single.html">(09)</a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="blog__popular__single">
                                    <div class="categories">
                                        <h6>
                                            <a href="blog-single.html">– News</a>
                                        </h6>
                                        <h6>
                                            <a href="blog-single.html">(23)</a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="blog__popular__single">
                                    <div class="categories">
                                        <h6>
                                            <a href="blog-single.html">– Tips and tricks</a>
                                        </h6>
                                        <h6>
                                            <a href="blog-single.html">(16)</a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="blog__popular__single">
                                    <div class="categories">
                                        <h6>
                                            <a href="blog-single.html">– Get inspired</a>
                                        </h6>
                                        <h6>
                                            <a href="blog-single.html">(13)</a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="blog__popular__single">
                                    <div class="categories">
                                        <h6>
                                            <a href="blog-single.html">– Invesments</a>
                                        </h6>
                                        <h6>
                                            <a href="blog-single.html">(22)</a>
                                        </h6>
                                    </div>
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