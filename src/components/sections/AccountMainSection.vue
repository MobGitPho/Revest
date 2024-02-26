<script setup>
  // section: AccountMainSection
  import {
    NCard,
    NTabs,
    NTabPane,
    NButton,
    NFormItem,
    NTab,
    NForm,
    NInput,
    NFormItemRow,
  } from 'naive-ui'
  const { t } = useI18n()

  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo } = useInfo()
  const { tr, res } = useGlobal()

  const isOpen = ref(false)

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('wid_1')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')
</script>

<template>
  <div class="dashboard section__space__bottom">
    <div class="container">
      <div class="dashboard__area">
        <div class="row">
          <!--div class="col-xxl-3">
            <div class="sidebar">
              <a href="javascript:void(0)" class="close__sidebar">
                <i class="fa-solid fa-xmark"></i>
              </a>
              <div class="sidenav__wrapper">
                <ul>
                  <li>
                    <a href="dashboard.html">
                      <img src="assets/images/icons/dashboard.png" alt="Dashboard" /> Dashboard
                    </a>
                  </li>
                  <li>
                    <a href="investment.html">
                      <img src="assets/images/icons/investments.png" alt="Investments" />
                      Investments
                    </a>
                  </li>
                  <li>
                    <a href="transaction.html">
                      <img src="assets/images/icons/transactions.png" alt="Transactions" />
                      Transactions
                    </a>
                  </li>
                  <li>
                    <a href="withdraw.html">
                      <img src="assets/images/icons/withdraw.png" alt="Withdraw" /> Withdraw
                    </a>
                  </li>
                  <li>
                    <a href="account.html" class="sidenav__active">
                      <img src="assets/images/icons/account.png" alt="Account" /> Account
                    </a>
                  </li>
                </ul>
                <hr />
                <ul class="logout">
                  <li>
                    <a href="login.html">
                      <img src="assets/images/icons/logout.png" alt="Logout" /> Logout
                    </a>
                  </li>
                </ul>
              </div>
              <div class="sidenav__wrapper sidenav__footer">
                <h6>Last Login</h6>
                <hr />
                <div class="sidenav__time">
                  <p class="secondary"><img src="assets/images/icons/calendar.png" alt="Calendar" />
                    02.01.2022</p>
                  <p class="secondary">15:48:13</p>
                </div>
              </div>
            </div>
          </div-->
          <DashboardSideNavSection v-model:sideState="isOpen" />
          <div class="col-xxl-9">
            <div class="main__content">
              <div class="collapse__sidebar">
                <h4>Dashboard</h4>
                <a
                  href="javascript:void(0)"
                  class="collapse__sidebar__btn"
                  @click="isOpen = !isOpen">
                  <i class="fa-solid fa-bars-staggered"></i>
                </a>
              </div>
              <div class="main__content-dashboard">
                <div class="breadcrumb-dashboard">
                  <h5>Account</h5>
                  <div>
                    <a href="/">Home</a>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <a href="javascript:void(0)">Account</a>
                  </div>
                </div>
                <!-- <div class="account-info"> -->
                <n-card>
                  <n-tabs
                    class="card-tabs"
                    default-value="general"
                    size="large"
                    animated
                    pane-wrapper-style="margin: 0 -4px"
                    pane-style="padding-left: 4px; padding-right: 4px; box-sizing: border-box; border-radius:5px;">
                    <!--div class="account-info__btn-wrapper">
                        <a href="#general"
                          class="account-info__btn account-info__btn-active button button--effect">General</a>
                        <a href="#billing" class="account-info__btn button button--effect">Billing</a>
                        <a href="#security" class="account-info__btn button button--effect">Security</a>
                      </div-->

                    <!-- <div class="account-content_wrapper"> -->
                    <n-tab-pane name="general" tab="General">
                      <div class="account-content" id="general">
                        <div class="avatar-wrapper">
                          <div class="avatar-content">
                            <div class="avatar">
                              <img
                                src="/assets/images/team/ryan.png"
                                alt="Avatar" />
                            </div>
                            <div class="avatar-content__guideline">
                              <h6>Your Avatar</h6>
                              <p>Profile picture size: 400px x 400px</p>
                            </div>
                          </div>
                          <form action="#" method="post">
                            <input
                              type="file"
                              name="avatar_upload"
                              id="avatarUpload" />
                            <label for="avatarUpload">
                              Upload new avatar
                            </label>
                          </form>
                        </div>
                        <form
                          action="#"
                          name="save__from"
                          method="post"
                          class="save__form">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="input input--secondary">
                                <label for="saveFirstName">First Name</label>
                                <input
                                  type="text"
                                  name="save__first__name"
                                  id="saveFirstName"
                                  placeholder="First Name"
                                  required="required" />
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="input input--secondary">
                                <label for="saveLastName">Last Name</label>
                                <input
                                  type="text"
                                  name="save__last__name"
                                  id="saveLastName"
                                  placeholder="Last Name"
                                  required="required" />
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="input input--secondary">
                                <label for="saveEmail">Email</label>
                                <input
                                  type="email"
                                  name="save_email"
                                  id="saveEmail"
                                  placeholder="Enter Your Email"
                                  required="required" />
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="input input--secondary">
                                <label for="savePhone">Phone</label>
                                <input
                                  type="number"
                                  name="save_phone"
                                  id="savePhone"
                                  placeholder="345-323-1234"
                                  required="required" />
                              </div>
                            </div>
                          </div>
                          <div>
                            <button type="submit" class="button button--effect">
                              Save Changes
                            </button>
                          </div>
                        </form>
                        <div class="account-content-single">
                          <div class="intro">
                            <h5>Notifications</h5>
                          </div>
                          <div class="account-content-single__inner">
                            <div class="content">
                              <h6>Announcements</h6>
                              <p>Occasional announcements of new features</p>
                            </div>
                            <div class="content-right">
                              <div class="switch-wrapper">
                                <input
                                  type="checkbox"
                                  id="announcement"
                                  checked="checked" /><label
                                  for="announcement"></label>
                              </div>
                            </div>
                          </div>
                          <div class="account-content-single__inner">
                            <div class="content">
                              <h6>Feedback requests</h6>
                              <p>Occasional requests for feedback</p>
                            </div>
                            <div class="content-right">
                              <div class="switch-wrapper">
                                <input
                                  type="checkbox"
                                  id="feedback"
                                  checked="checked" /><label
                                  for="feedback"></label>
                              </div>
                            </div>
                          </div>
                          <div class="account-content-single__inner">
                            <div class="content">
                              <h6>Billing and account</h6>
                              <p>
                                Transactional emails and account notifications
                              </p>
                            </div>
                            <div class="content-right">
                              <p>Legally Obligated</p>
                            </div>
                          </div>
                        </div>
                        <div class="delete-account">
                          <div class="delete-content">
                            <h6>Delete your account</h6>
                            <p class="secondary">
                              Before deleting your account, please note that if
                              you delete your account, Dash cannot recover it.
                            </p>
                          </div>
                          <a href="#" class="button button--effect">Delete</a>
                        </div>
                      </div>
                    </n-tab-pane>
                    <n-tab-pane name="billing" tab="Billing">
                      <div class="account-content" id="billing">
                        <div class="account-content-single mt-0">
                          <div class="intro">
                            <h5>Payment Methods</h5>
                            <a href="#">Add Method</a>
                          </div>
                          <div class="account-content-single__inner">
                            <div class="content content-alt">
                              <img src="/assets/images/visa.png" alt="Visa" />
                              <div>
                                <h6>Visa ending in 1234</h6>
                                <p>Expires 1/2025</p>
                              </div>
                            </div>
                            <div class="content-right">
                              <p>Default</p>
                            </div>
                          </div>
                          <div class="account-content-single__inner">
                            <div class="content content-alt">
                              <img
                                src="/assets/images/mastercard.png"
                                alt="Mastercard" />
                              <div>
                                <h6>Mastercard ending in 1234</h6>
                                <p>Expires 1/2025</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="investment-table">
                          <div class="intro">
                            <h5>Invoices</h5>
                          </div>
                          <div class="table-wrapper">
                            <table>
                              <tr>
                                <th>INVOICE ID</th>
                                <th>AMOUNT</th>
                                <th>DATE</th>
                                <th>STATUS</th>
                              </tr>
                              <tr>
                                <td>Invoice #123</td>
                                <td>$500.00</td>
                                <td>18.03.2022</td>
                                <td><span class="process"></span>Processing</td>
                              </tr>
                              <tr>
                                <td>Invoice #123</td>
                                <td>$500.00</td>
                                <td>18.03.2022</td>
                                <td><span class="paid"></span>Paid</td>
                              </tr>
                              <tr>
                                <td>Invoice #123</td>
                                <td>$500.00</td>
                                <td>18.03.2022</td>
                                <td><span class="paid"></span>Paid</td>
                              </tr>
                              <tr>
                                <td>Invoice #123</td>
                                <td>$500.00</td>
                                <td>18.03.2022</td>
                                <td><span class="paid"></span>Paid</td>
                              </tr>
                              <tr>
                                <td>Invoice #123</td>
                                <td>$500.00</td>
                                <td>18.03.2022</td>
                                <td><span class="paid"></span>Paid</td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                    </n-tab-pane>
                    <n-tab-pane name="security" tab="Security">
                      <div class="account-content" id="security">
                        <div class="two-factor-wrapper">
                          <div class="two-factor-content">
                            <h6>Two Factor Authentication</h6>
                            <p>
                              Two-Factor Authentication (2FA) can be used to
                              help protect your account
                            </p>
                          </div>
                          <a href="#" class="button button--effect">Enable</a>
                        </div>
                        <div class="change__pass">
                          <div class="row neutral-row">
                            <div class="col-md-6">
                              <div class="change__pass-content column__space">
                                <h5>Change Password</h5>
                                <p>
                                  You can always change your password for
                                  security reasons or reset your password in
                                  case you forgot it.
                                </p>
                                <a href="#" class="button button--effect"
                                  >Forgot Password?</a
                                >
                              </div>
                            </div>
                            <div class="col-md-6">
                              <form
                                action="#"
                                name="change__pass"
                                method="post">
                                <div class="input input--secondary">
                                  <label for="currentPass"
                                    >Current Password</label
                                  >
                                  <input
                                    type="password"
                                    name="current_pass"
                                    id="currentPass"
                                    placeholder="Current Password"
                                    required="required" />
                                </div>
                                <div class="input input--secondary">
                                  <label for="newPass">New Password</label>
                                  <input
                                    type="password"
                                    name="new_pass"
                                    id="newPass"
                                    placeholder="New Password"
                                    required="required" />
                                </div>
                                <div class="input input--secondary">
                                  <label for="conNewPass"
                                    >Confirm New Password</label
                                  >
                                  <input
                                    type="password"
                                    name="con_new_pass"
                                    id="conNewPass"
                                    placeholder="Confirm Password"
                                    required="required" />
                                </div>
                                <div>
                                  <button
                                    type="submit"
                                    class="button button--effect">
                                    Update Password
                                  </button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <div
                          class="account-content-single account-content-single__alt">
                          <div class="intro">
                            <h5>Additional Security</h5>
                            <a href="#">Add Method</a>
                          </div>
                          <div class="account-content-single__inner">
                            <div class="content">
                              <h6>SMS recovery</h6>
                              <p>Number ending with 1234</p>
                            </div>
                            <div class="content-right">
                              <a href="#" class="button button--effect"
                                >Disable SMS</a
                              >
                            </div>
                          </div>
                          <div class="account-content-single__inner">
                            <div class="content">
                              <h6>Autheticator App</h6>
                              <p>Google Authenticator</p>
                            </div>
                            <div class="content-right">
                              <a href="#" class="button button--effect alt"
                                >Configure</a
                              >
                            </div>
                          </div>
                          <div class="account-content-single__inner">
                            <div class="content">
                              <h6>SSL Certificate</h6>
                              <p>Secure Sockets Layer</p>
                            </div>
                            <div class="content-right">
                              <a href="#" class="button button--effect alt"
                                >Configure</a
                              >
                            </div>
                          </div>
                        </div>
                        <div
                          class="account-content-single account-content-single__alt">
                          <div class="intro">
                            <h5>Your devices</h5>
                            <a href="#">Log out on all devices</a>
                          </div>
                          <div
                            class="account-content-single__inner account-content-single__inner-alt">
                            <div class="content">
                              <img
                                src="/assets/images/icons/mobile.png"
                                alt="Mobile" />
                              <div class="content__alt">
                                <h6>Iphone 13 Pro Max</h6>
                                <p>New York City · June 20 at 14:00</p>
                              </div>
                            </div>
                            <div class="content-right">
                              <a
                                href="login.html"
                                class="button button--effect alt"
                                >Log Out</a
                              >
                            </div>
                          </div>
                          <div
                            class="account-content-single__inner account-content-single__inner-alt">
                            <div class="content">
                              <img
                                src="/assets/images/icons/tablet.png"
                                alt="Tablet" />
                              <div class="content__alt">
                                <h6>iPad Pro</h6>
                                <p>New York City · June 20 at 14:00</p>
                              </div>
                            </div>
                            <div class="content-right">
                              <a href="/login" class="button button--effect alt"
                                >Log Out</a
                              >
                            </div>
                          </div>
                          <div
                            class="account-content-single__inner account-content-single__inner-alt">
                            <div class="content">
                              <img
                                src="/assets/images/icons/desktop.png"
                                alt="Desktop" />
                              <div class="content__alt">
                                <h6>iMac OSX</h6>
                                <p>New York City · June 20 at 14:00</p>
                              </div>
                            </div>
                            <div class="content-right">
                              <a href="/login" class="button button--effect alt"
                                >Log Out</a
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                    </n-tab-pane>
                    <!-- </div> -->
                  </n-tabs>
                </n-card>
                <!-- </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--div>
    <n-card>
      <n-tabs class="card-tabs" default-value="signin" size="large" animated pane-wrapper-style="margin: 0 -4px"
        pane-style="padding-left: 4px; padding-right: 4px; box-sizing: border-box;">
        <n-tab-pane name="signin" tab="Sign in">
          <n-form>
            <n-form-item-row label="Username">
              <n-input />
            </n-form-item-row>
            <n-form-item-row label="Password">
              <n-input />
            </n-form-item-row>
          </n-form>
          <n-button type="primary" block secondary strong>
            Sign In
          </n-button>
        </n-tab-pane>
        <n-tab-pane name="signup" tab="Sign up">
          <n-form>
            <n-form-item-row label="Username">
              <n-input />
            </n-form-item-row>
            <n-form-item-row label="Password">
              <n-input />
            </n-form-item-row>
            <n-form-item-row label="Reenter Password">
              <n-input />
            </n-form-item-row>
          </n-form>
          <n-button type="primary" block secondary strong>
            Sign up
          </n-button>
        </n-tab-pane>
      </n-tabs>
    </n-card>
  </div-->
</template>
<style scoped>
  .card-tabs .n-tabs-nav--bar-type {
    padding-left: 4px;
  }

  tabs.n-tabs--bar-type .n-tabs-tab.n-tabs-tab--active {
    /* color: var(--n-tab-text-color-active);
    font-weight: var(--n-tab-font-weight-active); */
    background-color: #5927e3;
    color: #ffffff;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 10px;
    padding-bottom: 10px;
    border-radius: 5px;
  }

  div.n-tabs-tab {
    background-color: #5927e3;
    color: #ffffff;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 10px;
    padding-bottom: 10px;
    border-radius: 5px;
  }
</style>
