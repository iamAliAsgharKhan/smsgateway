<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ user.name }}
        </div>

        <div class="panel-body">

        </div>
    </div>
</template>

<script>
    export default {
        name: 'UserView',
        data() {
            return {
                user: {}
            }
        },

        mounted() {
            const params = {
                id: this.$route.params.id
            }
            axios.get('/user/view', {params}).then(response => {
                this.user = response.data.user;
            });
        }
    }
</script>
