@extends('layouts.app')

@section('content')
    <v-container fluid fill-height xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" align-center>
        <v-flex>
            <track-list :tracks="{{ $tracks }}" inline-template>

                <v-card>
                    <v-card-title>
                        <h3>Tracks</h3>
                        <v-spacer></v-spacer>
                        <v-text-field
                                v-model="search"
                                append-icon="search"
                                label="Search"
                                single-line
                                hide-details></v-text-field>
                    </v-card-title>

                    <v-data-table
                            :headers="headers"
                            :items="tracklist"
                            :search="search"
                            class="elevation-1"
                            disable-initial-sort
                    >
                        <template v-slot:items="list">
                            <td class="text-xs-left"><p><strong>@{{ list.item.title }}</strong></p></td>
                            <td class="text-xs-left">@{{ list.item.album.title }}</td>
                            <td class="text-xs-left">
                                <audio controls :src="list.item.audio" v-if="list.item.audio">
                                    Your browser does not support the
                                    <code>audio</code> element.
                                </audio>
                                <p v-else>N/A</p>
                            </td>
                            <td class="text-xs-left">
                                <audio controls :src="list.item.ringtone" v-if="list.item.ringtone">
                                    Your browser does not support the
                                    <code>audio</code> element.
                                </audio>
                                <p v-else>N/A</p>
                            </td>
                            <td class="text-xs-left">
                                <p v-if="list.item.vodafone">@{{ list.item.vodafone }}</p>
                                <p v-else>N/A</p>
                            </td>
                            <td class="text-xs-left">
                                <p v-if="list.item.orange">@{{ list.item.orange }}</p>
                                <p v-else>N/A</p>
                            </td>
                            <td class="text-xs-left">
                                <p v-if="list.item.etisalat">@{{ list.item.etisalat }}</p>
                                <p v-else>N/A</p>
                            </td>
                            <td class="justify-center">
                                <v-btn fab small color="info" title="Restore" @click="restore(list.item)">
                                    <v-icon dark>restore</v-icon>
                                </v-btn>
                                <v-btn fab small color="red" dark @click="deleteForever(list.item)">
                                    <v-icon dark>delete_forever</v-icon>
                                </v-btn>
                            </td>
                        </template>
                        <v-alert v-slot:no-results :value="true" color="error" icon="warning">
                            Your search for "@{{ search }}" found no results.
                        </v-alert>
                    </v-data-table>
                </v-card>

            </track-list>
        </v-flex>
        @include('partials.success')
    </v-container>
@endsection