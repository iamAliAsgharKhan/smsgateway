<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span v-if="this.$route.query.number">Save {{ this.$route.query.number }}</span>
            <span v-else>Create New Contact</span>
        </div>

        <form @submit.prevent="store" action="/contact/store" method="post">
            <div class="panel-body">
                <div :class="['form-group', errors.name ? 'has-error' : '']">
                    <label class="control-label">Name</label>
                    <input v-model="state.name" type="text" class="form-control">
                    <span v-if="errors.name" class="label label-danger">{{ errors.name[0] }}</span>
                </div>

                <div :class="['form-group', errors.number ? 'has-error' : '']">
                    <label class="control-label">Number</label>
                    <input v-model="state.number" type="text" class="form-control">
                    <span v-if="errors.number" class="label label-danger">{{ errors.number[0] }}</span>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" name="save" class="btn btn-primary">
                    Save Contact
                </button>
                <router-link :to="{ name: 'contact.index'}" class="btn btn-default">
                    Back
                </router-link>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'ContactCreate',
        data() {
            return {
                errors: [],
                state: {
                    name: '',
                    number: ''
                }
            }
        },

        mounted() {
            if (this.$route.query.number) {
                this.state.number = this.$route.query.number;
            }
        },

        methods: {
            store(e) {
                this.$Progress.start();

                axios.post(e.target.action, this.state).then(response => {
                    if (response.data.status == true) {
                        this.errors = [];
                        this.state = {
                            name: '',
                            number: ''
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
