<script setup>
  // section: ListPropertieWorktwoSection

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
    <section class="work__two section__space bg__img" data-background="/assets/images/gd-bg.png">
        <div class="container">
            <div class="work__two__area wow fadeInUp">
                <div class="section__header">
                    <h5 class="neutral-top">How it works</h5>
                    <h2>It is Easy to Get Started.</h2>
                    <p class="neutral-bottom">Submit your property quickly and easily!
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="work__two__single">
                            <div class="ico">
                                <h4>1</h4>
                            </div>
                            <h4>Fill out the online form</h4>
                            <p class="neutral-bottom">Answer a few questions and attach a summary file to help us
                                evaluate your property.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="work__two__single">
                            <div class="ico">
                                <h4>2</h4>
                            </div>
                            <h4>Analysis of the property</h4>
                            <p class="neutral-bottom">Answer a few questions and attach a summary file to help us
                                evaluate your property.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="work__two__single">
                            <div class="ico">
                                <h4>3</h4>
                            </div>
                            <h4>Receive a first offer</h4>
                            <p class="neutral-bottom">Answer a few questions and attach a summary file to help us
                                evaluate your property.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>