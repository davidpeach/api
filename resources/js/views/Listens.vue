<template>
    <div class="card">
        <div class="card-header">Listens</div>

        <div class="card-body">
            <ul>
                <li v-for="listen in listens" v-text="listen.title + ' by ' + listen.artist + ' - ' + listen.date"></li>
            </ul>
        </div>

        <div class="card-footer">
            <a href="" v-if="prevLink" @click.prevent="updatePage(prevLink)">Prev</a>
            <a href="" v-if="nextLink" @click.prevent="updatePage(nextLink)">Next</a>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                listens: [],
                prevLink: null,
                nextLink: null
            }
        },

        mounted: function() {
            this.init();
            // axios.get('/api/listens?group=date_grouped').then((response) => {

            //     let dates = response.data.data;

            //     for (let [key, songsbyDate] of Object.entries(dates)) {

            //         for (let [key, listen] of Object.entries(songsbyDate)) {
            //             this.listens.push(listen)
            //         }

            //     }
            // })
        },

        methods: {
            init() {
                if (this.$route.query.page === undefined) {
                    this.currentPage = 1;
                } else {
                    this.currentPage = this.$route.query.page;
                }

                this.loadListens('/api/listens?page=' + this.currentPage);
            },

            updatePage(link) {
                this.loadListens(link).then(() => {
                    this.updateUrl();
                });

            },

            loadListens(link) {
                return axios.get(link).then((response) => {
                    this.listens = response.data.data;
                    this.prevLink = response.data.links.prev;
                    this.nextLink = response.data.links.next;
                    this.currentPage = response.data.meta.current_page;
                });
            },

            updateUrl() {
                this.$router.push({
                    name: 'listen',
                    query: {
                        page: this.currentPage
                    }
                });
            }
        }
    }
</script>