<script setup>
  // section: LoanDetailSection

  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('banner_application')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
  <section>
    <!-- Put your section template code here -->
    <div class="property__details__banner bg__img clear__top" 
    data-background="/assets/images/construction.png"
    :style="`background: url('${res(uniqueWidget?.loan_detail_image)}') no-repeat fixed left top;`">
    </div>
    <section class="p__details p__details__two faq section__space__bottom">
        <div class="container">
            <div class="p__details__area">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="p__details__content">
                            <a href="#gallery" class="button button--effect button--secondary"><i
                                    class="fa-solid fa-images"></i> Browse Gallery</a>
                            <div class="intro">
                                <h3>How much will I earn if I <span>invest:</span></h3>
                            </div>
                            <div class="investment__amount__area">
                                <div class="investment__wrapper">
                                    <div class="investment__wrapper__inner">
                                        <h5>Investment Amount (100 €-30991€)</h5>
                                        <div class="input input--secondary">
                                            <input type="number" name="invest__amount" id="investAmount"
                                                placeholder="5000" required="required" />
                                        </div>
                                        <div class="radio__group">
                                            <div>
                                                <input type=radio id="pone" checked class="radio-input"
                                                    name="radio-group">
                                                <label for="pone" class="radio-label"> <span
                                                        class="radio-border"></span> 13% </label>
                                            </div>
                                            <div>
                                                <input type=radio id="ptwo" checked class="radio-input"
                                                    name="radio-group">
                                                <label for="ptwo" class="radio-label"> <span
                                                        class="radio-border"></span> 13.25%
                                                </label>
                                            </div>
                                            <div>
                                                <input type=radio id="pthree" checked class="radio-input"
                                                    name="radio-group">
                                                <label for="pthree" class="radio-label"> <span
                                                        class="radio-border"></span> 13.5%
                                                </label>
                                            </div>
                                            <div>
                                                <input type=radio id="pfour" checked class="radio-input"
                                                    name="radio-group">
                                                <label for="pfour" class="radio-label"> <span
                                                        class="radio-border"></span> 14% </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="investment__footer">
                                        <div>
                                            <p class="secondary">I will earn ( 01 Month )</p>
                                            <h4 class="neutral-bottom">O.72 <i class="fa-solid fa-euro-sign"></i></h4>
                                        </div>
                                        <div>
                                            <p class="secondary">I will earn ( 12 Month )</p>
                                            <h4 class="neutral-bottom">11.72 <i class="fa-solid fa-euro-sign"></i></h4>
                                        </div>
                                        <div>
                                            <p class="secondary">I will earn ( 24 Month )</p>
                                            <h4 class="neutral-bottom">17.72 <i class="fa-solid fa-euro-sign"></i></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="group__one">
                                <h4>About the loan</h4>
                                <p>Purpose of the loan To increase the company's working capital</p>
                                <div class="tabular__group">
                                    <div class="single">
                                        <p>Amount of funding</p>
                                        <p>40,000 €</p>
                                    </div>
                                    <div class="single">
                                        <p>Risk</p>
                                        <p>C (Higher)</p>
                                    </div>
                                    <div class="single">
                                        <p>Payment of interest</p>
                                        <p>Every Month</p>
                                    </div>
                                    <div class="single">
                                        <p>Loan Repayment</p>
                                        <p>Every Month</p>
                                    </div>
                                    <div class="single">
                                        <p>Loan Repayment postponement</p>
                                        <p>3</p>
                                    </div>
                                    <div class="single">
                                        <p>Loan Period</p>
                                        <p>24 Months</p>
                                    </div>
                                    <div class="single">
                                        <p>Minimum Loan Period</p>
                                        <p>4 Months</p>
                                    </div>
                                    <div class="single">
                                        <p>collateral</p>
                                        <p>Guarantes/ Surety</p>
                                    </div>
                                    <div class="single">
                                        <p>Mortgage Rank</p>
                                        <p>Other Pledge</p>
                                    </div>
                                </div>
                                <p class="neutral-bottom">The purpose of the financing is to partially refinance an
                                    existing loan on the Nordstreet platform. Refinancing is requested to adjust
                                    financial flows. </p>
                            </div>
                            <div class="group__one">
                                <h4>Interest</h4>
                                <p>Annual interest rate</p>
                                <div class="tabular__group">
                                    <div class="single">
                                        <p>Investing from 100 €</p>
                                        <p>Fixed interest 13 %</p>
                                    </div>
                                    <div class="single">
                                        <p>Investing from 500 €</p>
                                        <p>Fixed interest 13.25 %</p>
                                    </div>
                                    <div class="single">
                                        <p>Investing from 1500 €</p>
                                        <p>Fixed interest 13.5 %</p>
                                    </div>
                                    <div class="single">
                                        <p>Investing from 2500 €</p>
                                        <p>Fixed interest 14 %</p>
                                    </div>
                                </div>
                                <p class="neutral-bottom">The Interest on the Loan Amount shall be calculated from and
                                    including the date of
                                    disbursement of the Loan Amount to the Debtor's Account or to such other account (or
                                    accounts) as notified by the Debtor to the Operator in writing prior to the
                                    disbursement of the Loan Amount.</p>
                            </div>
                            <div class="group__one">
                                <h4>Loan term and repayment</h4>
                                <div class="tabular__group">
                                    <div class="single">
                                        <p>Loan Repayment</p>
                                        <p>Every Month</p>
                                    </div>
                                    <div class="single">
                                        <p>Loan Repayment postponement</p>
                                        <p>3</p>
                                    </div>
                                    <div class="single">
                                        <p>Loan Period</p>
                                        <p>24 Months</p>
                                    </div>
                                    <div class="single">
                                        <p>Minimum Loan Period</p>
                                        <p>4 Months</p>
                                    </div>
                                    <div class="single">
                                        <p>Estimated start date of the loan</p>
                                        <p>2022-01-28</p>
                                    </div>
                                    <div class="single">
                                        <p>Estimated start date of the loan</p>
                                        <p>2022-01-28</p>
                                    </div>
                                </div>
                                <p class="neutral-bottom">If the Debtor repays the Loan earlier than after the specified
                                    minimum loan period, it undertakes to pay interest to the Lender for the entire
                                    specified minimum period.</p>
                            </div>
                            <div class="group__one">
                                <div class="map__wrapper">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20342.411046372905!2d-74.16638039276373!3d40.719832743885284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1649562691355!5m2!1sen!2sbd"
                                        width="746" height="312" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="p__details__sidebar">
                            <div class="intro">
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
                                <h5>Available for funding: <span>€134 514</span></h5>
                                <div class="progress__type progress__type--two">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="project__info">
                                        <p class="project__has"><span class="project__has__investors">159
                                                Investors</span> | <span class="project__has__investors__amount"><i
                                                    class="fa-solid fa-dollar-sign"></i> 1,94,196</span></p>
                                        <p class="project__goal">
                                            <i class="fa-solid fa-dollar-sign"></i> 3,00,000 Goal
                                        </p>
                                    </div>
                                </div>
                                <div class="ribbon">
                                    <p>Business loan #00194</p>
                                </div>
                            </div>
                            <div class="group brin">
                                <div class="acus__content">
                                    <form action="#" method="post">
                                        <div class="input input--secondary">
                                            <label for="anNumTwo">Annual return rate:</label>
                                            <input type="number" name="an__num__two" id="anNumTwo" placeholder="7.00%"
                                                required="required" />
                                        </div>
                                        <div class="input input--secondary">
                                            <label for="anNumIn">Invest</label>
                                            <input type="number" name="an__num_in" id="anNumIn" placeholder="€ 500"
                                                required="required" />
                                        </div>
                                        <div class="hab">
                                            <div class="anti">
                                                <p>Loan Period</p>
                                                <div class="inti">
                                                    <p>24 mo.</p>
                                                </div>
                                            </div>
                                            <div class="anti">
                                                <p>Risk</p>
                                                <div class="inti">
                                                    <p>C (Higher)</p>
                                                </div>
                                            </div>
                                            <div class="anti">
                                                <p>Purpose Of Loan</p>
                                                <div class="inti">
                                                    <p>Business Loan</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collat">
                                            <div class="single">
                                                <p>Collateral</p>
                                                <p>Guarantees/Surety</p>
                                            </div>
                                            <div class="single">
                                                <p>Country</p>
                                                <p><img src="/assets/images/icons/flag.png" alt="flag"> Lithunia</p>
                                            </div>
                                        </div>
                                        <div class="suby">
                                            <h5>500</h5>
                                            <button type="submit" class="button button--effect">Invest Now</button>
                                        </div>
                                    </form>
                                </div>
                                <p class="text-center neutral-bottom">
                                    <a href="contact-us.html">Request a free callback</a>
                                </p>
                            </div>
                            <div class="group brini">
                                <h5 class="neutral-top">Investment Overview</h5>
                                <hr />
                                <p>Purpose of the loan To increase the company's working capital, magna a laoreet
                                    convallis, massa sapien tempor arcu, nec euismod elit justo in lacus. Maecenas
                                    mattis massa lectus, vel tincidunt augue porta non.</p>
                                <p>Duis quis orci vehicula, fermentum tortor vitae, imperdiet sem. Quisque iaculis eu
                                    odio in lobortis. Sed vel ex non erat pellentesque lobortis vel vitae diam. Donec
                                    gravida eleifend pellentesque. Curabitur dictum blandit accumsan.</p>
                                <a href="blog.html">Read More</a>
                            </div>
                            <div class="group birinit">
                                <h6>Share via Social </h6>
                                <div class="social text-start">
                                    <a href="javascript:void(0)">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="group alt__brin">
                                <h5>Key Updates <i class="fa-solid fa-bell"></i></h5>
                                <hr />
                                <div class="singl__wrapper">
                                    <div class="singl">
                                        <img src="/assets/images/check.png" alt="Check" />
                                        <div>
                                            <p>30-Aug-2022</p>
                                            <a href="terms-conditions.html">Term Sheet Signed</a>
                                        </div>
                                    </div>
                                    <div class="singl">
                                        <img src="/assets/images/check.png" alt="Check" />
                                        <div>
                                            <p>30-Aug-2022</p>
                                            <a href="privacy-policy.html">Listing Live</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="group alt__brin__last">
                                <h5>Reports</h5>
                                <hr />
                                <h6>Investment Note</h6>
                                <p>Property Share's Detailed Investment Note</p>
                                <a href="javascript:void(0)" class="button">DOWNLOAD INVESTMENT NOTE <i
                                        class="fa-solid fa-download"></i></a>
                                <h6>Legal Title Report</h6>
                                <p>Detailed Report on the Title diligence of the
                                    property by Amarchand Mangaldas</p>
                                <a href="javascript:void(0)" class="button">DOWNLOAD TITLE REPORT <i
                                        class="fa-solid fa-download"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </section>
</template>