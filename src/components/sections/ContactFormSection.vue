<script setup>
  // section: ContactFormSection

  const { t } = useI18n()
  const { sendEmail } = useMailing()
  const { getUniqueWidgetData, getDuplicableWidgetsData } = useWidget()
  const { websiteInfo, websiteOwnerInfo } = useInfo()
  const { tr, res } = useGlobal()

  // Get unique widget
  const uniqueWidget = getUniqueWidgetData('contact_section')

  // Get duplicable widgets
  const duplicableWidgets = getDuplicableWidgetsData('wid_2')

  const formData = ref({
    firstname: '',
    lastname: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
  })
  let load = ref(false)

  const submit = async () => {
    load.value = true
    if (
      formData.value.firstname &&
      formData.value.lastname &&
      formData.value.email &&
      formData.value.message
    ) {
      if (formData.value.email && !_v.isEmail(formData.value.email)) {
        console.log('Adresse mail invalid')
        load.value = false
        return false
      }

      console.log('Soyez patient')
      if (load.value) {
        afficherMessage("Message en cours d'envoie", 9000000)
      }
      const content = `
        <div>
          <b>Nom</b> : ${formData.value.firstname} <br>
          <b>Prenoms</b> : ${formData.value.laststname} <br>
          <b>Email</b> : ${formData.value.email} <br>
          <b>Phone</b> : ${formData.value.phone} <br>
          <b>Subject</b> : ${formData.value.subject} <br>
          <b>Message</b> : <p>${formData.value.message}</p><br>
        </div>`

      try {
        const result = await sendEmail(
          formData.value.email,
          'Formulaire de contact',
          'Nouveau message',
          content,
          websiteOwnerInfo.value?.email
        )

        if (result) {
          console.log('Nous avons reçue votre message')
          formData.value = {
            firstname: '',
            lastname: '',
            email: '',
            phone: '',
            subject: '',
            message: '',
          }
          afficherMessage('Message envoyé', 5000)
        } else {
          console.log("Rencontre d'une erreur")
          load.value = false
          afficherMessage("Rencontre d'une erreur", 5000)
        }
      } catch (error) {
        console.log({ error })
      }
    } else {
      console.log('Remplissez les champs')
      load.value = false
      afficherMessage('Remplissez les champs', 5000)
    }
    load.value = false
  }
  function afficherMessage(message, duree) {
    const button = document.getElementById('contact_btn')
    const small = button.querySelector('small')

    small.innerHTML = message

    setTimeout(function () {
      small.innerHTML = ''
    }, duree)
  }
</script>

<template>
  <section
    class="ask section__space bg__img"
    :style="`background:url('/assets/images/ask-bge.png'); top`">
    <div class="container">
      <div class="ask__area">
        <div class="alert__newsletter__area">
          <div class="section__header">
            <h2 class="neutral-top">{{ tr(uniqueWidget?.form_title) }}</h2>
          </div>
          <form action="" name="ask__from" method="post">
            <div class="row">
              <div class="col-sm-6">
                <div class="input input--secondary">
                  <label for="askFirstName">{{ t('First Name') }}*</label>
                  <input
                    v-model="formData.firstname"
                    type="text"
                    name="ask__first__name"
                    id="askFirstName"
                    :placeholder="t('Enter Your First Name')"
                    required="required" />
                </div>
              </div>
              <div class="col-sm-6">
                <div class="input input--secondary">
                  <label for="askLastName">{{ t('Last Name') }}*</label>
                  <input
                    v-model="formData.lastname"
                    type="text"
                    name="ask__last__name"
                    id="askLastName"
                    :placeholder="t('Enter Your Last Name')"
                    required="required" />
                </div>
              </div>
            </div>
            <div class="input input--secondary">
              <label for="askRegistrationMail">Email*</label>
              <input
                v-model="formData.email"
                type="email"
                name="ask__registration__email"
                id="askRegistrationMail"
                :placeholder="t('Enter your email')"
                required="required" />
            </div>
            <div class="input input--secondary input__alt">
              <label for="askNumber">{{ t('Phone') }}*</label>
              <div class="input-group">
                <!--div class="input-group-prepend">
                                    <select class="number__code__select" id="numberCodeSelectAlert">
                                        <option selected value="0">+1</option>
                                        <option value="1">+2</option>
                                        <option value="2">+3</option>
                                        <option value="3">+4</option>
                                        <option value="4">+5</option>
                                        <option value="5">+6</option>
                                    </select>
                                </div-->
                <input
                  v-model="formData.phone"
                  type="text"
                  name="ask__number"
                  id="askNumber"
                  required="required"
                  placeholder="345-323-1234" />
              </div>
            </div>
            <div class="input input--secondary">
              <label for="askSubject">{{ t('Subject') }}*</label>
              <input
                v-model="formData.subject"
                type="text"
                name="ask__subject"
                id="askSubject"
                :placeholder="t('Write Subject')"
                required="required" />
            </div>
            <div class="input input--secondary">
              <label for="askMessage">Message*</label>
              <textarea
                v-model="formData.message"
                name="ask_message"
                id="askMessage"
                required="required"
                :placeholder="t('Write Message')"></textarea>
            </div>
            <div class="input__button" id="contact_btn">
              <small style="color: rgb(212, 9, 9)"></small>
              <button
                type="submit"
                class="button button--effect"
                @click.prevent="submit">
                {{ t('Send') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>
<style scoped>
  .input__alt .input-group .nice-select .current::before {
    content: '';
    width: 30px;
    height: 16px;
    background-image: url('/assets/images/flag.png');
    background-size: cover;
    margin-right: 10px;
    color: #434e9e80;
  }
</style>
