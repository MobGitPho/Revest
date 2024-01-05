export function useNewsletter() {
  const dbNewsletterStore = useDbNewsletterStore()

  const RegisterEmailStatus = {
    FAILED: 0,
    SUCCESS: 1,
    EXIST: 2,
    ABORTED: 3,
  }

  const registerEmail = async (email) => {
    if (!email || !_v.isEmail(email)) return RegisterEmailStatus.ABORTED

    await dbNewsletterStore.getAllEmails()

    if (dbNewsletterStore.emails.findIndex((e) => e.email == email) > -1)
      return RegisterEmailStatus.EXIST

    let task = await dbNewsletterStore.addEmail(email)

    return task.success
      ? RegisterEmailStatus.SUCCESS
      : RegisterEmailStatus.FAILED
  }

  return {
    RegisterEmailStatus,
    registerEmail,
  }
}
