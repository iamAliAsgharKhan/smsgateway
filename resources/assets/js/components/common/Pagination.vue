<template>
    <ul v-if="data.prev_page_url && data.next_page_url" class="pagination">
        <li v-if="data.prev_page_url">
            <a :href="data.prev_page_url">&laquo; Previous</a>
        </li>
        <li v-if="data.next_page_url">
            <a :href="data.next_page_url">&laquo; Next</a>
        </li>
    </ul>
</template>

<script>
    export default {
        name: 'Pagination',
        props: {
            data: {}
        }
    }
</script>
