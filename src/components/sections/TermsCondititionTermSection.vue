<script setup>
  // section: TermsCondititionTermSection

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
    <section class="terms section__space">
        <div class="container">
            <div class="terms-area">
                <div class="terms__single">
                    <h3 class="neutral-top">We're always looking for new ways to provide privacy for our customers.</h3>
                    <p>Id ipsum mi tempor eget. Pretium consectetur scelerisque blandit habitasse non ullamcorper enim,
                        diam quam id et, tempus massa. Sed nam vulputate pellentesque quis. Varius a, nunc faucibus
                        proin elementum id odio auctor. Nunc, suspendisse consequat libero, pharetra tellus vulputate
                        auctor venenatis tortor non rhoncus at duis. Pharetra ipsum mauris integer sit feugiat.</p>
                    <ul>
                        <li>Blandit dignissim nulla varius tristique a sed integer ut tempor.</li>
                        <li>Augue interdum semper bibendum amet sed.</li>
                        <li>Dis in at ultricies tortor sit tellus.</li>
                        <li>Habitant ornare aenean maecenas pretium</li>
                    </ul>
                </div>
                <hr />
                <div class="terms__single">
                    <h3 class="neutral-top">Your data is safe with us, we will not share any information with external
                        sources.</h3>
                    <p>Id ipsum mi tempor eget. Pretium consectetur scelerisque blandit habitasse non ullamcorper enim,
                        diam quam id et, tempus massa. Sed nam vulputate pellentesque quis. Varius a, nunc faucibus
                        proin elementum id odio auctor. Nunc, suspendisse consequat libero, pharetra tellus vulputate
                        auctor venenatis tortor non rhoncus at duis. Pharetra ipsum mauris integer sit feugiat.</p>
                    <ul>
                        <li>Blandit dignissim nulla varius tristique a sed integer ut tempor.</li>
                        <li>Augue interdum semper bibendum amet sed.</li>
                        <li>Dis in at ultricies tortor sit tellus.</li>
                        <li>Habitant ornare aenean maecenas pretium</li>
                    </ul>
                </div>
                <hr />
                <div class="terms__single">
                    <h3 class="neutral-top">We're always looking for new ways to provide privacy for our customers.</h3>
                    <p>Id ipsum mi tempor eget. Pretium consectetur scelerisque blandit habitasse non ullamcorper enim,
                        diam quam id et, tempus massa. Sed nam vulputate pellentesque quis. Varius a, nunc faucibus
                        proin elementum id odio auctor. Nunc, suspendisse consequat libero, pharetra tellus vulputate
                        auctor venenatis tortor non rhoncus at duis. Pharetra ipsum mauris integer sit feugiat.</p>
                        <p>Id ipsum mi tempor eget. Pretium consectetur scelerisque blandit habitasse non ullamcorper enim,
                            diam quam id et, tempus massa.</p>>
                    <ul>
                        <li>Blandit dignissim nulla varius tristique a sed integer ut tempor.</li>
                        <li>Augue interdum semper bibendum amet sed.</li>
                        <li>Dis in at ultricies tortor sit tellus.</li>
                        <li>Habitant ornare aenean maecenas pretium</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>