<script setup>
  // section: BlogSingleSection

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
    <section class="blog__single__post">
        <div class="container">
            <div class="blog__single__post__content">
                <div class="blog__details__head">
                    <div class="blog__item__info">
                        <div class="post__date">
                            <div class="dat">
                                <img src="/assets/images/blog/calendar.png" alt="Post Date" />
                                <p>December 17, 2022</p>
                            </div>
                        </div>
                        <div class="post__read__time">
                            <div class="dat">
                                <img src="/assets/images/blog/watch.png" alt="Post Read Time" />
                                <p>7 Min Read</p>
                            </div>
                        </div>
                    </div>
                    <div class="blog__social">
                        <div class="social text-start text-lg-end">
                            <a href="javascript:void(0)">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="javascript:void(0)">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="javascript:void(0)">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="javascript:void(0)">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <h2>Eight Tips For Launching Your Real
                    Estate Investing Career</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at lectus congue erat venenatis
                    volutpat. Aenean mollis nunc at felis imperdiet finibus. Quisque porttitor, augue ac euismod
                    lacinia, leo mauris lacinia libero, eget accumsan ipsum diam sit amet neque.</p>
                <div class="group">
                    <h4>Real Estate Investment Loan - Invest Through
                        Low Cost Funds</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at lectus congue erat venenatis
                        volutpat. Aenean mollis nunc at felis imperdiet finibus. Quisque porttitor, augue ac euismod
                        lacinia, leo mauris lacinia libero, eget accumsan ipsum diam sit amet neque.</p>
                    <ol>
                        <li>Penatibus non, amet sit faucibus nibh at et egestas. Ullamcorper tempor volutpat</li>
                        <li>Penatibus non, amet sit faucibus nibh at et egestas. Ullamcorper tempor volutpat</li>
                        <li>There are many variations of passages of Lorem Ipsum available</li>
                        <li>Many desktop publishing packages and web page editors now use Lorem.</li>
                    </ol>
                </div>
                <div class="poster">
                    <img src="/assets/images/blog/single-poster.png" alt="Poster" />
                </div>
                <div class="group">
                    <h4>How to Make Better Real Estate Invest.</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at lectus congue erat venenatis
                        volutpat. Aenean mollis nunc at felis imperdiet finibus. Quisque porttitor, augue ac euismod
                        lacinia, leo mauris lacinia libero, eget accumsan ipsum diam sit amet neque.</p>
                    <ol>
                        <li>Penatibus non, amet sit faucibus nibh at et egestas. Ullamcorper tempor volutpat</li>
                        <li>Penatibus non, amet sit faucibus nibh at et egestas. Ullamcorper tempor volutpat</li>
                        <li>There are many variations of passages of Lorem Ipsum available</li>
                        <li>Many desktop publishing packages and web page editors now use Lorem.</li>
                    </ol>
                </div>
                <div class="group">
                    <h4>Why Real Estate Investment Makes Better Sense Than
                        Investing in Stocks</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at lectus congue erat venenatis
                        volutpat. Aenean mollis nunc at felis imperdiet finibus. Quisque porttitor, augue ac euismod
                        lacinia, leo mauris lacinia libero, eget accumsan ipsum diam sit amet neque.</p>
                    <div class="quot">
                        <blockquote class="tertiary neutral-top neutral-bottom">
                            “Nisi quis eleifend quam adipiscing vitae aliquet bibendum enim facilisis gravida neque
                            velit euismod in pellentesque massa placerat”
                        </blockquote>
                    </div>
                </div>
                <div class="group">
                    <h4>HYIP Investments - Right Way to Earn a Million</h4>
                    <p class="neutral-bottom">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at
                        lectus congue erat venenatis
                        volutpat. Aenean mollis nunc at felis imperdiet finibus. Quisque porttitor, augue ac euismod
                        lacinia, leo mauris lacinia libero, eget accumsan ipsum diam sit amet neque.</p>
                </div>

            </div>
            <div class="section__space">
                <div class="blog__post__author bg__img" 
                :style="`background:url('/assets/images/blog/avatar-bg.png')`">
                    <img src="/assets/images/blog/avatar.png" alt="Author" />
                    <div>
                        <h4>Fannie Simon</h4>
                        <p class="cta__space">Joined Spoment on Dec 17, 2021</p>
                        <div class="social text-start">
                            <a href="javascript:void(0)">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="javascript:void(0)">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="javascript:void(0)">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="javascript:void(0)">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>