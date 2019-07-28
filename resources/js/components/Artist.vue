<script>
    import Form from "../core/Form";

    export default {
        name: "Artist",
        props: ['artistdata', 'route'],
        data() {
            return {
                edit: false,
                artist: this.artistdata,
                name: this.artistdata.name,
                about: this.artistdata.about,
                image: null
            }
        },
        methods: {
            update() {
                let data = new FormData();
                let vm = this;
                data.append('name', this.name);
                data.append('about', this.about);
                data.append('image', this.image);
                axios.post(this.route, data).then(res => {
                    console.log(res.data);
                    vm.artist = res.data;
                    vm.edit = !vm.edit;
                    this.image = null
                }).catch(e => {

                });
            },
            uploadImage(event) {
                if (event.target.files.length)
                    this.image = event.target.files[0];
            }
        },
        computed: {
            avatar() {
                if (this.artist.img) {
                    return this.artist.img
                }

                return '/assets/img/avatar.png'
            }
        }
    }
</script>

<style scoped>

</style>