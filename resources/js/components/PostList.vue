<script>
    export default {
        name: "PostList",
        props: ['posts'],
        data() {
            return {
                headers: [
                    {text: 'Cover', align: 'left', sortable: false, value: 'img'},
                    {text: 'Title', value: 'title'},
                    {text: 'Year', value: 'year'},
                    {text: 'Action', value: 'id'},
                ],
                dialog: false,
                postlist: this.posts,
                search: ''
            }
        },
        methods: {
            deletePost(post) {
                const list = this.postlist;
                confirm('Are you sure you want to delete this item?') &&
                axios.delete('/posts/' + post.id)
                    .then(res => {
                        list.splice(list.indexOf(post), 1)
                    })
                    .catch(err => {
                        //
                    });
            },
            edit(post) {
                location.href = '/posts/' + post.id + '/edit';
            },
            deleteForever(post) {
                const list = this.postlist;
                confirm('Are you sure you want to delete this item forever?This action can\'t be undone.') &&
                axios.delete('/posts/trash/' + post.id)
                    .then(res => {
                        list.splice(list.indexOf(post), 1)
                    })
                    .catch(err => {
                        //
                    });
            },
            restore(post) {
                const list = this.postlist;
                confirm('Are you sure you want to restore this item?') &&
                axios.patch('/posts/trash/' + post.id )
                    .then(res => {
                        list.splice(list.indexOf(post), 1)
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        }
    }
</script>
