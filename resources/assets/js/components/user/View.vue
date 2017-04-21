<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span v-if="alert.type == 'danger'">
                No User
            </span>
            <span v-else>
                {{ user.name }}
            </span>
        </div>

        <div class="panel-body">
            <div v-if="alert.type == 'danger'" :class="['alert alert-' + alert.type]">
                {{ alert.message }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'UserView',
        data() {
            return {
                alert: {},
                user: {}
            }
        },

        mounted() {
            const params = {
                id: this.$route.params.id
            }
            axios.get('/user/view', {params}).then(response => {
                if (response.data.status == true) {
                    this.user = response.data.user;
                    this.alert = {};
                }
            }).catch(error => {
                if (! _.isEmpty(error)) {
                    if (error.response.status == 404)  {
                        // user not found in database
                        this.alert = {
                            type: 'danger',
                            message: 'User not found in database.'
                        }
                    }
                }
            });
        }
    }
</script>
