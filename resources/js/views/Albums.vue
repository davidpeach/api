<template>
    <div class="card">
        <div class="card-header">Albums</div>

        <div class="card-body">

            <ul>
                <li v-for="album in albums" v-text="album.title + ' by ' + album.artist"></li>
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
                albums: [],
                prevLink: null,
                nextLink: null
            }
        },

        mounted: function() {
            this.init();
        },

        methods: {
            init() {
                if (this.$route.query.page === undefined) {
                    this.currentPage = 1;
                } else {
                    this.currentPage = this.$route.query.page;
                }

                this.loadArtists('/api/albums?page=' + this.currentPage);
            },

            updatePage(link) {
                this.loadArtists(link).then(() => {
                    this.updateUrl();
                });

            },

            loadArtists(link) {
                return axios.get(link).then((response) => {
                    this.albums = response.data.data;
                    this.prevLink = response.data.links.prev;
                    this.nextLink = response.data.links.next;
                    this.currentPage = response.data.meta.current_page;
                });
            },

            updateUrl() {
                this.$router.push({
                    name: 'album',
                    query: {
                        page: this.currentPage
                    }
                });
            }
        }
    }
</script>