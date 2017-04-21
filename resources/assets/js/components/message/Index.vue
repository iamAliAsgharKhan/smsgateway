<template>
    <div class="panel panel-info">
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
                <div v-if="messages.total <= 0" class="alert alert-info" v-cloak>
                    No incoming or outgoing messages right now.
                </div>
                <table v-else class="table table-bordered table-striped" v-cloak>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>From</th>
                            <th>Receipent</th>
                            <th width="500">Message</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(message, index) in messages.data">
                        <td class="text-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="glyphicon glyphicon-cog"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <router-link :to="message.id | replyUrl">
                                            <i class="glyphicon glyphicon-send"></i>
                                            Reply
                                        </router-link>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="glyphicon glyphicon-comment"></i>
                                            Conversations
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        Delete Message
                                    </a></li>
                                </ul>
                            </div>
                        </td>
                            <td>{{ message.created_at }}</td>
                            <td>
                                <span v-if="message.user">
                                    <router-link :to="message.user.id | userUrl">
                                        {{ message.user.name }}
                                    </router-link>
                                </span>
                            </td>
                            <td>{{ message.sender }}</td>
                            <td>
                                <router-link v-if="message.contact" :to="{ name: 'contact.view', params: { id : message.contact.id } }">
                                    {{ message.contact.name }}
                                </router-link>
                                <router-link v-else :to="{ name: 'contact.create', query: { number : message.receipent } }">
                                    {{ message.receipent }}
                                </router-link>
                            </td>
                            <td>{{ message.content }}</td>
                            <td>{{ message.type }}</td>
                            <td>
                                <span :class="['label label-' + label[message.status]]">{{ message.status }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <div v-if="messages.total > 20" class="panel-footer">
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
                label: {
                    sent: 'success',
                    pending: 'warning',
                    read: 'success',
                    failed: 'danger',
                    unread: 'warning'
                },
                messages: []
            }
        },

        mounted() {
            this.paginate(this.url);

            // catch pagination event
            this.$bus.$on('pagination', url => {
                this.paginate(url);
            })
        },

        methods: {
            paginate(url, params = {}) {
                this.$Progress.start();

                axios.get(url, {params}).then(response => {
                    this.messages = response.data;
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.fail();
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
            },
            userUrl(id) {
                return {
                    name: 'user.view',
                    params: {
                        id: id
                    }
                }
            }
        }
    }
</script>
