<script setup>
  // section: ContactOverviewSection

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo, websiteOwnerInfo, websiteMoreInfo, socialNetworks } =
    useInfo()
  const { tr, res, rHtml } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('contact_section')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
  <section v-if="uniqueWidget" class="contact__overview">
    <div class="container">
      <div class="contact__overview__area">
        <div class="row">
          <div class="col-md-6 col-xl-4">
            <div
              style="height: 100%"
              class="contact__overview__single column__space--secondary shadow__effect">
              <img src="/assets/images/icons/email.png" alt="email" />
              <h5 v-if="tr(uniqueWidget?.title_1)">{{ tr(uniqueWidget?.title_1) }}</h5>
              <p v-html="rHtml(uniqueWidget?.text_1)"  />
              <hr />
              <p class="neutral-bottom">
                <a href=""
                  ><span class="__cf_email__" data-cfemail="">{{
                    websiteOwnerInfo?.email
                  }}</span></a
                >
              </p>
            </div>
          </div>
          <div class="col-md-6 col-xl-4">
            <div
              style="height: 100%"
              class="contact__overview__single column__space--secondary shadow__effect">
              <img src="/assets/images/icons/phone.png" alt="Call" />
              <h5 v-if="tr(uniqueWidget?.title_2)">{{ tr(uniqueWidget?.title_2) }}</h5>
              <p v-html="rHtml(uniqueWidget?.text_2)" />
              <hr />
              <p class="neutral-bottom">
                <a :href="`tel:${websiteOwnerInfo?.phone}`">{{
                  websiteOwnerInfo?.phone
                }}</a>
              </p>
            </div>
          </div>
          <div class="col-md-6 col-xl-4">
            <div
              style="height: 100%"
              class="contact__overview__single shadow__effect">
              <img src="/assets/images/icons/chat.png" alt="Chat" />
              <h5 v-if="tr(uniqueWidget?.title_3)">{{ tr(uniqueWidget?.title_3) }}</h5>
              <p v-html="rHtml(uniqueWidget?.text_3)"  />
              <hr />
              <p class="neutral-bottom">
                <template v-for="(socialNetwork, i) in socialNetworks" :key="i">
                  <a
                    v-if="socialNetwork.url"
                    :href="socialNetwork?.url"
                    target="_blank" 
                    style="margin-right: 30px;margin-bottom: 10px;">
                    <!--i
                      :class="'fa fa-' + socialNetwork?.name"
                      style="
                        color: #13216e;
                        height: 20px;
                        width: 20px;
                        margin-right: 10px;
                      "></i-->
                    {{ socialNetwork?.name }}</a
                  >
                </template>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
