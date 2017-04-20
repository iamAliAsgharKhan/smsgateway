<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Settings
        </div>

        <div class="panel-body">
            <form @submit.prevent="update" action="/setting" method="post">
                <div class="form-group">
                    <label class="control-label">Application Name</label>
                    <input v-model="state.app.name" type="text" class="form-control">
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
                state: {
                    app: {
                        name: ''
                    }
                }
            }
        },

        mounted() {
            axios.get('/setting/all').then(response => {
                // this.state = response.data;
            });
        },

        methods: {
            update(e) {
                axios.put(e.target.action, this.state).then(response => {

                }).catch(error => {

                });
            }
        }
    }
</script>
