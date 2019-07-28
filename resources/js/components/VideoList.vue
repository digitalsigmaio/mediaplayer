<script>
    export default {
        name: "VideoList",
        props: ['videos'],
        data() {
            return {
                headers: [
                    {text: 'ID', sortable: false, value: 'id'},
                    {text: 'Video', sortable: false, value: 'link'},
                    {text: 'Action', sortable: false, value: 'id'},
                ],
                dialog: false,
                videolist: this.videos,
                search: ''
            }
        },
        methods: {
            deletePage(video) {
                const list = this.videolist;
                confirm('Are you sure you want to delete this item?') &&
                axios.delete('/videos/' + video.id)
                    .then(res => {
                        list.splice(list.indexOf(video), 1)
                    })
                    .catch(err => {
                        //
                    });
            },
            edit(video) {
                location.href = '/videos/' + video.id + '/edit';
            },

        }
    }
</script>
