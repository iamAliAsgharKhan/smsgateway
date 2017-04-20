<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Change Password
        </div>

        <form @submit.prevent="change" action="/user/password" method="post">
            <div class="panel-body">
                <div :class="['form-group', errors.currentPassword ? 'has-error' : null]">
                    <label class="control-label">Current Password</label>
                    <input v-model="state.currentPassword" type="password" class="form-control">
                    <span v-if="errors.currentPassword" class="label label-danger">{{ errors.currentPassword[0] }}</span>
                </div>

                <div :class="['form-group', errors.password ? 'has-error' : null]">
                    <label class="control-label">Password</label>
                    <input v-model="state.password" type="password" class="form-control">
                    <span v-if="errors.password" class="label label-danger">{{ errors.password[0] }}</span>
                </div>

                <div :class="['form-group', errors.confirmPassword ? 'has-error' : null]">
                    <label class="control-label">Confirm Password</label>
                    <input v-model="state.confirmPassword" type="password" class="form-control">
                    <span v-if="errors.confirmPassword" class="label label-danger">{{ errors.confirmPassword[0] }}</span>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" name="change" class="btn btn-primary">
                    Change Password
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'UserPassword',
        data() {
            return {
                errors: [],
                state: {
                    currentPassword: '',
                    password: '',
                    confirmPassword: ''
                }
            }
        },

        methods: {
            change(e) {
                this.$Progress.start();

                axios.put(e.target.action, this.state).then(response => {
                    if (response.data.status == true) {
                        this.errors = [];
                        this.state = {
                            currentPassword: '',
                            password: '',
                            confirmPassword: ''
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
