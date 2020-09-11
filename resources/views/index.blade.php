@extends('layouts.app')
@section('contenido')
    <v-app>
        <template v-if="menu==1">
            <ofertae-component></ofertae-component>
        </template> 
        <template v-if="menu==2">
            <formulario-component></formulario-component>
        </template>
        <template v-if="menu==3">
            <empleo-component></empleo-component>
        </template>
        <template v-if="menu==4">
            <empresa-component></empresa-component>
        </template>
        <template v-if="menu==5">
            <egresado-component></egresado-component>
        </template>
        <template v-if="menu==6">
            <Ofertas-Empleo></Ofertas-Empleo>
        </template>
        <template v-if="menu==7">
            <area-component></area-component>
        </template>
        <template v-if="menu==8">
            <example-component></example-component>
        </template>
        <template v-if="menu==9">
            <area-component></area-component>
        </template>
        <template v-if="menu==10">
            <tipousuario-component></tipousuario-component>
        </template>
        <template v-if="menu==11">
            <usuarios-component></usuarios-component>
        </template>
        
    </v-app> 
@endsection