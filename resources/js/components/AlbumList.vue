<script>
    export default {
        name: "AlbumList",
        props: ['albums'],
        data() {
            return {
                headers: [
                    {text: 'Cover', align: 'left', sortable: false, value: 'img'},
                    {text: 'Title', value: 'title'},
                    {text: 'Year', value: 'year'},
                    {text: 'Action', value: 'id'},
                ],
                dialog: false,
                albumlist: this.albums,
                search: ''
            }
        },
        methods: {
            deleteAlbum(album) {
                const list = this.albumlist;
                confirm('Are you sure you want to delete this item?') &&
                axios.delete('/albums/' + album.id)
                    .then(res => {
                        list.splice(list.indexOf(album), 1)
                    })
                    .catch(err => {
                        //
                    });
            },
            edit(album) {
                location.href = '/albums/' + album.id + '/edit';
            },
            deleteForever(album) {
                const list = this.albumlist;
                confirm('Are you sure you want to delete this item forever?This action can\'t be undone.') &&
                axios.delete('/albums/trash/' + album.id)
                    .then(res => {
                        list.splice(list.indexOf(album), 1)
                    })
                    .catch(err => {
                        //
                    });
            },
            restore(album) {
                const list = this.albumlist;
                confirm('Are you sure you want to restore this item?') &&
                axios.patch('/albums/trash/' + album.id )
                    .then(res => {
                        list.splice(list.indexOf(album), 1)
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        }
    }
</script>
