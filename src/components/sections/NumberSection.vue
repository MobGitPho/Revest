<script setup>
// section: NumberSection

const { t } = useI18n()

const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
const { websiteInfo } = useInfo()
const { tr, res, rHtml } = useGlobal()

// Get unique widget
const uniqueWidget = getUniqueWidgetData('number_section')

// Get duplicable widgets
const duplicableWidgets = getDuplicableWidgetsData('wid_1')

var d = new Date();
var dy = d.getFullYear();


function expYear(dtfa){
//var dtfa = uniqueWidget?.expannee;
var dtfb = new Date(dtfa)  
var df = dtfb.getFullYear();
const resu= dy - df;

  return resu

}
</script>

<template>
    <section>
        <!-- Put your section template code here -->
        <section class="numbers section__space bg__img" data-background="/assets/images/globe.png">
            <div class="container">
                <div class="numbers__area wow fadeInUp">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-6">
                            <div class="content column__space">
                                <h5 class="neutral-top" v-html="rHtml(uniqueWidget?.subtitle) "/>
                                <h2 v-html="rHtml(uniqueWidget?.title)"/>
                                <p v-html="rHtml(uniqueWidget?.text)" />
                                <a href="properties.html" class="button button--effect">Start Exploring</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row d-flex align-items-start align-items-lg-center">
                                <div class="col-sm-6">
                                    <div class="numbers__single shadow__effect">
                                        <img src="/assets/images/platforms.png" alt="platform" />
                                        <h3><span class="counter">{{ uniqueWidget?.nbreinvest }}</span>+</h3>
                                        <p class="neutral-bottom">Investors Using Platform</p>
                                    </div>
                                    <div class="numbers__single shadow__effect__secondary">
                                        <img src="/assets/images/returns.png" alt="Returns" />
                                        <h3><span class="counter">{{ uniqueWidget?.returnpercent }}</span>%</h3>
                                        <p class="neutral-bottom">Returns upto</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="numbers__single alt shadow__effect__secondary">
                                        <img src="/assets/images/experience.png" alt="Experience" />
                                        <h3 class="counter">{{ expYear(uniqueWidget?.expannee) }}</h3>
                                        <p class="neutral-bottom">Years Experience</p>
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