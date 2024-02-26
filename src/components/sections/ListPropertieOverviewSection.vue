<script setup>
// section: ListPropertieOverviewSection
import { NNumberAnimation } from 'naive-ui';
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
        <section class="list__overview">
            <div class="container">
                <div class="list__overview__area">
                    <div class="row">
                        <div class="col-sm-6 col-lg-4">
                            <div class="list__overview__single shadow__effect">
                                <img src="/assets/images/icons/successs.png" alt="Success" />
                                <h3>
                                    <span class="counterFour">
                                        <n-number-animation ref="numberAnimationInstRef"  :from="0"
                                          :duration="30000"  :to="1000" :active="true" @finish="handleFinish" />
                                    </span>+
                                </h3>
                                <p class="neutral-bottom">Successful High-Value Transactions</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="list__overview__single shadow__effect">
                                <img src="/assets/images/icons/served.png" alt="served" />
                                <h3><span class="counterFour">
                                    <n-number-animation ref="numberAnimationInstRef"  :from="0"
                                          :duration="30000"  :to="5000" :active="true" @finish="handleFinish" /></span>+</h3>
                                <p class="neutral-bottom">Number of clients served</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="list__overview__single shadow__effect">
                                <img src="/assets/images/icons/exp.png" alt="experience" />
                                <h3><span class="counterFour"><n-number-animation ref="numberAnimationInstRef"  :from="0"
                                          :duration="30000"  :to="45" :active="true" @finish="handleFinish" /></span> Year+</h3>
                                <p class="neutral-bottom">Real estate investment experience</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>