<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Settings
        </div>

        <div class="panel-body">
            <form @submit.prevent="update" action="/setting" method="post">
                <div :class="['form-group', errors.name ? 'has-error' : null]">
                    <label class="control-label">Application Name</label>
                    <input v-model="state.name" type="text" class="form-control">
                    <span v-if="errors.name" class="label label-danger">{{ errors.name[0] }}</span>
                </div>

                <div class="form-group">
                    <button type="submit" name="update" class="btn btn-primary">
                        Update Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Setting',
        data() {
            return {
                errors: [],
                state: {
                    name: ''
                }
            }
        },

        mounted() {
            axios.get('/setting/all').then(response => {
                this.state.name = response.data.name;
            });
        },

        methods: {
            update(e) {
                axios.put(e.target.action, this.state).then(response => {
                    if (response.data.success == true) {
                        this.errors = [];
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
