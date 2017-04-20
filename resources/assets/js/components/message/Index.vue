<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Messages
        </div>

        <div class="panel-body">
            <div v-if="! this.$root.user.auth" class="alert alert-warning">
                You dont have permissions to access this content.
            </div>

            <p>
                <router-link :to="{ name: 'message.send' }" class="btn btn-primary">
                    Send Message
                </router-link>
            </p>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>From</th>
                            <th>Receipent</th>
                            <th>Message</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(message, index) in messages.data">
                            <td>{{ message.created_at }}</td>
                            <td v-if="message.sender">{{ message.sender }}</td>
                            <td v-else><span class="label label-info">You!</span></td>
                            <td>{{ message.receipent }}</td>
                            <td>{{ message.content }}</td>
                            <td>{{ message.type }}</td>
                            <td>{{ message.status }}</td>
                            <td class="text-right">
                                <router-link v-if="message.type == 'inbox'" :to="message.id | replyUrl" class="btn btn-info btn-xs">
                                    <i class="glyphicon glyphicon-send"></i>
                                </router-link>
                                <button-delete></button-delete>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <pagination :data="messages"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'MessageIndex',
        data() {
            return {
                url: '/message/paginate',
                messages: []
            }
        },

        mounted() {
            this.paginate(this.url);
        },

        methods: {
            paginate(url, params = {}) {
                axios.get(url, {params}).then(response => {
                    this.messages = response.data;
                }).catch(error => {

                });
            }
        },

        filters: {
            replyUrl(id) {
                return {
                    name: 'message.reply',
                    params: {
                        id: id
                    }
                }
            }
        }
    }
</script>
