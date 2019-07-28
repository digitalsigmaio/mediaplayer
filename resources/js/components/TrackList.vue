<script>
    export default {
        name: "TrackList",
        props: ['tracks'],
        data() {
            return {
                headers: [
                    {text: 'Title', align: 'left', sortable: false, value: 'title'},
                    {text: 'Album', value: 'album.title'},
                    {text: 'Track', value: 'audio'},
                    {text: 'Ringtone', value: 'ringtone'},
                    {text: 'Vodafone', value: 'vodafone'},
                    {text: 'Orange', value: 'orange'},
                    {text: 'Etisalat', value: 'etisalat'},
                    {text: 'Action', value: 'id'},
                ],
                dialog: false,
                tracklist: this.tracks,
                search: ''
            }
        },
        methods: {
            deleteTrack(track) {
                const list = this.tracklist;
                confirm('Are you sure you want to delete this item?') &&
                axios.delete('/tracks/' + track.id)
                    .then(res => {
                        list.splice(list.indexOf(track), 1)
                    })
                    .catch(err => {
                        //
                    });

            },
            edit(track) {
                location.href = '/tracks/' + track.id + '/edit';
            },
            deleteForever(track) {
                const list = this.tracklist;
                confirm('Are you sure you want to delete this item forever?This action can\'t be undone.') &&
                axios.delete('/tracks/trash/' + track.id)
                    .then(res => {
                        list.splice(list.indexOf(track), 1)
                    })
                    .catch(err => {
                        //
                    });
            },
            restore(track) {
                const list = this.tracklist;
                confirm('Are you sure you want to restore this item?') &&
                axios.patch('/tracks/trash/' + track.id )
                    .then(res => {
                        list.splice(list.indexOf(track), 1)
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        }
    }
</script>
