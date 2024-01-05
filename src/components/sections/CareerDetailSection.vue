<script setup>
  // section: CareerDetailSection

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
    <section class="position__details section__space">
        <div class="container">
            <div class="position__details__area">
                <h2 class="neutral-top">Investor Relations Support</h2>
                <div class="group__btn">
                    <a href="#overview" class="button button--effect job__application__btn">Overview</a>
                    <a href="#application"
                        class="button button--effect button--secondary job__application__btn">Application</a>
                </div>
                <div class="position__details__content__wrapper">
                    <div class="position__details__content" id="overview">
                        <div class="text__group">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3>Description</h3>
                                <a href="#0">
                                    Share this job <i class="fa-solid fa-share-nodes"></i>
                                </a>
                            </div>
                            <p class="neutral-bottom">We are currently seeking someone in Investor Relations Support to
                                join our founding team as we rapidly grow our client base. You will report directly to
                                our Head of Investor Relations and will spend the majority of your time interacting with
                                our investors to build new relationships, help them onboard onto the Revest platform and
                                generally ensure they receive a world-class experience. If you enjoy a fast-paced
                                environment, an energetic and social culture, and are looking for an opportunity where
                                you can scale your career alongside a rapidly growing company, then this could be for
                                you.</p>
                        </div>
                        <div class="text__group">
                            <h3>Responsibilities</h3>
                            <ul>
                                <li>Help strengthen and support relationships with Revest’s existing clients, and
                                    generally delight Revest's clients in every way possible.</li>
                                <li>Expertly respond to and address client questions.</li>
                                <li> Manage & execute new investor onboarding, evaluate a client's corporate entities &
                                    legal structures to determine onboarding and due diligence requirements. Gather
                                    accurate due diligence information from your clients in an efficient and effective
                                    way with the client experience being front of mind.</li>
                                <li>Assist the Head of Investor Relations and Investor Relations Executives to nurture
                                    leads and follow up with investors in a systematic and timely manner.</li>
                                <li class="neutral-bottom">Work with the technology and compliance team to build
                                    processes and technology that streamlines and improves our customer onboarding
                                    journey.</li>
                            </ul>
                        </div>
                        <div class="text__group">
                            <h3>Requirements</h3>
                            <ul>
                                <li>Help strengthen and support relationships with Revest’s existing clients, and
                                    generally delight Revest's clients in every way possible.</li>
                                <li>Expertly respond to and address client questions.</li>
                                <li> Manage & execute new investor onboarding, evaluate a client's corporate entities &
                                    legal structures to determine onboarding and due diligence requirements. Gather
                                    accurate due diligence information from your clients in an efficient and effective
                                    way with the client experience being front of mind.</li>
                                <li>Assist the Head of Investor Relations and Investor Relations Executives to nurture
                                    leads and follow up with investors in a systematic and timely manner.</li>
                                <li class="neutral-bottom">Work with the technology and compliance team to build
                                    processes and technology that streamlines and improves our customer onboarding
                                    journey.</li>
                            </ul>
                        </div>
                        <div class="text__group">
                            <h3>Benefits</h3>
                            <ul>
                                <li>Help strengthen and support relationships with Revest’s existing clients, and
                                    generally delight Revest's clients in every way possible.</li>
                                <li>Expertly respond to and address client questions.</li>
                                <li> Manage & execute new investor onboarding, evaluate a client's corporate entities &
                                    legal structures to determine onboarding and due diligence requirements. Gather
                                    accurate due diligence information from your clients in an efficient and effective
                                    way with the client experience being front of mind.</li>
                                <li>Assist the Head of Investor Relations and Investor Relations Executives to nurture
                                    leads and follow up with investors in a systematic and timely manner.</li>
                                <li class="neutral-bottom">Work with the technology and compliance team to build
                                    processes and technology that streamlines and improves our customer onboarding
                                    journey.</li>
                            </ul>
                        </div>
                        <div class="cta__btn">
                            <a href="#application" class="button button--effect job__application__btn">Apply for this
                                Job</a>
                        </div>
                    </div>
                    <div class="position__details__content" id="application">
                        <form action="#0" method="post" name="application__form">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input input--secondary">
                                        <label for="appFirstName">First Name*</label>
                                        <input type="text" name="app__first__name" id="appFirstName"
                                            placeholder="Enter Your First Name" required="required" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input input--secondary">
                                        <label for="appLastName">Last Name*</label>
                                        <input type="text" name="app__last__name" id="appLastName"
                                            placeholder="Enter Your Last Name" required="required" />
                                    </div>
                                </div>
                            </div>
                            <div class="input input--secondary">
                                <label for="appRegistrationMail">Email*</label>
                                <input type="email" name="app__registration__email" id="appRegistrationMail"
                                    placeholder="Enter your email" required="required" />
                            </div>
                            <div class="input input--secondary input__alt">
                                <label for="appNumber">Phone*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <select class="number__code__select" id="numberCodeSelect">
                                            <option selected value="0">+1</option>
                                            <option value="1">+2</option>
                                            <option value="2">+3</option>
                                            <option value="3">+4</option>
                                            <option value="4">+5</option>
                                            <option value="5">+6</option>
                                        </select>
                                    </div>
                                    <input type="number" name="app__number" id="appNumber" placeholder="345-323-1234" />
                                </div>
                            </div>
                            <div class="input__file__wrapper">
                                <p>Resume*</p>
                                <div class="input input__file">
                                    <div class="icon__box">
                                        <img src="/assets/images/file.png" alt="Upload Avatar" />
                                    </div>
                                    <label for="uploadImage">
                                        <span>Upload a files</span> or drag and drop here
                                    </label>
                                    <input type="file" name="add_image" id="uploadImage" class="d-none" />
                                </div>
                            </div>
                            <div class="cta__btn">
                                <button type="submit" class="button button--effect">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>