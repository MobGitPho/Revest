<script setup>
// section: FeaturedPropSection
import { useRoute } from 'vue-router';
import { useRouter } from 'vue-router'
const { t } = useI18n() 
const route = useRoute()
const router = useRouter()
const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
const { websiteInfo } = useInfo()
const { tr, res } = useGlobal()
const dbNewsArticleStore = useDbNewsArticleStore()
// Get unique widget
const uniqueWidget = getUniqueWidgetData('feature_section')

// Get duplicable widgets
const duplicableWidgets = getDuplicableWidgetsData('properties_section_item')

const locat = getDuplicableWidgetsData('property_filter_location_section')
const typLo = getDuplicableWidgetsData('property_filter_type_section')

function appFeature(proprietes) {
    const mesFeat = proprietes.filter((v) => v?.feature === 'OUI')

    return mesFeat?.slice(-3).reverse()
}
function apLocation(id) {
    const loca = locat.find((loc) => loc?._id === id)
    return loca.location;
}
function typLocation(id) {
    const loca = typLo.find((loc) => loc?._id === id)
    return loca.typ;
}
const openArticlePage = (article) => {
    if (article) {
        dbNewsArticleStore.article = article
        router.push(`/propertiesdetails/${article.slug}`)
    }
}

</script>

<template>
    <section>
        <!-- Put your section template code here -->
        <section class="featured__properties section__space">
            <div class="container">
                <div class="featured__properties__area wow fadeInUp">
                    <div class="title__with__cta">
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-8">
                                <h2>{{ tr(uniqueWidget?.title) }}</h2>
                            </div>
                            <div class="col-lg-4">
                                <div class="text-start text-lg-end">
                                    <a href="properties.html" class="button button--secondary button--effect">
                                        {{ tr(uniqueWidget?.button) }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <template v-for="(ap, index) in appFeature(duplicableWidgets)" :key="index">
                        <div class="property__list__wrapper">
                            <div class="row d-flex align-items-center">
                                <div class="col-lg-5">
                                    <div class="property__item__image column__space--secondary">
                                        <div class="img__effect">
                                            <a href="#" @click.prevent="openArticlePage(ap)">
                                                <img :src="res(ap?.image)" alt="Los Angeles" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="property__item__content">
                                        <div class="item__head">
                                            <div class="item__head__left">
                                                <h4>{{ apLocation(ap?.ville) }} </h4>
                                                <p><i class="fa-solid fa-location-dot"></i> {{ ap?.localisation }}
                                                </p>
                                            </div>
                                            <div class="item__head__right">
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
                                            </div>
                                        </div>
                                        <div class="progress__type progress__type--two">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="project__info">
                                                <p class="project__has"><span
                                                        class="project__has__investors">{{ ap?.nbinvest }}
                                                        {{ t('Investors') }}</span> | <span
                                                        class="project__has__investors__amount"><i
                                                            class="fa-solid fa-dollar-sign"></i> {{ ap?.price }}</span> <span
                                                        class="project__has__investors__percent">({{ ap?.percent }}%)</span>
                                                </p>
                                                <p class="project__goal">
                                                    <i class="fa-solid fa-dollar-sign"></i> {{ ap?.total }} {{ t('Goal') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="item__info">
                                            <div class="item__info__single">
                                                <p>Annual Return</p>
                                                <h6>{{ ap?.return }}</h6>
                                            </div>
                                            <div class="item__info__single">
                                                <p>Maximum Term</p>
                                                <h6>{{ ap?.maxterm }} Months</h6>
                                            </div>
                                            <div class="item__info__single">
                                                <p>Property Type</p>
                                                <h6>{{ tr(typLocation(ap?.typ_prop)) }}</h6>
                                            </div>
                                            <div class="item__info__single">
                                                <p>Distribution</p>
                                                <h6>{{ tr(ap?.distribution) }}</h6>
                                            </div>
                                        </div>
                                        <div class="item__footer">
                                            <div class="item__security">
                                                <div class="icon__box">
                                                    <img src="/assets/images/home.png" alt="Security" />
                                                </div>
                                                <div class="item__security__content">
                                                    <p class="secondary">Security</p>
                                                    <h6>{{ ap?.security }}</h6>
                                                </div>
                                            </div>
                                            <div class="item__cta__group">
                                                <a href="/registration" class="button button--effect">Invest Now</a>
                                                <a href="#" 
                                                    class="button button--secondary button--effect" @click.prevent="openArticlePage(ap)">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </template>

                    <!--div class="property__list__wrapper">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-5">
                            <div class="property__item__image column__space--secondary">
                                <div class="img__effect">
                                    <a href="property-details.html">
                                        <img src="assets/images/property/san.png" alt="San Francisco" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <div class="property__item__content">
                                <div class="item__head">
                                    <div class="item__head__left">
                                        <h4>San Francisco, CA</h4>
                                        <p><i class="fa-solid fa-location-dot"></i> 3335 21 St, San Francisco</p>
                                    </div>
                                    <div class="item__head__right">
                                        <div class="countdown__wrapper">
                                            <p class="secondary"><i class="fa-solid fa-clock"></i> Left to invest</p>
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
                                    </div>
                                </div>
                                <div class="progress__type progress__type--two">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="project__info">
                                        <p class="project__has"><span class="project__has__investors">179
                                                Investors</span> | <span class="project__has__investors__amount"><i
                                                    class="fa-solid fa-dollar-sign"></i> 1,64,296</span> <span
                                                class="project__has__investors__percent">(64.73%)</span></p>
                                        <p class="project__goal">
                                            <i class="fa-solid fa-dollar-sign"></i> 5,00,000 Goal
                                        </p>
                                    </div>
                                </div>
                                <div class="item__info">
                                    <div class="item__info__single">
                                        <p>Annual Return</p>
                                        <h6>3.5% + 6%</h6>
                                    </div>
                                    <div class="item__info__single">
                                        <p>Maximum Term</p>
                                        <h6>48 Months</h6>
                                    </div>
                                    <div class="item__info__single">
                                        <p>Property Type</p>
                                        <h6>Commercial</h6>
                                    </div>
                                    <div class="item__info__single">
                                        <p>Distribution</p>
                                        <h6>Monthly</h6>
                                    </div>
                                </div>
                                <div class="item__footer">
                                    <div class="item__security">
                                        <div class="icon__box">
                                            <img src="assets/images/home.png" alt="Security" />
                                        </div>
                                        <div class="item__security__content">
                                            <p class="secondary">Security</p>
                                            <h6>1st-Rank Mortgage</h6>
                                        </div>
                                    </div>
                                    <div class="item__cta__group">
                                        <a href="registration.html" class="button button--effect">Invest Now</a>
                                        <a href="property-details.html"
                                            class="button button--secondary button--effect">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="property__list__wrapper">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-5">
                            <div class="property__item__image column__space--secondary">
                                <div class="img__effect">
                                    <a href="property-details.html">
                                        <img src="assets/images/property/weldon.png" alt="The Weldon" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <div class="property__item__content">
                                <div class="item__head">
                                    <div class="item__head__left">
                                        <h4>The Weldon</h4>
                                        <p><i class="fa-solid fa-location-dot"></i> Gastonia, NC</p>
                                    </div>
                                    <div class="item__head__right">
                                        <div class="countdown__wrapper">
                                            <p class="secondary"><i class="fa-solid fa-clock"></i> Left to invest</p>
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
                                    </div>
                                </div>
                                <div class="progress__type progress__type--two">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="project__info">
                                        <p class="project__has"><span class="project__has__investors">579
                                                Investors</span> | <span class="project__has__investors__amount"><i
                                                    class="fa-solid fa-dollar-sign"></i> 4,64,196</span> <span
                                                class="project__has__investors__percent">(74.33%)</span></p>
                                        <p class="project__goal">
                                            <i class="fa-solid fa-dollar-sign"></i> 2,00,000 Goal
                                        </p>
                                    </div>
                                </div>
                                <div class="item__info">
                                    <div class="item__info__single">
                                        <p>Annual Return</p>
                                        <h6>2.5% + 2%</h6>
                                    </div>
                                    <div class="item__info__single">
                                        <p>Maximum Term</p>
                                        <h6>36 Months</h6>
                                    </div>
                                    <div class="item__info__single">
                                        <p>Property Type</p>
                                        <h6>Commercial</h6>
                                    </div>
                                    <div class="item__info__single">
                                        <p>Distribution</p>
                                        <h6>Monthly</h6>
                                    </div>
                                </div>
                                <div class="item__footer">
                                    <div class="item__security">
                                        <div class="icon__box">
                                            <img src="assets/images/home.png" alt="Security" />
                                        </div>
                                        <div class="item__security__content">
                                            <p class="secondary">Security</p>
                                            <h6>1st-Rank Mortgage</h6>
                                        </div>
                                    </div>
                                    <div class="item__cta__group">
                                        <a href="registration.html" class="button button--effect">Invest Now</a>
                                        <a href="property-details.html"
                                            class="button button--secondary button--effect">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="property__list__wrapper">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-5">
                            <div class="property__item__image column__space--secondary">
                                <div class="img__effect">
                                    <a href="property-details.html">
                                        <img src="assets/images/property/lily.png" alt="The Lily" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <div class="property__item__content">
                                <div class="item__head">
                                    <div class="item__head__left">
                                        <h4>The Lily</h4>
                                        <p><i class="fa-solid fa-location-dot"></i> Colorado Springs, CO</p>
                                    </div>
                                    <div class="item__head__right">
                                        <div class="countdown__wrapper">
                                            <p class="secondary"><i class="fa-solid fa-clock"></i> Left to invest</p>
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
                                    </div>
                                </div>
                                <div class="progress__type progress__type--two">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="project__info">
                                        <p class="project__has"><span class="project__has__investors">359
                                                Investors</span> | <span class="project__has__investors__amount"><i
                                                    class="fa-solid fa-dollar-sign"></i> 1,14,196</span> <span
                                                class="project__has__investors__percent">(64.73%)</span></p>
                                        <p class="project__goal">
                                            <i class="fa-solid fa-dollar-sign"></i> 5,00,000 Goal
                                        </p>
                                    </div>
                                </div>
                                <div class="item__info">
                                    <div class="item__info__single">
                                        <p>Annual Return</p>
                                        <h6>7.5% + 3%</h6>
                                    </div>
                                    <div class="item__info__single">
                                        <p>Maximum Term</p>
                                        <h6>36 Months</h6>
                                    </div>
                                    <div class="item__info__single">
                                        <p>Property Type</p>
                                        <h6>Commercial</h6>
                                    </div>
                                    <div class="item__info__single">
                                        <p>Distribution</p>
                                        <h6>Monthly</h6>
                                    </div>
                                </div>
                                <div class="item__footer">
                                    <div class="item__security">
                                        <div class="icon__box">
                                            <img src="assets/images/home.png" alt="Security" />
                                        </div>
                                        <div class="item__security__content">
                                            <p class="secondary">Security</p>
                                            <h6>1st-Rank Mortgage</h6>
                                        </div>
                                    </div>
                                    <div class="item__cta__group">
                                        <a href="registration.html" class="button button--effect">Invest Now</a>
                                        <a href="property-details.html"
                                            class="button button--secondary button--effect">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div-->
                </div>
            </div>
        </section>
</section></template>