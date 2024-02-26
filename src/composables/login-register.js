import { ref } from 'vue'
import { useDbSubscriptionStore, SUBSCRIPTION_CONTEXT } from '@/stores/database/subscription'
// import { useSessionStore } from '@/stores/session'
import { useAuthStore } from '@/stores/auth'

import { AccountStatus, AccountAuthStatus } from '@/utils/enums'
import { getRandomInteger } from '@/utils/functions'
import { v4 as uuidv4 } from 'uuid'
// import sanitizer from 'string-sanitizer'
import { uniqueId } from 'lodash'
import { useGlobalStore } from '../stores/global'
import { isEmail } from 'validator'
import { format } from 'date-fns'
import { fr } from 'date-fns/locale'

// import { Locale } from 'vue-i18n'

export default function useLoginRegister() {
    const { getAllAccounts } = useDbSubscriptionStore()
    // const { updateUserData, updateConnected, updateRememberMe } = useSessionStore()
    const { setUserData, logOut, updateUserData } = useAuthStore()
    const { addItemInDB, updateItemInDB } = useGlobalStore()


    const accounts = ref([])

    async function genUid(uidSrc, addSalt) {
        // var uid = sanitizer.sanitize(uidSrc.toLowerCase()).substring(0, 10)
        var uid = uidSrc.toLowerCase().substring(0, 10)

        if (addSalt) uid += uniqueId('revest')

        if (!accounts.value.find(a => a.uid == uid)) return uid
        else return await genUid(uidSrc, true)
    }

    async function registerAccount(account) {
        let lastfirstname = account.name + account.firstname
        //let uid = await genUid(account.name, false)
        let uid = await genUid(lastfirstname, false)
        let authCode = getRandomInteger(1000, 9999)

        let task = await addItemInDB({
            context: SUBSCRIPTION_CONTEXT,
            data: {
                uid: uid,
                name: account.name + ' ' + account.firstname,
                email: account.email?.toLowerCase(),
                phone: account.phone || '',
                status: AccountStatus.ENABLED,
                auth_status: AccountAuthStatus.NOT_COMPLETED,
                auth_code: authCode,
                hash_id: uuidv4(),
                password: account.password,
                data: JSON.stringify([])
            }
        })


        await getAllAccounts()


        return false
    }

    async function logAccount(credentials) {
        accounts.value = await getAllAccounts()

        // console.log({accounts: accounts.value})

        let account = null

        if (isEmail(credentials.email.toLowerCase())) {
            account = accounts.value.data.find(a => a.email.toLowerCase() == credentials.email.toLowerCase())
        } else {
            account = accounts.value.find(a => a.email.toLowerCase() == credentials.email.toLowerCase())
        }

        if (account && account.password == credentials.password) return account

        return false
    }

    async function storeAccountData(account) {
        if (account.status == AccountStatus.ENABLED) {
            // updateConnected(true)
            // updateRememberMe(true)
            // updateUserData(account)
            setUserData(account)

            await updateItemInDB({
                context: SUBSCRIPTION_CONTEXT,
                id: account.id,
                data: {
                    last_login: format(new Date(), 'yyyy-MM-dd hh:mm:ss', { locale: fr })
                }
            })

            // Handle redirection here if needed
        } else {
            // Handle disabled account
        }
    }

    async function updateAccountData(id, data) {
        await updateItemInDB({
            context: SUBSCRIPTION_CONTEXT, id, data
        })

        await getAllAccounts()

        updateUserData(accounts.value.find(a => a.id == id))
    }

    return {
        accounts,
        genUid,
        registerAccount,
        logAccount,
        storeAccountData,
        updateAccountData
    }
}