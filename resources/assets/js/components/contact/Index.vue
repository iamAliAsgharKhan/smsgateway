<template>
    <div class="panel panel-info">
        <div class="panel-heading">
            Contacts
        </div>

        <div class="panel-body">
            <div v-if="! this.$root.user.auth" class="alert alert-warning">
                You dont have permissions to access this content.
            </div>

            <p>
                <router-link :to="{ name: 'contact.create' }" class="btn btn-primary">
                    Create New Contact
                </router-link>
            </p>

            <div v-if="contacts.total <= 0" class="alert alert-info">
                No contacts available at this time.
            </div>
            <div v-else class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(contact, index) in contacts.data">
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="glyphicon glyphicon-cog"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>{{ contacts.from + index }}</td>
                            <td>{{ contact.name }}</td>
                            <td>{{ contact.number }}</td>
                            <td>{{ contact.created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div v-if="contacts.total >= 20" class="panel-footer">
            <pagination :data="contacts"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ContactIndex',
        data() {
            return {
                contacts: []
            }
        },

        mounted() {
            this.paginate('/contact/paginate');
        },

        methods: {
            paginate(url, params = {}) {
                this.$Progress.start();

                axios.get(url, {params}).then(response => {
                    this.contacts = response.data;

                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.fail();
                })
            }
        }
    }
</script>
