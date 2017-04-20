<template>
    <ul v-if="data.prev_page_url || data.next_page_url" class="pagination">
        <li v-if="data.prev_page_url">
            <a @click.prevent="pagination(data.prev_page_url)" :href="data.prev_page_url">&laquo; Previous</a>
        </li>
        <li v-if="data.next_page_url">
            <a @click.prevent="pagination(data.next_page_url)" :href="data.next_page_url">Next &raquo;</a>
        </li>
    </ul>
</template>

<script>
    export default {
        name: 'Pagination',
        props: {
            data: {}
        },

        methods: {
            pagination(url) {
                this.$bus.$emit('pagination', url);
            }
        }
    }
</script>
