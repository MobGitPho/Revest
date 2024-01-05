import {
  SEND_EMAIL_API_BASE_URL,
  SMTP_USERNAME,
  SMTP_PASSWORD,
  API_REQUEST_HEADERS,
} from '@/utils/constants'

export function useMailing() {
  const { websiteInfo, websiteMoreInfo, websiteOwnerInfo } = useInfo()
  const { tr } = useGlobal()

  const emailApiData = {
    smtp_username: SMTP_USERNAME,
    smtp_password: SMTP_PASSWORD,
  }

  const sendEmail = async (
    from,
    title,
    subject,
    content,
    recipients,
    { template = 'basic', files = [] } = {}
  ) => {
    emailApiData.template = template
    emailApiData.fromName = tr(websiteInfo.title)
    emailApiData.copyright_text = tr(websiteInfo.title)
    emailApiData.copyright_link = websiteMoreInfo.websiteUrl

    emailApiData.recipients = recipients || websiteOwnerInfo.email
    emailApiData.content = content
    emailApiData.subject = subject
    emailApiData.title = title
    emailApiData.from = from

    emailApiData.files = files

    try {
      let response = await axios.request({
        method: 'post',
        baseURL: SEND_EMAIL_API_BASE_URL,
        url: '/',
        data: emailApiData,
        headers: API_REQUEST_HEADERS,
      })

      return response.data
    } catch (error) {
      if (import.meta.env.DEV) {
        if (error.response) {
          console.log(error.response.data)
          console.log(error.response.status)
          console.log(error.response.headers)
        } else if (error.request) {
          console.log(error.request)
        } else {
          console.log('Error', error.message)
        }

        console.log(error.config)
      }
    }

    return false
  }

  return {
    emailApiData,
    sendEmail,
  }
}
