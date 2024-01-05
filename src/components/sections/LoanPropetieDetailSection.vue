<script setup>
  // section: LoanPropetieDetailSection

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
    <section class="properties__grid section__space wow fadeInUp">
        <div class="container">
            <div class="properties__grid__area">
                <div class="title__with__cta">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-8">
                            <h2>Browse Similar Business</h2>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-start text-lg-end">
                                <a href="properties.html" class="button button--secondary button--effect">Browse All
                                    Properties</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="property__grid__wrapper">
                    <div class="row alt__loan__row">
                        <div class="col-md-6 col-xl-4 alt__loan__grid">
                            <div class="alt__loan__grid__single">
                                <div class="imi__alt">
                                    <div class="img__effect">
                                        <a href="property-details.html">
                                            <img src="/assets/images/property/one.png" alt="Los Angeles" />
                                        </a>
                                        <div class="ribbon">
                                            <p>Waiting For Invest</p>
                                        </div>
                                    </div>
                                    <div class="alt__loan__content">
                                        <div class="item__head">
                                            <div class="item__head__left">
                                                <p>Sircue Industries</p>
                                                <h5>
                                                    <a href="business-loan-details.html">LTD Statybų taktikos</a>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="progress__type progress__type--three">
                                            <p class="collected">Collected Amount</p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="project__has"><span class="project__has__investors">159
                                                    Investors</span> | <span class="project__has__investors__amount"><i
                                                        class="fa-solid fa-dollar-sign"></i>
                                                    1,94,196</span> <span
                                                    class="project__has__investors__percent">(64.73%)</span></p>
                                        </div>
                                        <div class="item__info">
                                            <div class="item__info__single">
                                                <p>Annual Return</p>
                                                <h6>7.5% + 2%</h6>
                                            </div>
                                            <div class="item__info__single">
                                                <p>Maximum Term</p>
                                                <h6>36 Months</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alt__loan__foot">
                                    <div class="invest__cta__wrapper">
                                        <div class="countdown__wrapper">
                                            <p class="secondary"><i class="fa-solid fa-clock"></i> Left to invest
                                            </p>
                                            <div class="countdown">
                                                <h5>
                                                    <span class="days">00</span><span class="ref">d</span>
                                                    <span class="seperator">:</span>
                                                </h5>
                                                <h5>
                                                    <span class="hours"> 00</span><span class="ref">h</span>
                                                    <span class="seperator">:</span>
                                                </h5>
                                                <h5>
                                                    <span class="minutes">00</span><span class="ref">m</span>
                                                    <span class="seperator"></span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="invest__cta">
                                            <a href="business-loan-details.html" class="button button--effect">
                                                Invest Now
                                            </a>
                                            <p class="secondary">Business loan #00134</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 alt__loan__grid">
                            <div class="alt__loan__grid__single">
                                <div class="imi__alt">
                                    <div class="img__effect">
                                        <a href="property-details.html">
                                            <img src="/assets/images/property/two.png" alt="Los Angeles" />
                                        </a>
                                        <div class="ribbon">
                                            <p>Waiting For Invest</p>
                                        </div>
                                    </div>
                                    <div class="alt__loan__content">
                                        <div class="item__head">
                                            <div class="item__head__left">
                                                <p>Infinite Electric</p>
                                                <h5>
                                                    <a href="business-loan-details.html">LTD Orandis</a>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="progress__type progress__type--three">
                                            <p class="collected">Collected Amount</p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="project__has"><span class="project__has__investors">159
                                                    Investors</span> | <span class="project__has__investors__amount"><i
                                                        class="fa-solid fa-dollar-sign"></i>
                                                    1,94,196</span> <span
                                                    class="project__has__investors__percent">(64.73%)</span></p>
                                        </div>
                                        <div class="item__info">
                                            <div class="item__info__single">
                                                <p>Annual Return</p>
                                                <h6>7.5% + 2%</h6>
                                            </div>
                                            <div class="item__info__single">
                                                <p>Maximum Term</p>
                                                <h6>36 Months</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alt__loan__foot">
                                    <div class="invest__cta__wrapper">
                                        <div class="countdown__wrapper">
                                            <p class="secondary"><i class="fa-solid fa-clock"></i> Left to invest
                                            </p>
                                            <div class="countdown">
                                                <h5>
                                                    <span class="days">00</span><span class="ref">d</span>
                                                    <span class="seperator">:</span>
                                                </h5>
                                                <h5>
                                                    <span class="hours"> 00</span><span class="ref">h</span>
                                                    <span class="seperator">:</span>
                                                </h5>
                                                <h5>
                                                    <span class="minutes">00</span><span class="ref">m</span>
                                                    <span class="seperator"></span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="invest__cta">
                                            <a href="business-loan-details.html" class="button button--effect">
                                                Invest Now
                                            </a>
                                            <p class="secondary">Business loan #00294</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 alt__loan__grid">
                            <div class="alt__loan__grid__single">
                                <div class="imi__alt">
                                    <div class="img__effect">
                                        <a href="property-details.html">
                                            <img src="/assets/images/property/three.png" alt="Los Angeles" />
                                        </a>
                                        <div class="ribbon">
                                            <p>Waiting For Invest</p>
                                        </div>
                                    </div>
                                    <div class="alt__loan__content">
                                        <div class="item__head">
                                            <div class="item__head__left">
                                                <p>Circle Tree</p>
                                                <h5>
                                                    <a href="business-loan-details.html">LTD Pri,ita</a>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="progress__type progress__type--three">
                                            <p class="collected">Collected Amount</p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="project__has"><span class="project__has__investors">159
                                                    Investors</span> | <span class="project__has__investors__amount"><i
                                                        class="fa-solid fa-dollar-sign"></i>
                                                    1,94,196</span> <span
                                                    class="project__has__investors__percent">(64.73%)</span></p>
                                        </div>
                                        <div class="item__info">
                                            <div class="item__info__single">
                                                <p>Annual Return</p>
                                                <h6>7.5% + 2%</h6>
                                            </div>
                                            <div class="item__info__single">
                                                <p>Maximum Term</p>
                                                <h6>36 Months</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alt__loan__foot">
                                    <div class="invest__cta__wrapper">
                                        <div class="countdown__wrapper">
                                            <p class="secondary"><i class="fa-solid fa-clock"></i> Left to invest
                                            </p>
                                            <div class="countdown">
                                                <h5>
                                                    <span class="days">00</span><span class="ref">d</span>
                                                    <span class="seperator">:</span>
                                                </h5>
                                                <h5>
                                                    <span class="hours"> 00</span><span class="ref">h</span>
                                                    <span class="seperator">:</span>
                                                </h5>
                                                <h5>
                                                    <span class="minutes">00</span><span class="ref">m</span>
                                                    <span class="seperator"></span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="invest__cta">
                                            <a href="business-loan-details.html" class="button button--effect">
                                                Invest Now
                                            </a>
                                            <p class="secondary">Business loan #00994</p>
                                        </div>
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