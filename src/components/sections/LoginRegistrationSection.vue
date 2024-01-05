<script setup>
  // section: LoginRegistrationSection

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
    <section class="registration clear__top">
            <div class="container">
                <div class="registration__area">
                    <h4 class="neutral-top">Log in</h4>
                    <p>Don't have an account? <a href="registration.html">Register here.</a></p>
                    <form action="#" method="post" name="login__form" class="form__login">
                        <div class="input input--secondary">
                            <label for="loginMail">Email*</label>
                            <input type="email" name="login__email" id="loginMail" placeholder="Enter your email"
                                required="required" />
                        </div>
                        <div class="input input--secondary">
                            <label for="loginPass">Password*</label>
                            <input type="password" name="login__pass" id="loginPass" placeholder="Password"
                                required="required" />
                        </div>
                        <div class="checkbox login__checkbox">
                            <label>
                                <input type="checkbox" id="remeberPass" name="remeber__pass" value="remember" />
                                <span class="checkmark"></span>
                                Remember Me
                            </label>
                            <a href="javascript:void(0)">Forget Password</a>
                        </div>
                        <div class="input__button">
                            <button type="submit" class="button button--effect">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
  </section>
</template>