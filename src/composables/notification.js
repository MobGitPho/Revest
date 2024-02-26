/*import { NotificationSources, NotificationTypes } from '@/utils/enums'

import MailingMixin from './mailing'

export default {
    mixins: [ MailingMixin ],
    data() {
        return {
            NotificationSources,
            NotificationTypes
        }
    },
    methods: {
        async addNotification(payload) {

            let users = []

            let resp = await this.request({
                action: 'select',
                table: 'user'
            })

            if (resp.success && resp.data) users = resp.data

            let data = {
                title: '',
                content: '',
                type: payload.type,
                recipients: JSON.stringify(users.map(user => user?.id)),
                received_in_app: JSON.stringify([]),
                received_in_email: JSON.stringify([]),
                removed_in_app: JSON.stringify([]),
                params: JSON.stringify(payload.params),
                triggered_by: 0,
                source: payload.source,
                target: payload.target,
                removable: payload.removable ? 1 : 0
            }

            let task = await this.request({
                action: 'insert',
                table: 'notification',
                data
            })

            if (task.success && this.enableEmailNotifications) {

                let message = this.buildMessage(data)

                users.forEach(user => {

                    if (user.email) {

                        this.sendEmail(
                            null,
                            message.title,
                            `${this.$t('notification')} - ${this.tr(this.websiteInfo.title)}`,
                            `<small>${message.content}</small>`,
                            user.email
                        )

                    }

                })

            }

            return task

        },
        buildMessage(notification) {

            let title = '', content = '', params

            try {
                params = JSON.parse(notification.params)
            }catch(e){
                params = {}
            }

            switch (parseInt(notification.type)) {

                case NotificationTypes.NEW_USER:
                    title = `${this.$t('newUserSubscribe')}`
                    content = params.username ? `${params.username}` : ''
                    break

                case NotificationTypes.NEW_REQUEST:
                    title = `${this.$t('newRequestHasBeenAdded')}`
                    content = params.username && params.country ? `${params.username} ${this.$t('from')} ${params.country}` : ''
                    break

            }

            return { title, content }

        }
    }
}*/