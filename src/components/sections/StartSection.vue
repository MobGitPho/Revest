<script setup>
// section: StartSection
import VideoIllustrationSection from './VideoIllustrationSection.vue';
import StartSpaceSection from './StartSpaceSection.vue'
const { t } = useI18n()

const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
const { websiteInfo } = useInfo()
const { tr, res, rHtml } = useGlobal()

// Get unique widget
const uniqueWidget = getUniqueWidgetData('start_section')

// Get duplicable widgets
const duplicableWidgets = getDuplicableWidgetsData('start_section_item')
</script>

<template>
    <!-- Put your section template code here -->
    <section class="start section__space__top bg__img" data-background="/assets/images/step/start-bg.png">
        <div class="container">
            <div class="start__area wow fadeInUp">
                <div class="section__header">
                    <h5 class="neutral-top" v-html="rHtml(uniqueWidget?.subtitle)" />
                    <h2 v-html="rHtml(uniqueWidget?.title)" />
                    <p class="neutral-bottom" v-html="rHtml(uniqueWidget?.text)" />
                </div>
                <div class="row">
                    <template v-for="(st, index) in duplicableWidgets" :key="index">
                        <div class="col-md-6 col-xl-4">
                            <div class="start__single__item column__space--secondary">
                                <div class="img__box">
                                    <img :src="res(st?.image)" alt="Browse Properties" />
                                    <div class="step__count">
                                        <h4>0{{ index + 1 }}</h4>
                                    </div>
                                </div>
                                <h4>{{ tr(st?.title) }}</h4>
                                <p class="neutral-bottom" v-html="rHtml(st?.subtitle)" />
                            </div>
                        </div>

                    </template>

                    <!--div class="col-md-6 col-xl-4">
                        <div class="start__single__item column__space--secondary">
                            <div class="img__box arrow__container">
                                <img src="/assets/images/step/invest.png" alt="View Details & Invest" />
                                <div class="step__count">
                                    <h4>02</h4>
                                </div>
                            </div>
                            <h4>View Details & Invest</h4>
                            <p class="neutral-bottom">View detailed metrics for that property like Rental Yield, etc.
                                and invest like institutions.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="start__single__item">
                            <div class="img__box">
                                <img src="/assets/images/step/earn.png" alt="Earn and Track" />
                                <div class="step__count">
                                    <h4>03</h4>
                                </div>
                            </div>
                            <h4>Earn and Track</h4>
                            <p class="neutral-bottom">You have full visibility into the performance of your investment.
                                Track your total current.
                            </p>
                        </div>
                    </div-->
                </div>
            </div>
        </div>
    </section>

</template>