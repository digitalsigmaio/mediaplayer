@if($errors->any() || session()->has('error') )
<v-layout justify-center>
    <v-flex xs6>
        <v-alert
                :value="true"
                type="error"
                dismissible
        >

            @if (session()->has('error'))
                <div>{{ session()->get('error') }}</div>
            @endif
            @foreach($errors->all() as $error)
                    <div>
                        {{ $error }}
                    </div>
            @endforeach

        </v-alert>
    </v-flex>
</v-layout>
@endif
