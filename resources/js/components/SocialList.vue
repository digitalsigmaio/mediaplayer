<script>
    export default {
        name: "SocialList",
        props: ['socials'],
        data() {
            return {
                headers: [
                    {text: 'Icon', align: 'left', sortable: false, value: 'icon'},
                    {text: 'Provider', value: 'provider'},
                    {text: 'Action', value: 'id'},
                ],
                dialog: false,
                sociallist: this.socials,
                search: ''
            }
        },
        methods: {
            deletePage(page) {
                const list = this.sociallist;
                confirm('Are you sure you want to delete this item?') &&
                axios.delete('/social-pages/' + page.id)
                    .then(res => {
                        list.splice(list.indexOf(page), 1)
                    })
                    .catch(err => {
                        //
                    });
            },
            edit(page) {
                location.href = '/social-pages/' + page.id + '/edit';
            },

        }
    }
</script>
