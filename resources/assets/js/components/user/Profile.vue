<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Profile
        </div>

        <form @submit.prevent="update" action="/user/profile" method="post">
            <div class="panel-body">
                <div :class="['form-group', errors.name ? 'has-error' : null]">
                    <label class="control-label">Name</label>
                    <input v-model="state.name" type="text" class="form-control">
                    <span v-if="errors.name" class="label label-danger">{{ errors.name[0] }}</span>
                </div>

                <div :class="['form-group', errors.email ? 'has-error' : null]">
                    <label class="control-label">E-mail Address</label>
                    <input v-model="state.email" type="email" class="form-control">
                    <span v-if="errors.email" class="label label-danger">{{ errors.email[0] }}</span>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" name="update" class="btn btn-primary">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'UserProfile',
        data() {
            return {
                errors: [],
                state: {
                    name: this.$root.user.data.name,
                    email: this.$root.user.data.email
                }
            }
        },

        methods: {
            update(e) {
                axios.put(e.target.action, this.state).then(response => {
                    if (response.data.status == true) {
                        this.errors = [];
                        this.$root.user.data.name = this.state.name;

                        this.state = {
                            name: response.data.user.name,
                            email: response.data.user.email
                        }
                    }
                }).catch(error => {
                    if (! _.isEmpty(error)) {
                        if (error.response.status == 422) {
                            this.errors = error.response.data;
                        }
                    }
                });
            }
        }
    }
</script>
