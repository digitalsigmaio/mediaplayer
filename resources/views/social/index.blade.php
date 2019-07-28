@extends('layouts.app')

@section('content')
    <v-container fluid fill-height xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" justify-center align-center>
        <v-layout d-block>
            @include('partials.success')
            <v-flex>
                <social-list :socials="{{ $socials }}" inline-template>
                    <v-card>
                        <v-card-title>
                            <h3>Social Pages</h3>
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
                                :items="sociallist"
                                :search="search"
                                class="elevation-1"
                                disable-initial-sort
                        >
                            <template v-slot:items="list">
                                <td class="text-xs-left"><img :src="list.item.img" class="img-fluid img-table"
                                                              :alt="list.item.provider"></td>
                                <td class="text-xs-left"><a :href="list.item.link" target="_blank" rel="nofollow"><strong>@{{ list.item.provider }}</strong></a></td>
                                <td class="justify-center">
                                    <v-btn fab small color="info" @click="edit(list.item)">
                                        <v-icon dark>create</v-icon>
                                    </v-btn>
                                    <v-btn fab small color="red" dark @click="deletePage(list.item)">
                                        <v-icon dark>delete</v-icon>
                                    </v-btn>
                                </td>
                            </template>
                            <v-alert v-slot:no-results :value="true" color="error" icon="warning">
                                Your search for "@{{ search }}" found no results.
                            </v-alert>
                        </v-data-table>
                    </v-card>
                </social-list>
            </v-flex>
        </v-layout>
    </v-container>
@endsection