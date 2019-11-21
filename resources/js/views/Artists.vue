<template>
    <div class="card">
        <div class="card-header">Artists</div>

        <div class="card-body">

            <ul>
                <li v-for="artist in artists" v-text="artist.name"></li>
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
                artists: [],
                prevLink: null,
                nextLink: null,
                currentPage: 1,
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
                this.loadArtists('/api/artists?page=' + this.currentPage);
            },

            updatePage(link) {
                this.loadArtists(link).then(() => {
                    this.updateUrl();
                });

            },

            loadArtists(link) {
                return axios.get(link).then((response) => {
                    this.artists = response.data.data;
                    this.prevLink = response.data.links.prev;
                    this.nextLink = response.data.links.next;
                    this.currentPage = response.data.meta.current_page;
                });
            },

            updateUrl() {
                this.$router.push({
                    name: 'artist',
                    query: {
                        page: this.currentPage
                    }
                });
            }
        }
    }
</script>