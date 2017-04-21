<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Send New Message
        </div>

        <div class="panel-body">
            <form @submit.prevent="send" class="" action="/message/send" method="post">
                <div :class="['form-group', errors.receipent ? 'has-error' : null]">
                    <label class="control-label">To</label>
                    <input v-model="state.receipent" type="text" class="form-control">
                    <span v-if="errors.receipent" class="label label-danger">{{ errors.receipent[0] }}</span>
                </div>

                <div :class="['form-group', errors.content ? 'has-error' : null]">
                    <label class="control-label">Message</label>
                    <textarea v-model="state.content" rows="8" cols="80" class="form-control"></textarea>
                    <span v-if="errors.content" class="label label-danger">{{ errors.content[0] }}</span>
                </div>

                <div class="form-group">
                    <button type="submit" name="send" class="btn btn-primary">
                        Send Message
                    </button>
                    <router-link :to="{ name: 'message.index' }" class="btn btn-default">
                        Back
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'MessageSend',
        data() {
            return {
                errors: [],
                state: {
                    receipent: '',
                    content: ''
                }
            }
        },

        methods: {
            send(e) {
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
