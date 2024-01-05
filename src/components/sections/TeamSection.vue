<script setup>
// section: TeamSection

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
    <div class="row">
      <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="team__single shadow__effect">
          <div class="team__thumb">
            <img src="/assets/images/team/paul.png" alt="Paul" />
            <a href="#0">
              <i class="fa-brands fa-linkedin-in"></i>
            </a>
          </div>
          <h5 class="neutral-top">Paul Smith</h5>
          <p class="neutral-bottom">Founder & CEO</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="team__single shadow__effect">
          <div class="team__thumb">
            <img src="/assets/images/team/ryan.png" alt="Ryan Jackson" />
            <a href="#0">
              <i class="fa-brands fa-linkedin-in"></i>
            </a>
          </div>
          <h5 class="neutral-top">Ryan Jackson</h5>
          <p class="neutral-bottom">Head of Business Operations</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="team__single shadow__effect">
          <div class="team__thumb">
            <img src="/assets/images/team/rosen.png" alt="Brittany Rosen" />
            <a href="#0">
              <i class="fa-brands fa-linkedin-in"></i>
            </a>
          </div>
          <h5 class="neutral-top">Brittany Rosen</h5>
          <p class="neutral-bottom">VP, Finance and Strategy</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="team__single shadow__effect">
          <div class="team__thumb">
            <img src="/assets/images/team/robert.png" alt="Robert Henriks" />
            <a href="#0">
              <i class="fa-brands fa-linkedin-in"></i>
            </a>
          </div>
          <h5 class="neutral-top">Robert Henriks</h5>
          <p class="neutral-bottom">Senior Developer</p>
        </div>
      </div>
    </div>
  </section>
</template>