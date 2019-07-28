<script>
    export default {
        name: "GalleryList",
        props: ['images'],
        data() {
            return {
                headers: [
                    {text: 'Image', align: 'left', sortable: false, value: 'img'},
                    {text: 'Caption', value: 'caption'},
                    {text: 'Action', value: 'id'},
                ],
                dialog: false,
                imagelist: this.images,
                search: ''
            }
        },
        methods: {
            deleteImage(image) {
                const list = this.imagelist;
                confirm('Are you sure you want to delete this item?') &&
                axios.delete('/gallery-images/' + image.id)
                    .then(res => {
                        list.splice(list.indexOf(image), 1)
                    })
                    .catch(err => {
                        //
                    });
            },
            edit(image) {
                location.href = '/gallery-images/' + image.id + '/edit';
            },
            deleteForever(image) {
                const list = this.imagelist;
                confirm('Are you sure you want to delete this item forever?This action can\'t be undone.') &&
                axios.delete('/gallery-images/trash/' + image.id)
                    .then(res => {
                        list.splice(list.indexOf(image), 1)
                    })
                    .catch(err => {
                        //
                    });
            },
            restore(image) {
                const list = this.imagelist;
                confirm('Are you sure you want to restore this item?') &&
                axios.patch('/gallery-images/trash/' + image.id )
                    .then(res => {
                        list.splice(list.indexOf(image), 1)
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        }
    }
</script>
