<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Users
        </div>

        <div class="panel-body">
            <div class="table-responsive" v-cloak>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered</th>
                            <th width="70" class="text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(user, index) in users.data">
                            <td>{{ users.from + index }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.created_at }}</td>
                            <td class="text-right">
                                <router-link :to="user.id | viewUrl" class="btn btn-xs btn-info">
                                    <i class="glyphicon glyphicon-user"></i>
                                </router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div v-if="users.total > 20" class="panel-footer">
            <pagination :data="users"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'UserIndex',
        data() {
            return {
                users: []
            }
        },

        mounted() {
            this.$Progress.finish();

            this.paginate('/user/paginate');

            // catch on pagination clicked
            this.$bus.$on('pagination', url => {
                this.paginate(url);
            });
        },

        methods: {
            paginate(url, params = {}) {
                this.$Progress.start();

                axios.get(url, {params}).then(response => {
                    this.users = response.data;
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.fail();
                });
            }
        },

        filters: {
            viewUrl(id) {
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
