@if(session()->has('success') )
    <v-flex xs6>
        <v-alert
                :value="true"
                type="success"
                dismissible
        >

                <div>{{ session()->get('success') }}</div>

        </v-alert>
    </v-flex>
@endif
