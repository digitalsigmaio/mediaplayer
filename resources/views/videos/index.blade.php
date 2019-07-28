@extends('layouts.app')

@section('content')
    <v-container fill-height xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" justify-center align-center>
        <v-layout d-block>
            @include('partials.success')
            <v-flex>
                <video-list :videos="{{ $videos }}" inline-template>
                    <v-card>
                        <v-card-title>
                            Videos
                            <v-spacer></v-spacer>
                            <v-text-field
                                    v-model="search"
                                    append-icon="search"
                                    label="Search"
                                    single-line
                                    hide-details
                            ></v-text-field>
                        </v-card-title>

                        <v-data-table
                                :headers="headers"
                                :items="videolist"
                                class="elevation-1"
                                :search="search"
                                disable-initial-sort
                        >
                            <template v-slot:items="list">
                                <td>@{{ list.item.id }}</td>
                                <td class="text-xs-left py-2">
                                    <iframe width="246" height="138" :src="list.item.link" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </td>
                                <td class="justify-center">
                                    <v-btn fab small color="info" @click="edit(list.item)">
                                        <v-icon dark>create</v-icon>
                                    </v-btn>
                                    <v-btn fab small color="red" dark @click="deletePage(list.item)">
                                        <v-icon dark>delete</v-icon>
                                    </v-btn>
                                </td>
                            </template>
                        </v-data-table>
                    </v-card>
                </video-list>
            </v-flex>
        </v-layout>
    </v-container>
@endsection