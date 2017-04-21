<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Reply Message
        </div>

        <form @submit.prevent="reply" class="" action="/message/reply" method="post">
            <div class="panel-body">

                <div v-if="message" class="well">
                    <strong>{{ message.sender }}</strong>
                    <hr>
                    {{ message.content }}
                </div>

                <div :class="['form-group', errors.receipent ? 'has-error' : null]">
                    <label class="control-label">To</label>
                    <input disabled="true" v-model="state.receipent" type="text" class="form-control">
                    <span v-if="errors.receipent" class="label label-danger">{{ errors.receipent[0] }}</span>
                </div>

                <div :class="['form-group', errors.content ? 'has-error' : null]">
                    <label class="control-label">Message</label>
                    <textarea v-model="state.content" rows="8" cols="80" class="form-control"></textarea>
                    <span v-if="errors.content" class="label label-danger">{{ errors.content[0] }}</span>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" name="send" class="btn btn-primary">
                    Reply Message
                </button>
                <router-link :to="{ name: 'message.index' }" class="btn btn-default">
                    Back
                </router-link>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'MessageReply',
        data() {
            return {
                alert: {},
                errors: [],
                message: {},
                state: {
                    messageId: '',
                    receipent: '',
                    content: ''
                }
            }
        },

        mounted() {
            // get inbox message
            const params = {
                id: this.$route.params.id
            }
            axios.get('/message/view/reply', {params}).then(response => {
                this.state.messageId = response.data.message.id;
                this.state.receipent = response.data.message.sender;

                this.message = response.data.message;
            }).catch(error => {
                if (! _.isEmpty(error)){
                    if (error.response.status == 404) {
                        this.alert = {
                            type: 'danger',
                            message: 'Message not found.'
                        }
                    }
                }
            });
        },

        methods: {
            reply(e) {
                this.$Progress.start();

                axios.post(e.target.action, this.state).then(response => {
                    if (response.data.status == true) {
                        this.errors = [];
                        this.state = {
                            receipent: '',
                            content: ''
                        }
                    }
                    this.$Progress.finish();
                }).catch(error => {
                    if (! _.isEmpty(error)) {
                        if (error.response.status == 422) {
                            this.errors = error.response.data;
                        }
                    }
                    this.$Progress.fail();
                })
            }
        }
    }
</script>
